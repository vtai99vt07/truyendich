<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWalletTransactionsTables extends Migration
{
    public function up()
    {
        Schema::table('wallet_transactions', function (Blueprint $table) { 
         $table->text('transaction_id');
    });
    }

    public function down()
    {
        Schema::table('wallet_transactions', function (Blueprint $table) {  
            $table->dropColumn('transaction_id');
        });
    }
}
