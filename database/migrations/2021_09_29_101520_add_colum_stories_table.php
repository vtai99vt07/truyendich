<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumStoriesTable extends Migration
{
     public function up()
     {
         Schema::table('stories', function (Blueprint $table) {
          $table->bigInteger('view')->default(0);
         });
     }
 
     public function down()
     {
         Schema::table('stories', function (Blueprint $table) {
             $table->dropColumn('view');
         });
     }
 }
 