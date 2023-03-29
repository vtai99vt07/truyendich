<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('user_name');
            $table->tinyInteger('is_vip')->default(0)->comment('0: normal; 1: mod');
            $table->tinyInteger('status')->default(0);
            $table->string('avatar')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('user_name');
            $table->dropColumn('is_vip');
            $table->dropColumn('status');
            $table->dropColumn('gold');
            $table->dropColumn('silver');
            $table->dropColumn('avatar');
        });
    }
}
