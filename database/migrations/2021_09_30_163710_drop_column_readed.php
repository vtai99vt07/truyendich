<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnReaded extends Migration
{
    public function up()
    {
     Schema::drop('readed');
    }
}
