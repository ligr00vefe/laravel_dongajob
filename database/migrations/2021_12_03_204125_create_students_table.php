<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //--- 임시용 학생 데이터
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('account')->unique();
            $table->string('name');
            $table->string('university');
            $table->string('department');
            $table->string('grade')->comment('학년');
            $table->string('academic');
            $table->string('phone_number');
            $table->string('number')->nullable();
            $table->string('email')->nullable();
            $table->string('year')->comment('생년월일')->nullable();
            $table->smallInteger('gender')->comment('성별 1:남 2:여')->nullable();
            $table->string('line')->comment('계열')->nullable();
            $table->string('grade_score')->comment('학점')->nullable();
            $table->string('type')->comment('구분 ex) 학사')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('students');
    }
}
