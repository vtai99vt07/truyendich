<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderToChaptersTable extends Migration
{
    public function up()
    {
        Schema::table('chapters', function (Blueprint $table) {
            $table->integer('order')->default(0);
            $table->timestamp('timer')->nullable();
        });
    }

    public function down()
    {
        Schema::table('chapters', function (Blueprint $table) {
            $table->dropColumn('order');
            $table->dropColumn('timer');
        });
    }
}
