<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramReservations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_reservations', function (Blueprint $table) {
            $table->id();
            $table->string("program_id")->comment("프로그램 아이디");
            $table->string("account")->comment("학번");
            $table->tinyInteger("status")->comment("1 :신청자 2: 대기자 ");
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
        Schema::dropIfExists('program_reservations');
    }
}
