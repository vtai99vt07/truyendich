<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWinTable extends Migration
{
    public function up()
    {
        Schema::create('win', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('number');
            $table->string('winner');
            $table->bigInteger('gold');
            $table->timestamps();
        });
    }

    public function down()
    {
         Schema::dropIfExists('win');
    }
}
