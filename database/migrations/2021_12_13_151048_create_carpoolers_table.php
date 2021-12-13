<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarpoolersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carpoolers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('start_datetime');
            $table->string('origin', 100);
            $table->double('latitude_from');
            $table->double('longitude_from');
            $table->string('destination', 100);
            $table->double('latitude_to');
            $table->double('longitude_to');
            $table->tinyInteger('status')->unsigned()->default(1)->comment('ステータス : 1 : 承認待ち : 2 : 承認済み : 3 :拒否');
            $table->integer('user_id')->unsigned();
            $table->integer('driver_post_id')->unsigned();
            $table->integer('chat_room_id')->unsigned()->nullable();
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
        Schema::dropIfExists('carpoolers');
    }
}
