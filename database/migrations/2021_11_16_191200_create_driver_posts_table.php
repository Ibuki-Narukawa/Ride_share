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
            $table->dateTime('start_datetime')->nullable();
            $table->dateTime('end_datetime')->nullable();
            $table->string('car_model', 50)->nullable();
            $table->string('car_image', 100)->nullable();
            $table->tinyInteger('max_passengers')->nullable();
            $table->string('current_location', 100)->nullable();
            $table->integer('distance')->unsigned()->nullable();
            $table->tinyInteger('arrival_time')->nullable();
            $table->string('asking', 500)->nullable();
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
