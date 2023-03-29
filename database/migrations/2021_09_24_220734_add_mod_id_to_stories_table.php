<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddModIdToStoriesTable extends Migration
{
    public function up()
    {
        Schema::table('stories', function (Blueprint $table) {
            $table->bigInteger('mod_id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('stories', function (Blueprint $table) {
            $table->dropColumn('mod_id');
        });
    }
}
