<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomPreventionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_preventions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('명칭');
            $table->string('phrases')->comment('문구');
            $table->date('day')->comment('예약시작금지날짜');
            $table->date('end_day')->comment('예약종료금지날짜');
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
        Schema::dropIfExists('room_preventions');
    }
}
