<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumFollows extends Migration
{
    public function up()
    {
     Schema::drop('follows');
    }
}
