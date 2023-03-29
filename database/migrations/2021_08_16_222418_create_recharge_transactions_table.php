<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRechargeTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('recharge_transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('recharge_package_id');
            $table->tinyInteger('status')->default(0);
            $table->string('code');
            $table->timestamps();
        });
    }

    public function down()
    {
         Schema::dropIfExists('recharge_transactions');
    }
}
