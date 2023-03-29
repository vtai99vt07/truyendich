<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('parent_id')->default(0);
            $table->bigInteger('blog_id')->comment('story_id/profile_id');
            $table->longText('content');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('type')->default(0)->comment('0: story; 1:profile');
            $table->timestamps();
        });
    }

    public function down()
    {
         Schema::dropIfExists('comments');
    }
}
