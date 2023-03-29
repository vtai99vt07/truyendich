<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoryCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('story_categories', function (Blueprint $table) {
                $table->foreignId('stories_id')->unsigned();
                $table->foreignId('categories_id')->unsigned();
                $table->primary(['stories_id', 'categories_id']);
                $table->foreign('stories_id')->references('id')->on('stories')->onDelete('cascade');
                $table->foreign('categories_id')->references('id')->on('categories')->onDelete('cascade');
            });
    }

    public function down()
    {
         Schema::dropIfExists('story_categories');
    }
}
