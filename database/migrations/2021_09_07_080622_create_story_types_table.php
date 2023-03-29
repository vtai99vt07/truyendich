<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoryTypesTable extends Migration
{
    public function up()
    {
        Schema::create('story_types', function (Blueprint $table) {
            $table->foreignId('stories_id')->unsigned();
            $table->foreignId('types_id')->unsigned();
            $table->primary(['stories_id', 'types_id']);
            $table->foreign('stories_id')->references('id')->on('stories')->onDelete('cascade');
            $table->foreign('types_id')->references('id')->on('stories')->onDelete('cascade');
        });
    }

    public function down()
    {
         Schema::dropIfExists('story_types');
    }
}
