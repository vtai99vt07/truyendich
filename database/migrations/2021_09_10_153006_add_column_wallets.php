<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnWallets extends Migration
{
    public function up()
    {
        Schema::table('wallets', function (Blueprint $table) {
            $table->unsignedDecimal('gold', 14, 2)->default(0);
            $table->unsignedDecimal('silver', 14, 2)->default(0);
            $table->unsignedDecimal('vnd', 14, 2)->default(0);
        });
    }

    public function down()
    {
        Schema::table('wallets', function (Blueprint $table) {
            $table->dropColumn('gold');
            $table->dropColumn('silver');
            $table->dropColumn('vnd');
        });
    }
}
