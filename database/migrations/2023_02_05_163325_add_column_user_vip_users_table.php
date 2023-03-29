<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnUserVipUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->tinyInteger('user_vip')->default(0)->comment('0:normal,1: tài khoản vip');
        });
    }
    public function down()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->dropColumn('user_vip');
        });
    }
}
