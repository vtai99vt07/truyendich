<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnLogSearchsTable extends Migration
{
    public function up()
    {
        Schema::table('log_searchs', function (Blueprint $table) {
            $table->bigInteger('user_id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('log_searchs', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
