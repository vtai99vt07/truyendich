<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnGoldGifts extends Migration
{
    public function up()
    {
        Schema::table('gold_gifts', function (Blueprint $table) {
            $table->unsignedDecimal('gold', 14, 2);
        });
    }

    public function down()
    {
        Schema::table('gold_gifts', function (Blueprint $table) {
            $table->dropColumn('gold');
        });
    }
}
