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

        Schema::create('balances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id'); // Foreign key referencing the tenants table
            $table->decimal('rent', 10, 2); // Tenant rent
            $table->decimal('balance', 10, 2); // Calculated balance
            $table->decimal('carry_forward', 10, 2)->default(0); // Carry forward balance
            $table->string('house_number'); // House number of the tenant
            $table->timestamps(); // Timestamps for created_at and updated_at

            // Foreign key constraint
            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('cascade');
        });

        Schema::table('balances', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id')->after('id'); // Add tenant_id after the id column
            // Optional: You can also define a foreign key constraint if needed
            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('balances', function (Blueprint $table) {
            $table->dropForeign(['tenant_id']); // Drop foreign key constraint
            $table->dropColumn('tenant_id'); // Remove tenant_id column
        });
    }




};
