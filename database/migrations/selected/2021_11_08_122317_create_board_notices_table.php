<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoardNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('board_notices', function (Blueprint $table) {
            $table->id();
            $table->string("user_id")->comment("유저 아이디")->nullable();
            $table->tinyInteger("status_id")->comment("1:공지 2:모집")->comment("공지글 (0 : 일반, 1: 공지, 2: 모집) ")->nullable()->default(0);
            $table->string("category_id")->comment("카테고리 아이디");
            $table->string("subject")->comment("제목");
            $table->date("schedule_date")->comment("일정 출력시킬 날짜")->nullable();
            $table->integer("hit")->comment("조회수")->default(0)->nullable();
            $table->longText("contents")->comment("내용");
            $table->integer("editor_image")->comment("에디터 이미지")->nullable();
            $table->integer("attachment1")->comment("첨부파일1")->nullable();
            $table->integer("attachment2")->comment("첨부파일2")->nullable();
            $table->integer("attachment3")->comment("첨부파일3")->nullable();
            $table->integer("attachment4")->comment("첨부파일4")->nullable();
            $table->integer("attachment5")->comment("첨부파일5")->nullable();
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
        Schema::dropIfExists('board_notices');
    }
}
