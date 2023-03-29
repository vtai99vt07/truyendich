<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnOrderTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->bigInteger('total_all_price')->default(0);
            $table->bigInteger('total_all_chapter')->default(0);
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('total_all_price');
            $table->dropColumn('total_all_chapter');
        });
    }
}
