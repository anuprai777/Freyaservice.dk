<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('staff_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('client_profiles')->cascadeOnDelete();
            $table->enum('request_type', ['temporary_cover', 'part_time', 'full_time'])->index();
            $table->string('role')->index();
            $table->unsignedInteger('workers_needed')->default(1);
            $table->enum('reason', ['absence', 'peak', 'permanent_need'])->index();
            $table->string('location');
            $table->string('city', 100)->nullable()->index();
            $table->string('postcode', 20)->nullable()->index();
            $table->decimal('lat', 10, 8)->nullable();
            $table->decimal('lng', 11, 8)->nullable();
            $table->date('start_date')->index();
            $table->date('end_date')->nullable()->index();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->decimal('hours_per_week', 5, 2)->nullable();
            $table->json('recurring_schedule')->nullable();
            $table->string('dress_code')->nullable();
            $table->text('instructions')->nullable();
            $table->foreignId('preferred_worker_id')->nullable()->constrained('worker_profiles')->nullOnDelete();
            $table->boolean('is_urgent')->default(false)->index();
            $table->enum('status', ['new', 'in_progress', 'matched', 'active', 'completed', 'cancelled'])->default('new')->index();
            $table->decimal('hourly_rate_offered', 10, 2)->nullable();
            $table->timestamps();

            $table->index(['client_id', 'status']);
            $table->index(['status', 'start_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('staff_requests');
    }
};
