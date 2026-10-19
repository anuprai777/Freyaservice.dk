<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('client_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->cascadeOnDelete();
            $table->string('company_name')->index();
            $table->string('cvr', 8)->index(); // Danish 8-digit CVR
            $table->string('address');
            $table->string('city', 100);
            $table->string('postcode', 20)->index();
            $table->string('contact_person');
            $table->string('phone', 30);
            $table->string('billing_email')->nullable();
            $table->string('industry', 100)->nullable();
            $table->enum('status', ['active', 'pending', 'suspended'])->default('active')->index();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('client_profiles');
    }
};
