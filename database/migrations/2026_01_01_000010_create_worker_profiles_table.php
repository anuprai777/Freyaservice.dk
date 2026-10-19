<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('worker_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->cascadeOnDelete();
            $table->json('skills')->nullable();
            $table->string('city', 100)->index();
            $table->string('postcode', 20)->index();
            $table->decimal('lat', 10, 8)->nullable();
            $table->decimal('lng', 11, 8)->nullable();
            $table->decimal('hourly_rate', 10, 2)->default(0.00);
            $table->decimal('rating_avg', 3, 2)->default(0.00);
            $table->unsignedInteger('ratings_count')->default(0);
            $table->enum('availability_type', ['temporary', 'part_time', 'full_time', 'any'])->default('any')->index();
            $table->enum('status', ['pending', 'approved', 'suspended', 'blocked'])->default('pending')->index();
            $table->text('bank_reg_number')->nullable(); // Encrypted cast
            $table->text('bank_account_number')->nullable(); // Encrypted cast
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['city', 'status']);
            $table->index(['availability_type', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('worker_profiles');
    }
};
