<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDonateTable extends Migration
{
    public function up()
    {
        Schema::table('donate', function (Blueprint $table) {
            $table->string('stories_id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('donate', function (Blueprint $table) {
            $table->dropColumn('stories_id');
        });
    }
}
