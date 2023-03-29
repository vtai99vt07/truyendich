<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tuluyen extends Migration
{
    public function up()
    {
        // Schema::create('players_charater',function (Blueprint $table){
        //     $table->uuid('id')->primary();
        //     $table->unsignedBigInteger('user_id');
        //     $table->tinyInteger('class',false,true);
        //     $table->tinyInteger('gioi_tinh',false,true);
        //     $table->integer('level',false,true)->default(1);
        //     $table->bigInteger('exp',false,true)->default(0);
        //     $table->bigInteger('max_exp',false,true)->default(500);
        //     $table->double('linh_thach',14,2)->default(0);
        //     $table->tinyInteger('level_ruong',false,true)->default(1);
        //     $table->integer('ruong_slot',false,true)->default(10);
        //     $table->unsignedBigInteger('point')->default(0);
        //     $table->unsignedBigInteger('total_point')->default(0);
        //     $table->double('str', 14,2)->default(0);
        //     $table->double('sum_str', 14,2)->default(0);
        //     $table->double('agi', 14,2)->default(0);
        //     $table->double('sum_agi', 14,2)->default(0);
        //     $table->double('ene', 14,2)->default(0);
        //     $table->double('sum_ene', 14,2)->default(0);
        //     $table->double('vit', 14,2)->default(0);
        //     $table->double('sum_vit', 14,2)->default(0);
        //     $table->double('hp', 16,2)->default(0);
        //     $table->double('sum_hp', 16,2)->default(0);
        //     $table->double('max_hp', 16,2)->default(0);
        //     $table->double('sum_max_hp', 16,2)->default(0);
        //     $table->double('hp_regen', 6,4)->default(0.01);
        //     $table->double('sum_hp_regen', 6,4)->default(0);
        //     $table->double('mp', 16,2)->default(0);
        //     $table->double('sum_mp', 16,2)->default(0);
        //     $table->double('max_mp', 16,2)->default(0);
        //     $table->double('sum_max_mp', 16,2)->default(0);
        //     $table->double('mp_regen', 6,4)->default(0.01);
        //     $table->double('sum_mp_regen', 6,4)->default(0);
        //     $table->double('can_co', 6,2)->default(1);
        //     $table->double('sum_can_co', 6,2)->default(0);
        //     $table->double('atk',14,2)->default(0);
        //     $table->double('sum_atk',14,2)->default(0);
        //     $table->double('def',14,2)->default(0);
        //     $table->double('sum_def',14,2)->default(0);
        //     $table->double('atk_speed', 10,4)->default(1);
        //     $table->double('sum_atk_speed', 10,4)->default(0);
        //     $table->double('move_speed', 10,4)->default(0);
        //     $table->double('sum_move_speed', 10,4)->default(0);
        //     $table->double('crit', 10,4)->default(0);
        //     $table->double('sum_crit', 10,4)->default(0);
        //     $table->double('crit_dmg', 10,4)->default(0);
        //     $table->double('sum_crit_dmg', 10,4)->default(0);
        //     $table->double('dodge', 10,4)->default(0);
        //     $table->double('sum_dodge', 10,4)->default(0);
        //     $table->double('block', 10,4)->default(0);
        //     $table->double('sum_block', 10,4)->default(0);
        //     $table->double('block_dmg', 10,4)->default(0);
        //     $table->double('sum_block_dmg', 10,4)->default(0);
        //     $table->double('luk', 10,4)->default(1);
        //     $table->double('sum_luk', 10,4)->default(0);
        //     $table->boolean('is_online')->default(true);
        //     $table->boolean('is_banned')->default(false);
        //     $table->boolean('is_muted')->default(false);
        //     $table->boolean('is_admin')->default(false);
        //     $table->boolean('is_ruong')->default(false);
        //     $table->boolean('is_collect')->default(false);
        //     $table->boolean('is_level_up')->default(false);
        //     $table->boolean('is_vip')->default(false);
        //     $table->integer('vip_exp',false,true)->default(0);
        //     $table->integer('vip_level',false,true)->default(0);
        //     $table->dateTime('time_vip')->nullable();
        //     $table->dateTime('time_banned')->nullable();
        //     $table->dateTime('time_muted')->nullable();
        //     $table->dateTime('time_next_collect')->nullable();
        //     $table->dateTime('time_last_collect')->nullable();
        //     $table->dateTime('time_last_online')->nullable();
        //     $table->bigInteger('time_online',false,true)->default(0);
        //     $table->bigInteger('reset', false, true)->default(0);
        //     $table->bigInteger('relife', false, true)->default(0);
        //     $table->integer('chien_bao',false,true)->default(0);
        //     $table->json('orthers')->nullable();
        //     $table->timestamps();
        //     $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        // });

        // Schema::create('players_items_options',function (Blueprint $table){
        //     $table->id();
        //     $table->string('name', 255);
        //     $table->string('stat', 255);
        //     $table->boolean('is_percent')->default(false)->comment('bằng true thì sẽ tính theo % của giá trị stat');
        //     $table->boolean('is_mul')->default(false)->comment('bằng true thì sẽ nhân với giá trị');
        //     $table->boolean('is_mp')->default(false)->comment('bằng true thì sẽ thêm tên mp lúc string format');
        // });

        // Schema::create('players_items',function (Blueprint $table){
        //     $table->uuid('id')->primary();
        //     $table->uuid('player_id');
        //     $table->uuid('player_create')->index();
        //     $table->integer('item_id',false,true);
        //     $table->tinyInteger('type',false,true)->default(0);
        //     $table->tinyInteger('level',false,true)->default(0);
        //     $table->tinyInteger('rare',false,true)->default(0);
        //     $table->integer('stack',false,true)->default(1);
        //     $table->integer('max_stack',false,true)->default(255);
        //     $table->boolean('is_stack')->default(false)->comment('nếu bằng true thì sẽ + item lại với nhau');
        //     $table->tinyInteger('required_class',false,true)->default(0);
        //     $table->tinyInteger('required_level',false,true)->default(0);
        //     $table->tinyInteger('required_reset',false,true)->default(0);
        //     $table->tinyInteger('required_relife',false,true)->default(0);
        //     $table->boolean('is_equiped')->default(false);
        //     $table->boolean('is_active')->default(false);
        //     $table->boolean('is_daugia')->default(false);
        //     $table->boolean('is_locked')->default(false);
        //     $table->boolean('is_broken')->default(false);
        //     $table->tinyInteger('type_action')->default(1);
        //     $table->tinyInteger('type_buff')->unsigned()->default(0);
        //     $table->boolean('is_dell')->default(true);
        //     $table->json('orthers')->nullable();
        //     $table->timestamps();
        //     $table->index([
        //         'item_id','player_id','type','rare'
        //     ],'search_item_stack');
        //     $table->foreign('player_id')->references('id')->on('players_charater')->onDelete('cascade');

        // });
        // Schema::create('players_tmp_options',function (Blueprint $table){

        //     $table->uuid('item_id');
        //     $table->bigInteger('options')->unsigned();
        //     $table->double('value', 10,4)->default(0);
        //     $table->double('add_value', 10,4)->default(0);
        //     $table->timestamps();
        //     $table->foreign('item_id')->references('id')->on('players_items')->onDelete('cascade');
        //     $table->foreign('options')->references('id')->on('players_items_options')->onDelete('cascade');
        //     $table->primary(['item_id','options']);
        // });

    }


    public function down()
    {
        // Schema::dropIfExists('players_tmp_options');
        // Schema::dropIfExists('players_items_options');
        // Schema::dropIfExists('players_items');
        // Schema::dropIfExists('players_charater');



    }
}
