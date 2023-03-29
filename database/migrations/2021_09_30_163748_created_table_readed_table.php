<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatedTableReadedTable extends Migration
{
     public function up()
     {
            Schema::create('readed', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('stories_id')->nullable();
                $table->bigInteger('user_id')->nullable();
                $table->bigInteger('chapter_id')->nullable();
                $table->bigInteger('view_story_per_day')->nullable();
                $table->timestamps();
        });
    }
 
     public function down()
     {
          Schema::dropIfExists('readed');
     }
 }
 