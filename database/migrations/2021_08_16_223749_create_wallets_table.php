<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration
{
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('gold')->default(0);
            $table->bigInteger('silver')->default(0);
            $table->bigInteger('vnd')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
         Schema::dropIfExists('wallets');
    }
}
