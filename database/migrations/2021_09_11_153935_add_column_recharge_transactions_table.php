<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnRechargeTransactionsTable extends Migration
{
    public function up()
    {
        Schema::table('recharge_transactions', function (Blueprint $table) {
            $table->unsignedDecimal('vnd', 14, 2)->default(0);
        });
    }

    public function down()
    {
        Schema::table('recharge_transactions', function (Blueprint $table) {
            $table->dropColumn('vnd');
        });
    }
}
