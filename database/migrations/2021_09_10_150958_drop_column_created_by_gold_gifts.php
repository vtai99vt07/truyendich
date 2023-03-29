<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnCreatedByGoldGifts extends Migration
{
    public function up()
    {
        Schema::table('gold_gifts', function (Blueprint $table) {
            $table->dropColumn('gold');
        });
    }

    public function down()
    {
        Schema::table('gold_gifts', function (Blueprint $table) {
            $table->bigInteger('gold');
        });
    }
}
