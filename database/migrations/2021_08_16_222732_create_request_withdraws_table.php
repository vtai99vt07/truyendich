<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestWithdrawsTable extends Migration
{
    public function up()
    {
        Schema::create('request_withdraws', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('silver');
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    public function down()
    {
         Schema::dropIfExists('request_withdraws');
    }
}
