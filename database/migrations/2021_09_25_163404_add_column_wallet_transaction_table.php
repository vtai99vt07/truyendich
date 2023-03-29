<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnWalletTransactionTable extends Migration
{
     public function up()
     {
         Schema::table('wallet_transactions', function (Blueprint $table) {
             $table->integer('undo')->default(0);
         });
     }
 }
 