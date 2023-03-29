<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableGiftAds extends Migration
{
    public function up()
    {
        Schema::create('gift_ads', function (Blueprint $table) {
            $table->id();
            $table->integer('sum_joined')->default(0);
            $table->float('gold')->default(0);
            $table->integer('stone')->default(0);
            $table->timestamps();
        });
    }
}
