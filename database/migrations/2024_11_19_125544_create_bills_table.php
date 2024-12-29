<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade'); // Foreign key referencing the tenants table
            $table->decimal('bill_amount', 10, 2); // Bill amount with two decimal places
            $table->string('name_of_bill'); // Column for the name of the bill (e.g., "Electricity", "Water", etc.)
            $table->date('bill_date'); // Date of the bill
            $table->timestamps(); // Created at and Updated at timestamps
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
