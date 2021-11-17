<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('start_datetime')->nullable()->default(null);
            $table->dateTime('end_datetime')->nullable()->default(null);
            $table->string('car_model', 50);
            $table->string('car_image', 100);
            $table->string('current_location', 100);
            $table->integer('distance')->unsigned();
            $table->tinyInteger('arrival_time');
            $table->string('request', 400);
            $table->tinyInteger('status')->unsigned()->default(1)->comment('ステータス : 1 : フリー : 2 : 予約済み : 3 :完了');
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('driver_posts');
    }
}
