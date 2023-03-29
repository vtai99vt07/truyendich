<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNotificationsTable extends Migration
{
     public function up()
     {
         Schema::table('notifications', function (Blueprint $table) { 
          $table->bigInteger('story_id');
          $table->bigInteger('count');
          $table->text('link');
     });
     }
 
     public function down()
     {
         Schema::table('notifications', function (Blueprint $table) {  
             $table->dropColumn('story_id');
             $table->dropColumn('count');
             $table->dropColumn('link');
         });
     }
 }
 