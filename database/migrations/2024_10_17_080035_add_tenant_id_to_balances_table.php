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
        Schema::table('balances', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id')->after('id'); // Adding tenant_id
            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('cascade'); // Foreign key constraint
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('balances', function (Blueprint $table) {
            //
        });
    }
};
