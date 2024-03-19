<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoardRecommendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('board_recommends', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->comment('기업명');
            $table->string('recruitment_field')->comment('모집분야');
            $table->string('category')->comment('채용형태');
            $table->string('homepage')->comment('홈페이지')->nullable();
            $table->string('work_area')->comment('근무지역');
            $table->string('screening_method')->comment('전형방법');
            $table->longText('contents')->comment('내용');
            $table->string('receipt_start_date')->comment('접수시작일');
            $table->string('receipt_start_time')->comment('접수시작시간');
            $table->string('receipt_end_date')->comment('접수마감일');
            $table->string('receipt_end_time')->comment('접수마감시간');
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
        Schema::dropIfExists('board_recommends');
    }
}
