<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoardProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('board_programs', function (Blueprint $table) {
            $table->id();
            $table->string("user_id")->comment("등록 아이디")->nullable();
            $table->string("subject")->comment("제목");
            $table->string("status")->comment("접수상태(0:접수대기, 1:접수중, 2:접수마감, 3:대기접수중, 4:대기접수마감)")->default(0);
            $table->string("open")->comment("공개여부, 0:비공개, 1:공개")->default(0);
            $table->string("teacher_name")->comment("강사명");
            $table->date("start_reception_date")->comment("접수시작일");
            $table->time("start_reception_time")->comment("접수시작시간");
            $table->date("end_reception_date")->comment("접수마감일");
            $table->time("end_reception_time")->comment("접수시마감시간");
            $table->date("start_course_date")->comment("수강시작일");
            $table->time("start_course_time")->comment("수강시작시간");
            $table->date("end_course_date")->comment("수강시작마감일");
            $table->time("end_course_time")->comment("수강마감시간");
            $table->string("location")->comment("수강장소")->nullable();
            $table->string("number_students")->comment("수강인원");
            $table->string("number_waiting")->comment("대기인원");
            $table->string("education_target")->comment("교육대상(전체:100, 재학생:200,졸업생:300,휴학생:400)");
            $table->string("student_grade")->comment("학년(전학년:10, 1학년:1, 2학년: 2, 3학년: 3, 4학년: 4)");
            $table->string("text_book")->comment("교재")->nullable();
            $table->string("tuition_fees")->comment("수강료")->nullable();
            $table->longText("contents")->comment("내용");
            $table->string("deadline_date")->comment("입금마감일")->nullable();
            $table->string("deadline_time")->comment("입금미감시간")->nullable();
            $table->string("bank_name")->comment("은행명")->nullable();
            $table->string("account_holder")->comment("예금주")->nullable();
            $table->string("account_number")->comment("계좌번호")->nullable();
            $table->integer("hit")->comment("조회수")->default(0)->nullable();
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
        Schema::dropIfExists('board_programs');
    }
}
