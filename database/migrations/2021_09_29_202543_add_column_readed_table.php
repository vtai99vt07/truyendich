<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnReadedTable extends Migration
{
     public function up()
    {
        Schema::table('readed', function (Blueprint $table) {
          $table->timestamps();
        });
     }
}
