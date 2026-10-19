<?php

namespace App\Services;

use App\Models\Shift;
use App\Models\WorkerProfile;
use Illuminate\Support\Facades\URL;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeService
{
    /**
     * Generate signed URL for shift clock in/out.
     */
    public function generateShiftClockInUrl(Shift $shift): string
    {
        return URL::temporarySignedRoute(
            'worker.shifts.scan-qr',
            now()->addHours(12),
            [
                'shift' => $shift->id,
                'token' => $shift->qr_secret_token,
            ]
        );
    }

    /**
     * Generate SVG QR code content.
     */
    public function generateShiftQrSvg(Shift $shift, int $size = 250): string
    {
        $payload = $this->generateShiftClockInUrl($shift);

        return QrCode::size($size)
            ->format('svg')
            ->errorCorrection('H')
            ->margin(1)
            ->generate($payload);
    }

    /**
     * Validate that a scanned token is valid for a shift and worker.
     */
    public function validateScan(Shift $shift, string $token, WorkerProfile $worker): bool
    {
        if (! hash_equals($shift->qr_secret_token, $token)) {
            return false;
        }

        // Validate that worker is assigned to this shift or parent request
        $hasAssignment = $shift->assignments()
            ->where('worker_id', $worker->id)
            ->whereIn('status', ['accepted', 'active'])
            ->exists();

        if (! $hasAssignment) {
            // Check request-level assignment
            $hasAssignment = $shift->staffRequest->assignments()
                ->where('worker_id', $worker->id)
                ->whereIn('status', ['accepted', 'active'])
                ->exists();
        }

        return $hasAssignment;
    }
}
