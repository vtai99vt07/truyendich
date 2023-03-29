<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnCreatedByRechargeTransactions extends Migration
{
    public function up()
    {
        Schema::table('recharge_transactions', function (Blueprint $table) {
            $table->dropColumn('recharge_package_id');
        });
    }

    public function down()
    {
        Schema::table('recharge_transactions', function (Blueprint $table) {
            $table->bigInteger('recharge_package_id');
        });
    } 
}
