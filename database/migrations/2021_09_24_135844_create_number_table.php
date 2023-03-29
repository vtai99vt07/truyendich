<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNumberTable extends Migration
{
    public function up()
    {
        Schema::create('number', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('number');
            $table->timestamps();
        });
    }

    public function down()
    {
         Schema::dropIfExists('number');
    }
}
