<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnRechargeTransactionTable extends Migration
{
    public function up()
    {
        Schema::table('recharge_transactions', function (Blueprint $table) {
            $table->unsignedDecimal('vnd_in_month', 14, 2)->default(0);
        });
    }

    public function down()
    {
        Schema::table('recharge_transactions', function (Blueprint $table) {
            $table->dropColumn('vnd_in_month');
        });
    }
}
