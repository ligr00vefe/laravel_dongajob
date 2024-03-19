<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoardActivitysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('board_activitys', function (Blueprint $table) {
            $table->id();
            $table->string("company_name")->comment("기업명");
            $table->string("zip_field")->comment("우편번호")->nullable()->default(0);
            $table->string("addr_field1")->comment("주소")->nullable();
            $table->string("addr_field2")->comment("상세주소")->nullable();
            $table->string("tel_field")->comment("전화번호")->nullable();
            $table->string("phone_field")->comment("휴대전화");
            $table->string("email_field1")->comment("이메일1")->nullable();
            $table->string("email_field2")->comment("이메일2")->nullable();
            $table->string("recruitment_field")->comment("채용분야")->nullable();
            $table->string("recruitment_number")->comment("모집인원")->nullable();
            $table->string("work_area")->comment("근무지역")->nullable();
            $table->string("workday_field")->comment("근무기간")->nullable();
            $table->string("pay_field")->comment("급여")->nullable();
            $table->string("gender_field")->comment("성별")->nullable()->default(100);
            $table->string("age_field")->comment("나이")->nullable();
            $table->string("way_field")->comment("접수방법")->nullable();
            $table->string('receipt_end_date')->comment('접수마감일')->nullable();
            $table->string('receipt_end_time')->comment('접수마감시간')->nullable();
            $table->string("homepage")->comment("홈페이지")->nullable();
            $table->longText("contents")->comment("내용");
            $table->integer("attachment1")->comment("첨부파일1")->nullable();
            $table->integer("attachment2")->comment("첨부파일2")->nullable();
            $table->integer("attachment3")->comment("첨부파일3")->nullable();
            $table->integer("attachment4")->comment("첨부파일4")->nullable();
            $table->integer("attachment5")->comment("첨부파일5")->nullable();
            $table->integer("user_id")->comment("글쓴이");
            $table->integer("hit")->comment("조회수")->nullable()->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('board_activitys');
    }
}
