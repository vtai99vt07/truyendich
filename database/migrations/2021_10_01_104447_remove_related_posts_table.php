<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveRelatedPostsTable extends Migration
{
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('related_posts');
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->json('related_posts')->nullable();
        });
    }
}
