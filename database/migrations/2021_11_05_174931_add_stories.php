<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStories extends Migration
{
    public function up()
   {
       Schema::table('stories', function (Blueprint $table) {
           $table->string('name')->index()->change();
//           DB::statement('ALTER TABLE stories ADD FULLTEXT `name` (`name`)'); //đánh index cho cột name
//           DB::statement('ALTER TABLE stories ENGINE = MyISAM'); // đánh index theo kiểu MyISam ngoài ra còn có kiểu InnoDB nếu không có dòng này cũng được mysql sẽ mặc định là index kiểu MyISAM nhé
       });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
       Schema::table('stories', function (Blueprint $table) {
           $table->string('name');
//           DB::statement('ALTER TABLE stories DROP INDEX name'); // khi chạy lệnh rollback thì làm điều ngược lại với thằng trên thế thôi
       });
   }
}
