<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNamedbsTable extends Migration
{
    public function up()
    {
        Schema::create('namedbs', function (Blueprint $table) {
            $table->id();
            $table->string('name_t');
            $table->string('name_v');
            $table->timestamps();
        });
    }

    public function down()
    {
         Schema::dropIfExists('namedbs');
    }
}
