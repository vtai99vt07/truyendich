<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagenameTable extends Migration
{
    public function up()
    {
        Schema::create('packagename', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('user_id');
            $table->text('content');
            $table->text('tag');
            $table->integer('download');
            $table->text('description');
            $table->timestamps();
        });
    }

    public function down()
    {
         Schema::dropIfExists('packagename');
    }
}
