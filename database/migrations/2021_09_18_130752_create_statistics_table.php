<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticsTable extends Migration
{
    public function up()
    {
        Schema::create('statistics', function (Blueprint $table) {
            $table->id();
            $table->unsignedDecimal('money', 14, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
         Schema::dropIfExists('statistics');
    }
}
