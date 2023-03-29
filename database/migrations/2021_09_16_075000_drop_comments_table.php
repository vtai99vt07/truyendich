<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropCommentsTable extends Migration
{
    public function up()
    {
        Schema::drop('comments');
    }
    public function down()
    {
         Schema::dropIfExists('comments');
    }
}
