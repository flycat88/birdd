<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTenantIdToReceiptsTable extends Migration
{
    public function up()
    {
        // Check if the column already exists before adding it
        if (!Schema::hasColumn('receipts', 'tenant_id')) {
            Schema::table('receipts', function (Blueprint $table) {
                $table->foreignId('tenant_id')->nullable()->constrained()->after('id');
            });
        }
    }

    public function down()
    {
        Schema::table('receipts', function (Blueprint $table) {
            $table->dropColumn('tenant_id');
        });
    }
}
