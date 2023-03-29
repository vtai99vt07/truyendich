<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnCreatedByWallets extends Migration
{
    public function up()
    {
        Schema::table('wallets', function (Blueprint $table) {
            $table->dropColumn('gold');
            $table->dropColumn('silver');
            $table->dropColumn('vnd');
        });
    }

    public function down()
    {
        Schema::table('wallets', function (Blueprint $table) {
            $table->bigInteger('gold');
            $table->bigInteger('silver');
            $table->bigInteger('vnd');
        });
    } 
}
