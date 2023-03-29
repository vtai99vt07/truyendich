<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStoriesTables extends Migration
{
    public function up()
    {
        Schema::table('stories', function (Blueprint $table) {
         $table->integer('whishlist_count')->default(0);
         $table->integer('follow_count')->default(0);
         $table->timestamp('chapter_updated')->nullable();
        });
    }

    public function down()
    {
        Schema::table('stories', function (Blueprint $table) {
            $table->dropColumn('follow_count');
            $table->dropColumn('whishlist_count');
            $table->timestamp('chapter_updated')->nullable();
        });
    }
}
