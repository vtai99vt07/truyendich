<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChangeCollumUploadNamesTable extends Migration
{
    public function up()
    {
        Schema::table('uploadedname', function (Blueprint $table) {
            $table->string('host')->change();
        });
    }
}
