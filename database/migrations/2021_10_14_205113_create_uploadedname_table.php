<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadednameTable extends Migration
{
    public function up()
    {
        Schema::create('uploadedname', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('host');
            $table->bigInteger('book_id');
            $table->bigInteger('user_id');
            $table->text('data');
            $table->integer('length');
            $table->dateTime('time');
        });
    }

    public function down()
    {
         Schema::dropIfExists('uploadedname');
    }
}
