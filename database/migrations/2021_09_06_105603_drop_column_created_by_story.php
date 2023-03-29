<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnCreatedByStory extends Migration
{
    public function up()
    {
        Schema::table('stories', function (Blueprint $table) {
            $table->dropColumn('categories_id');
            $table->dropColumn('tags_id');
        });
    }

    public function down()
    {
        Schema::table('stories', function (Blueprint $table) {
            $table->text('categories_id');
            $table->text('tags_id');
        });
    }
}
