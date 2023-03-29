<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankAuto extends Migration
{
    public function up()
    {
        Schema::create('bank_auto', function (Blueprint $table) {
            $table->id();
            $table->text('tid')->nullable(false);
            $table->text('description')->nullable(false);
            $table->integer('amount')->default(0);
            $table->integer('cusum_balance')->default(0);
            $table->integer('user_id')->nullable(false);
            $table->timestamps();
        });
    }

    public function down()
    {
         Schema::dropIfExists('bank_auto');
    }
}
