<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChaptersTable extends Migration
{
    public function up()
    {
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('story_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->tinyInteger('is_vip')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->bigInteger('price')->default(0);
            $table->bigInteger('view')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
         Schema::dropIfExists('chapters');
    }
}
