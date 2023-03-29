<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnWithdrawTransactions extends Migration
{
    public function up()
    {
        Schema::table('withdraw_transactions', function (Blueprint $table) {
            $table->text('name')->nullable();
        });
    }
}
