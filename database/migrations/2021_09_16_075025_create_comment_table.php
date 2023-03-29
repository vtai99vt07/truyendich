<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('parent_id')->default(0);
            $table->bigInteger('commentable_id');
            $table->text('commentable_type')->nullable();
            $table->longText('body');
            $table->timestamps();
        });
    }
    public function down()
    {
         Schema::dropIfExists('comments');
    }
}
