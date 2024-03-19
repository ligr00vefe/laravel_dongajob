<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoardInterviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('board_interviews', function (Blueprint $table) {
            $table->id();
            $table->string("enterprise")->comment("지원기업");
            $table->string("category")->comment("지원구분(신입:100, 인턴:200, 채용형인턴:300, 체험형인턴:400)");
            $table->string("support_division")->comment("지원사업부");
            $table->string("support_job")->nullable()->comment("지원직무");
            $table->string("next_round")->comment("다음전형 1차면접, 2차면접, 통합면접");
            $table->string("next_round_schedule")->comment("다음전형일정");
            $table->longText("contents")->comment("내용")->nullable();
            $table->string("user_id")->comment("아이디");
            $table->string("status")->comment("합격여부")->default('100');
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
        Schema::dropIfExists('board_interviews');
    }
}
