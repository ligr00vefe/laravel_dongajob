<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoardReviewParticipatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('board_review_participates', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger("status_id")->comment("공지글 (0 : 일반, 1: 공지) ")->nullable()->default(0);
            $table->string("subject")->comment("제목");
            $table->longText("contents")->comment("내용");
            $table->string("account")->comment("학번 or 관리자 ID");
            $table->smallInteger("user_type")->comment("1:학생 2: 관리자");
            $table->integer("hit")->comment("조회수")->default(0)->nullable();
            $table->integer("attachment1")->comment("첨부파일1")->nullable();
            $table->integer("attachment2")->comment("첨부파일2")->nullable();
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
        Schema::dropIfExists('board_review_participates');
    }
}
