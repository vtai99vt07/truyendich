<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnOrderTables extends Migration
{
    public function up()
     {
         Schema::table('orders', function (Blueprint $table) { 
          $table->bigInteger('total_money_per_chapter')->default(0);
          $table->bigInteger('total_order_per_chapter')->default(0);
     });
     }
 
     public function down()
     {
         Schema::table('orders', function (Blueprint $table) {  
             $table->dropColumn('total_money_per_chapter');
             $table->dropColumn('total_order_per_chapter');
         });
     }
 }
 