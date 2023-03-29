<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoryTable extends Migration
{
    public function up()
    {
        Schema::create('stories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->bigInteger('user_id');
            $table->text('categories_id');
            $table->text('tags_id');
            $table->tinyInteger('type')->default(0)->comment('0: truyện viết; 1: truyện nhúng');
            $table->tinyInteger('is_vip')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->string('origin')->nullable();
            $table->text('related_stories')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
         Schema::dropIfExists('stories');
    }
}
