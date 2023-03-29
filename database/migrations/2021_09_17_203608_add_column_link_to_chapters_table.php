<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnLinkToChaptersTable extends Migration
{
    public function up()
    {
        Schema::table('chapters', function (Blueprint $table) {
            $table->string('embed_link')->nullable();
        });
    }

    public function down()
    {
        Schema::table('chapters', function (Blueprint $table) {
            $table->dropColumn('embed_link');
        });
    }
}
