<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableGiftAdsUsers extends Migration
{
    public function up()
    {
        Schema::create('gift_ads_users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable(false);
            $table->bigInteger('gift_ads_id')->nullable(false);
            $table->text('ip')->nullable();
            $table->tinyInteger('earned')->default(0);
            $table->timestamps();
        });
    }
}
