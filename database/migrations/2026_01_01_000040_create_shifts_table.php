<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_request_id')->constrained('staff_requests')->cascadeOnDelete();
            $table->string('title')->nullable();
            $table->dateTime('start_at')->index();
            $table->dateTime('end_at')->index();
            $table->unsignedInteger('workers_needed')->default(1);
            $table->enum('status', ['draft', 'open', 'filled', 'in_progress', 'completed', 'cancelled'])->default('open')->index();
            $table->string('qr_secret_token', 64)->nullable()->index();
            $table->timestamps();

            $table->index(['staff_request_id', 'start_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};
