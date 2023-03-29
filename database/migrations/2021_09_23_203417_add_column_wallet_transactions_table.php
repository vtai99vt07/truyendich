<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnWalletTransactionsTable extends Migration
{
    public function up()
    {
        Schema::table('wallet_transactions', function (Blueprint $table) {
            $table->unsignedDecimal('gold_balance', 14, 2)->default(0);
            $table->unsignedDecimal('yuan_balance', 14, 2)->default(0);

        });
    }

    public function down()
    {
        Schema::table('wallet_transactions', function (Blueprint $table) {
            $table->dropColumn('gold_balance');
            $table->dropColumn('yuan_balance');
        });
    }
}
