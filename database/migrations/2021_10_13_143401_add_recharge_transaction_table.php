<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRechargeTransactionTable extends Migration
{
    public function up()
     {
         Schema::table('recharge_transactions', function (Blueprint $table) { 
          $table->bigInteger('type')->default(0);
     });
     }
 
     public function down()
     {
         Schema::table('recharge_transactions', function (Blueprint $table) {  
             $table->dropColumn('type');
         });
     }
 }
 