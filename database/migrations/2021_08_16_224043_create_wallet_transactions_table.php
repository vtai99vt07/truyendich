<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('transaction_id');
            $table->bigInteger('user_id');
            $table->tinyInteger('change_type')->default(0)->comment('0: plus; 1:minus');
            $table->tinyInteger('transaction_type')->comment('recharge/withdraw');
            $table->bigInteger('money');
            $table->timestamps();
        });
    }

    public function down()
    {
         Schema::dropIfExists('wallet_transactions');
    }
}
