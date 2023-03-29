<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnWalletTransactions extends Migration
{
    public function up()
    {
        Schema::table('wallet_transactions', function (Blueprint $table) {
            $table->integer('gold')->default(0);
            $table->integer('yuan')->default(0); 
        });
    }
}
