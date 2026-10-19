<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('timesheets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assignment_id')->constrained('assignments')->cascadeOnDelete();
            $table->foreignId('worker_id')->constrained('worker_profiles')->cascadeOnDelete();
            $table->foreignId('shift_id')->nullable()->constrained('shifts')->nullOnDelete();
            $table->dateTime('clock_in')->index();
            $table->dateTime('clock_out')->nullable()->index();
            $table->unsignedInteger('break_minutes')->default(0);
            $table->decimal('hours', 5, 2)->default(0.00);
            $table->decimal('hourly_rate', 10, 2)->default(0.00);
            $table->decimal('client_hourly_rate', 10, 2)->default(0.00);
            $table->decimal('worker_total_pay', 10, 2)->default(0.00);
            $table->decimal('client_total_charge', 10, 2)->default(0.00);
            $table->enum('status', ['submitted', 'approved', 'rejected'])->default('submitted')->index();
            $table->timestamp('client_approved_at')->nullable()->index();
            $table->foreignId('client_approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->text('rejection_reason')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['worker_id', 'status']);
            $table->index(['status', 'clock_in']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('timesheets');
    }
};
