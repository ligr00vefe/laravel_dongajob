<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomReservationDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_reservation_dates', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("reservation_id")->comment("room_reservations id");
            $table->string("time")->comment("시간대 ex) 11:00");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_reservation_dates');
    }
}
