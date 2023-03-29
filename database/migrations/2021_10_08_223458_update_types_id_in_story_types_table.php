<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTypesIdInStoryTypesTable extends Migration
{
    public function up()
    {
        Schema::table('story_types', function (Blueprint $table) {
            $table->dropForeign(['types_id']);
            $table->foreign('types_id')->references('id')->on('types')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('story_types', function (Blueprint $table) {
            $table->dropForeign(['types_id']);
            $table->foreign('types_id')->references('id')->on('types')->onDelete('cascade');
        });
    }
}
