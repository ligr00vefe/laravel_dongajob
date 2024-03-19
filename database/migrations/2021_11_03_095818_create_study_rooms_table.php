<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudyRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('study_rooms', function (Blueprint $table) {
            $table->id();
            $table->smallInteger("campus_id")->nullable()->comment("1: 승학, 2: 부민");
            $table->string("name")->nullable()->comment("스터디룸 명");
            $table->string("info_desc")->nullable()->comment("간단설명");
            $table->string("location")->nullable()->comment("장소");
            $table->string("operating_time")->nullable()->comment("운영시간");
            $table->string("time")->nullable()->comment("시간");
            $table->smallInteger("use")->nullable()->comment("사용가능여부 1:사용가능, 0:불가능");
            $table->string("max_personnel")->nullable()->comment("수용인원");
            $table->string("min_personnel")->nullable()->comment("최소신청");
            $table->string("office_equipment")->nullable()->comment("사무기기");
            $table->string("room_ip")->nullable()->comment("스터디룸 IP");
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
        Schema::dropIfExists('study_rooms');
    }
}
