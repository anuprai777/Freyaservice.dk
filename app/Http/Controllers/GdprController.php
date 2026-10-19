<?php

namespace App\Http\Controllers;

use App\Models\GdprRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\StreamedResponse;

class GdprController extends Controller
{
    /**
     * Download an immediate GDPR export of the user's data.
     */
    public function export(Request $request): StreamedResponse
    {
        $user = $request->user();
        $user->load(['workerProfile.documents', 'workerProfile.availabilities', 'clientProfile.staffRequests']);

        $exportData = [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'phone' => $user->phone,
                'locale' => $user->locale,
                'gdpr_consent_at' => $user->gdpr_consent_at,
                'created_at' => $user->created_at,
            ],
            'client_profile' => $user->clientProfile,
            'worker_profile' => $user->workerProfile ? [
                'city' => $user->workerProfile->city,
                'postcode' => $user->workerProfile->postcode,
                'skills' => $user->workerProfile->skills,
                'hourly_rate' => $user->workerProfile->hourly_rate,
                'rating_avg' => $user->workerProfile->rating_avg,
                'availability_type' => $user->workerProfile->availability_type,
                'status' => $user->workerProfile->status,
            ] : null,
            'exported_at' => now()->toIso8601String(),
            'gdpr_compliance' => 'FreyaService opbevarer ingen CPR-numre og overholder EU GDPR 2016/679.',
        ];

        GdprRequest::create([
            'user_id' => $user->id,
            'type' => 'export',
            'status' => 'completed',
            'completed_at' => now(),
        ]);

        $fileName = 'freyaservice_gdpr_export_' . $user->id . '_' . date('Ymd_His') . '.json';

        return response()->streamDownload(function () use ($exportData) {
            echo json_encode($exportData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }, $fileName, ['Content-Type' => 'application/json']);
    }

    /**
     * Request account deletion (Right to be Forgotten).
     */
    public function requestDeletion(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'reason' => ['nullable', 'string', 'max:500'],
        ]);

        $user = $request->user();

        GdprRequest::create([
            'user_id' => $user->id,
            'type' => 'deletion',
            'status' => 'pending',
            'reason' => $validated['reason'] ?? null,
        ]);

        return back()->with('info', 'Din anmodning om sletning (GDPR artikel 17) er modtaget og behandles inden for 30 dage jf. gældende regnskabslovgivning.');
    }
}
