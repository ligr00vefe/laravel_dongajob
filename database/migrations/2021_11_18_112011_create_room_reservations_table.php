<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_reservations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("room_id")->comment("스터디룸 id");
            $table->smallInteger("campus_id")->nullable()->comment("1: 승학, 2: 부민");
            $table->smallInteger("target_type")->comment("1:학생, 2:관리자");
            $table->string("use_people")->comment("사용인원");
            $table->string("use_purpose")->comment("사용목적");
            $table->string("office_equipment")->comment("사무기기");
            $table->string("location")->comment("장소");
            $table->smallInteger("status")->comment("무단 미사용 체크 -> 0:사용전, 1:사용완료, 2:미사용")->default(0);
            $table->string("date")->comment("예약 날짜 Y-m-d");
            $table->string("ip")->comment("아이피")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_reservations');
    }
}
