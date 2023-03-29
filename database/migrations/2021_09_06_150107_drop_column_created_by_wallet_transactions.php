<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnCreatedByWalletTransactions extends Migration
{
    public function up()
    {
        Schema::table('wallet_transactions', function (Blueprint $table) {
            $table->dropColumn('money');
        });
    }

    public function down()
    {
        Schema::table('wallet_transactions', function (Blueprint $table) {
            $table->bigInteger('categories_id');
        });
    }
}

