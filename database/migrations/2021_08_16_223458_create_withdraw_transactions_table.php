<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('withdraw_transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('silver');
            $table->bigInteger('money_current_wallet');
            $table->string('code');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
         Schema::dropIfExists('withdraw_transactions');
    }
}
