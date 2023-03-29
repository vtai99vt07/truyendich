<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropWalletTransactionsTable extends Migration
{
    public function up()
    {
        Schema::table('wallet_transactions', function (Blueprint $table) {
            $table->dropColumn('transaction_id');
        });
    }

    public function down()
    {
        Schema::table('wallet_transactions', function (Blueprint $table) {
            $table->bigInteger('transaction_id');
        });
    }
}
