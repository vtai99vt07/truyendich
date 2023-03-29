<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStoriesTabe extends Migration
{
    public function up()
    {
        Schema::table('stories', function (Blueprint $table) {
         $table->text('host')->nullable();
         $table->text('idhost')->nullable();
        });
    }

    public function down()
    {
        Schema::table('stories', function (Blueprint $table) {
            $table->dropColumn('host');
            $table->dropColumn('idhost');
        });
    }
}
