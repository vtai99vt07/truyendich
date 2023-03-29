<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateReadedTable extends Migration
{
    public function up()
    {
        Schema::table('readed', function (Blueprint $table) {
            $table->dropColumn('view_story_per_day');
            $table->dropColumn('chapter_id');
            $table->longText('chapters_id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('stories', function (Blueprint $table) {
            $table->integer('view_story_per_day')->default(0);
            $table->bigInteger('chapter_id')->nullable();
            $table->dropColumn('chapters_id');
        });
    }
}
