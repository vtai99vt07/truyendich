<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDobUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->date('dob')->nullable();
        });
    }
    public function down()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->dropColumn('dob');
        });
    }

}
