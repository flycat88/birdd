<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('tenant_id'); // Foreign key referencing the tenants table
            $table->string('invoice_number')->unique(); // Unique invoice number
            $table->date('invoice_date'); // Date of the invoice
            $table->date('due_date'); // Due date for payment
            $table->decimal('total_amount', 10, 2); // Total amount of the invoice
            $table->decimal('paid_amount', 10, 2);
            $table->string('status')->default('pending'); // Status of the invoice (e.g., pending, paid, canceled)
      


            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('cascade');
        });





        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
