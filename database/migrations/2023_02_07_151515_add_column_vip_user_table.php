<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnVipUserTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dateTime('vip_registration_date')->nullable(true);
            $table->dateTime('vip_expired_date')->nullable(true);
        });
    }
}
