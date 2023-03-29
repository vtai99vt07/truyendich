<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRechargePackagesTable extends Migration
{
    public function up()
    {
        Schema::create('recharge_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('vnd');
            $table->bigInteger('gold');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
         Schema::dropIfExists('recharge_packages');
    }
}
