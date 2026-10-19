<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('contract_number', 50)->unique();
            $table->foreignId('worker_id')->constrained('worker_profiles')->cascadeOnDelete();
            $table->foreignId('client_id')->nullable()->constrained('client_profiles')->nullOnDelete();
            $table->foreignId('staff_request_id')->nullable()->constrained('staff_requests')->nullOnDelete();
            $table->enum('type', ['temporary', 'part_time', 'full_time'])->index();
            $table->date('start_date')->index();
            $table->date('end_date')->nullable()->index();
            $table->decimal('hourly_rate', 10, 2);
            $table->text('terms')->nullable();
            $table->string('file_path')->nullable();
            $table->enum('status', ['draft', 'active', 'terminated', 'expired'])->default('active')->index();
            $table->timestamp('signed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
