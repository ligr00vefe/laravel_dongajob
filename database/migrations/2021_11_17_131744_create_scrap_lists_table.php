<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScrapListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scrap_lists', function (Blueprint $table) {
            $table->id();
            $table->string('account');
            $table->string('board_title')->comment('게시판 명');
            $table->string('board_id')->comment('게시판 id');
            $table->string('subject')->comment('제목');
            $table->string('url')->comment('경로');
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
        Schema::dropIfExists('scrap_lists');
    }
}
