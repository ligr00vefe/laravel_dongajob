<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomReservationStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_reservation_students', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("reservation_id")->comment("room_reservations id");
            $table->smallInteger("type")->comment("1: 예매자, 2: 동반자");
            $table->string("account")->comment("학생id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_reservation_students');
    }
}
