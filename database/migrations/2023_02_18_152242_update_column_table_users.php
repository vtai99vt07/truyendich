<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColumnTableUsers extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('top_dedication')->default(0);
            $table->tinyInteger('top_gold')->default(0);
            $table->tinyInteger('top_training')->default(0);
            $table->tinyInteger('top_master')->default(0);
            $table->tinyInteger('top_atk')->default(0);
            $table->tinyInteger('top_def')->default(0);
        });
    }
}
