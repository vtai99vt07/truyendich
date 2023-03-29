<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddViewToStoriesTable extends Migration
{
    public function up()
    {
        Schema::table('stories', function (Blueprint $table) {
            $table->integer('view_day')->default(0);
            $table->integer('view_week')->default(0);
        });
    }

    public function down()
    {
        Schema::table('stories', function (Blueprint $table) {
            $table->dropColumn('view_day');
            $table->dropColumn('view_week');
        });
    }
}
