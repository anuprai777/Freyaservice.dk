<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('availabilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('worker_profile_id')->constrained('worker_profiles')->cascadeOnDelete();
            $table->unsignedTinyInteger('day_of_week')->nullable()->comment('0=Sunday, 1=Monday ... 6=Saturday');
            $table->date('specific_date')->nullable()->index();
            $table->time('start_time')->default('08:00:00');
            $table->time('end_time')->default('16:00:00');
            $table->boolean('is_available')->default(true);
            $table->enum('type', ['recurring', 'specific_date'])->default('recurring')->index();
            $table->timestamps();

            $table->index(['worker_profile_id', 'day_of_week']);
            $table->index(['worker_profile_id', 'specific_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('availabilities');
    }
};
