<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('invoice_id'); // Foreign key referencing the invoices table
            $table->date('receipt_date'); // Date of the receipt
            $table->decimal('amount_paid', 10, 2); // Amount that has been paid
            $table->string('payment_method'); // Payment method (e.g., cash, credit card, bank transfer)
            $table->string('reference_number')->nullable(); // Optional reference number for the payment

            // Foreign key constraint referencing the invoices table
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');



        });
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('receipts');
    }

};
