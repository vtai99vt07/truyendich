<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChangeCollumStkWithdrawTransactionsTable extends Migration
{
    public function up()
    {
        Schema::table('withdraw_transactions', function (Blueprint $table) {
            $table->string('stk')->nullable()->change();
        });
    }
}
