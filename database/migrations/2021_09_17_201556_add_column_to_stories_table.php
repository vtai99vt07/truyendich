<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToStoriesTable extends Migration
{
    public function up()
    {
        Schema::table('stories', function (Blueprint $table) {
            $table->string('author')->nullable();
            $table->string('author_vi')->nullable();
            $table->string('name_chines')->nullable();
        });
    }

    public function down()
    {
        Schema::table('stories', function (Blueprint $table) {
            $table->dropColumn('author');
            $table->dropColumn('author_vi');
            $table->dropColumn('name_chines');
        });
    }
}
