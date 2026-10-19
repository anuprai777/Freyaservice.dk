<?php

namespace App\Console\Commands;

use App\Enums\DocumentStatus;
use App\Models\WorkerDocument;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckExpiringDocuments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'documents:check-expiring';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check worker documents expiring in 30 days or 7 days and flag or notify admins/workers';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $today = now()->startOfDay();

        // 1. Check expired approved documents
        $expiredDocs = WorkerDocument::where('status', DocumentStatus::APPROVED->value)
            ->whereNotNull('expiry_date')
            ->where('expiry_date', '<', $today)
            ->with(['workerProfile.user'])
            ->get();

        foreach ($expiredDocs as $doc) {
            $workerName = $doc->workerProfile?->user?->name ?? 'Ukendt';
            $this->warn("Dokument #{$doc->id} ({$doc->type->label()}) for {$workerName} er udløbet den {$doc->expiry_date->format('d/m/Y')}.");
            Log::warning("WorkerDocument #{$doc->id} for worker {$workerName} expired on {$doc->expiry_date->format('d/m/Y')}.");
        }

        // 2. Check documents expiring within 30 days
        $expiringDocs = WorkerDocument::where('status', DocumentStatus::APPROVED->value)
            ->whereNotNull('expiry_date')
            ->whereBetween('expiry_date', [$today, $today->copy()->addDays(30)])
            ->with(['workerProfile.user'])
            ->get();


        $this->info("Fandt {$expiringDocs->count()} dokumenter der udløber inden for de næste 30 dage.");

        foreach ($expiringDocs as $doc) {
            $daysLeft = (int) $today->diffInDays($doc->expiry_date, false);
            $workerName = $doc->workerProfile?->user?->name ?? 'Ukendt';
            $this->line("- [{$daysLeft} dage tilbage] {$doc->type->label()} for {$workerName} (udløber: {$doc->expiry_date->format('d/m/Y')})");
        }

        return Command::SUCCESS;
    }
}
