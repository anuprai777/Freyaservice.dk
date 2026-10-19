<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureWorkerApproved
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && $user->isWorker()) {
            $profile = $user->workerProfile;
            if (! $profile || ! $profile->isApproved()) {
                return redirect()->route('worker.profile')
                    ->with('warning', 'Din profil afventer godkendelse af administrationen, før du kan acceptere vagter.');
            }
        }

        return $next($request);
    }
}
