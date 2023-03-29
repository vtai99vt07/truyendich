<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnStoryTable extends Migration
{
    public function up()
    {
        Schema::table('stories', function (Blueprint $table) {
            $table->unsignedDecimal('donate', 14, 2)->default(0);
        });
    }

    public function down()
    {
        Schema::table('stories', function (Blueprint $table) {
            $table->dropColumn('donate');
        });
    }
}
