<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameTable extends Migration
{
    public function up()
    {
        Schema::create('game', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('number');
            $table->bigInteger('gold');
            $table->timestamps();
        });
    }

    public function down()
    {
         Schema::dropIfExists('game');
    }
}
