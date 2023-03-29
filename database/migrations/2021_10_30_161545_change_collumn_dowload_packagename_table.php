<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCollumnDowloadPackagenameTable extends Migration
{
    public function up()
    {
        Schema::table('packagename', function (Blueprint $table) {
            $table->integer('download')->nullable()->change();
        });
    }
}
