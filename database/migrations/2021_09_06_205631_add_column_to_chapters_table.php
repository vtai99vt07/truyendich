<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToChaptersTable extends Migration
{
    public function up()
    {
        Schema::table('chapters', function (Blueprint $table) {
            $table->string('link_other')->nullable();
            $table->bigInteger('mod_id')->nullable();
            $table->bigInteger('user_id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('chapters', function (Blueprint $table) {
            $table->dropColumn('link_other');
            $table->dropColumn('mod_id');
            $table->dropColumn('user_id');
        });
    }
}
