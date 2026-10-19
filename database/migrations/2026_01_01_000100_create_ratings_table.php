<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_request_id')->nullable()->constrained('staff_requests')->cascadeOnDelete();
            $table->foreignId('shift_id')->nullable()->constrained('shifts')->nullOnDelete();
            $table->foreignId('worker_id')->constrained('worker_profiles')->cascadeOnDelete();
            $table->foreignId('client_id')->constrained('client_profiles')->cascadeOnDelete();
            $table->unsignedTinyInteger('rating'); // 1-5
            $table->unsignedTinyInteger('punctuality_score')->nullable(); // 1-5
            $table->unsignedTinyInteger('quality_score')->nullable(); // 1-5
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->index(['worker_id', 'rating']);
            $table->index(['client_id', 'worker_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
