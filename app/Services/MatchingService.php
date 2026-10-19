<?php

namespace App\Services;

use App\Models\ClientProfile;
use App\Models\StaffRequest;
use App\Models\WorkerProfile;
use Illuminate\Support\Collection;

class MatchingService
{
    /**
     * Score and rank candidate workers for a staff request.
     *
     * @param StaffRequest $request
     * @param int $limit
     * @return Collection
     */
    public function findMatches(StaffRequest $request, int $limit = 10): Collection
    {
        $workers = WorkerProfile::with(['user', 'documents', 'availabilities'])
            ->where('status', 'approved')
            ->get();

        $client = $request->client;
        $favouriteWorkerIds = $client ? $client->favouriteWorkers()->pluck('worker_profiles.id')->toArray() : [];

        $scored = $workers->map(function (WorkerProfile $worker) use ($request, $favouriteWorkerIds) {
            $breakdown = [
                'skill_score' => $this->calculateSkillScore($request->role, $worker->skills ?? []),
                'distance_score' => $this->calculateDistanceScore($request, $worker),
                'availability_score' => $this->calculateAvailabilityScore($request, $worker),
                'rating_score' => $this->calculateRatingScore($worker->rating_avg),
                'document_score' => $this->calculateDocumentScore($worker),
                'favourite_bonus' => in_array($worker->id, $favouriteWorkerIds, true) ? 10 : 0,
            ];

            $totalScore = array_sum($breakdown);

            return [
                'worker' => $worker,
                'total_score' => min(100, $totalScore),
                'breakdown' => $breakdown,
                'is_favourite' => in_array($worker->id, $favouriteWorkerIds, true),
                'distance_km' => $this->calculateDistanceKm($request, $worker),
            ];
        });

        return $scored->sortByDesc('total_score')->take($limit)->values();
    }

    protected function calculateSkillScore(string $role, array $workerSkills): int
    {
        $roleLower = mb_strtolower(trim($role));

        foreach ($workerSkills as $skill) {
            $skillLower = mb_strtolower(trim($skill));
            if ($skillLower === $roleLower || str_contains($roleLower, $skillLower) || str_contains($skillLower, $roleLower)) {
                return 35; // Direct match
            }
        }

        return 10; // General worker capability
    }

    protected function calculateDistanceScore(StaffRequest $request, WorkerProfile $worker): int
    {
        $distance = $this->calculateDistanceKm($request, $worker);

        if ($distance === null) {
            // Check matching city text
            if (mb_strtolower(trim($request->city ?? '')) === mb_strtolower(trim($worker->city ?? ''))) {
                return 22;
            }
            return 12;
        }

        if ($distance <= 5) return 25;
        if ($distance <= 15) return 20;
        if ($distance <= 30) return 15;
        if ($distance <= 50) return 8;

        return 2;
    }

    public function calculateDistanceKm(StaffRequest $request, WorkerProfile $worker): ?float
    {
        if ($request->lat && $request->lng && $worker->lat && $worker->lng) {
            return $this->haversineGreatCircleDistance(
                (float)$request->lat,
                (float)$request->lng,
                (float)$worker->lat,
                (float)$worker->lng
            );
        }

        return null;
    }

    protected function haversineGreatCircleDistance(float $lat1, float $lon1, float $lat2, float $lon2, float $earthRadius = 6371): float
    {
        $latFrom = deg2rad($lat1);
        $lonFrom = deg2rad($lon1);
        $latTo = deg2rad($lat2);
        $lonTo = deg2rad($lon2);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));

        return round($angle * $earthRadius, 1);
    }

    protected function calculateAvailabilityScore(StaffRequest $request, WorkerProfile $worker): int
    {
        $score = 0;

        // Check availability type match
        if ($worker->availability_type === 'any' || $worker->availability_type === $request->request_type->value) {
            $score += 10;
        }

        // Check day of week
        if ($request->start_date) {
            $dayOfWeek = (int) $request->start_date->dayOfWeek; // 0=Sunday, 1=Monday ... 6=Saturday
            $hasDay = $worker->availabilities->contains(function ($av) use ($dayOfWeek) {
                return $av->day_of_week === $dayOfWeek && $av->is_available;
            });

            if ($hasDay || $worker->availabilities->isEmpty()) {
                $score += 10;
            }
        } else {
            $score += 10;
        }

        return $score;
    }

    protected function calculateRatingScore(?float $rating): int
    {
        if (! $rating || $rating <= 0) {
            return 7; // Neutral baseline for new approved workers
        }

        return (int) round(($rating / 5.0) * 10);
    }

    protected function calculateDocumentScore(WorkerProfile $worker): int
    {
        $validDocuments = $worker->documents->filter(function ($doc) {
            return $doc->status->value === 'approved' && ! $doc->isExpired();
        });

        return $validDocuments->count() > 0 ? 10 : 3;
    }
}
