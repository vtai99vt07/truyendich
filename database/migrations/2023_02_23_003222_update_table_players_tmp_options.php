<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTablePlayersTmpOptions extends Migration
{
    public function up()
    {
        Schema::table('players_tmp_options', function (Blueprint $table) {
            $table->dropForeign(['options']);
            $table->dropForeign(['item_id']);
        });
    }
}
