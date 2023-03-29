<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWhishlistsTable extends Migration
{
    public function up()
    {
        Schema::create('whishlist', function (Blueprint $table) {
            $table->foreignId('stories_id')->unsigned();
            $table->foreignId('user_id')->unsigned();
            $table->primary(['stories_id', 'user_id']);
            $table->foreign('stories_id')->references('id')->on('stories')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
         Schema::dropIfExists('whishlist');
    }
}
