<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoldGiftsTable extends Migration
{
    public function up()
    {
        Schema::create('gold_gifts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('gold');
            $table->bigInteger('received_id');
            $table->timestamps();
        });
    }

    public function down()
    {
         Schema::dropIfExists('gold_gifts');
    }
}
