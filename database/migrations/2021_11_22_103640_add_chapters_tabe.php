<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChaptersTabe extends Migration
{
    public function up()
    {
        Schema::table('chapters', function (Blueprint $table) {
            $table->text('host')->nullable();
            $table->text('idhost')->nullable();
            $table->text('idchap')->nullable();

        });
    }

    public function down()
    {
        Schema::table('chapters', function (Blueprint $table) {
            $table->dropColumn('host');
            $table->dropColumn('idhost');
            $table->dropColumn('idchap');
        });
    }
}
