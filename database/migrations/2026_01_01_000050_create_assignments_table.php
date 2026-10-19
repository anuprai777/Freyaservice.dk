<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_request_id')->constrained('staff_requests')->cascadeOnDelete();
            $table->foreignId('shift_id')->nullable()->constrained('shifts')->cascadeOnDelete();
            $table->foreignId('worker_id')->constrained('worker_profiles')->cascadeOnDelete();
            $table->enum('status', ['offered', 'accepted', 'declined', 'active', 'completed', 'cancelled'])->default('offered')->index();
            $table->timestamp('offered_at')->nullable();
            $table->timestamp('responded_at')->nullable();
            $table->decimal('worker_hourly_rate', 10, 2)->default(0.00);
            $table->decimal('client_hourly_rate', 10, 2)->default(0.00);
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['worker_id', 'status']);
            $table->index(['staff_request_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
