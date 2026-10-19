<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('client_profiles')->cascadeOnDelete();
            $table->string('invoice_number', 50)->unique();
            $table->foreignId('staff_request_id')->nullable()->constrained('staff_requests')->nullOnDelete();
            $table->date('period_start')->nullable();
            $table->date('period_end')->nullable();
            $table->date('issue_date')->index();
            $table->date('due_date')->index();
            $table->decimal('subtotal', 10, 2)->default(0.00);
            $table->decimal('vat_rate', 4, 2)->default(25.00); // Danish standard moms: 25%
            $table->decimal('vat_amount', 10, 2)->default(0.00);
            $table->decimal('total', 10, 2)->default(0.00);
            $table->string('currency', 3)->default('DKK');
            $table->enum('status', ['draft', 'sent', 'paid', 'overdue', 'cancelled'])->default('sent')->index();
            $table->string('pdf_path')->nullable();
            $table->string('payment_method')->default('bank_transfer');
            $table->text('notes')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();

            $table->index(['client_id', 'status']);
        });

        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained('invoices')->cascadeOnDelete();
            $table->foreignId('timesheet_id')->nullable()->constrained('timesheets')->nullOnDelete();
            $table->string('description');
            $table->decimal('quantity', 6, 2)->default(1.00); // e.g. hours
            $table->decimal('unit_price', 10, 2)->default(0.00);
            $table->decimal('total', 10, 2)->default(0.00);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoice_items');
        Schema::dropIfExists('invoices');
    }
};
