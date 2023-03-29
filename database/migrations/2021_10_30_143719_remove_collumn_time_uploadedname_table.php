<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveCollumnTimeUploadednameTable extends Migration
{
    public function up()
    {
        Schema::table('uploadedname', function (Blueprint $table) {
            $table->dropColumn('time');
        });
    }

    public function down()
    {
        Schema::table('uploadedname', function (Blueprint $table) {
            $table->dateTime('time');
        });
    }
}
