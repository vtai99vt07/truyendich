<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardTable extends Migration
{
    public function up()
    {
        Schema::create('card', function (Blueprint $table) {
            $table->id();
            $table->text('telco');
            $table->text('code');
            $table->text('serial');
            $table->text('user_id');
            $table->text('amount');
            $table->text('real_amount')->nullable();
            $table->text('gold');
            $table->integer('status')->default('0');
            $table->timestamps();
        });
    }

    public function down()
    {
         Schema::dropIfExists('card');
    }
}
