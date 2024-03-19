<?php

use App\Http\Controllers\Admin\AdminStatisticsController;
use App\Http\Controllers\AjaxBoardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\BoardReceiptController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasswordConfirmController;
use App\Http\Controllers\UserModifyController;
use App\Http\Controllers\IntroduceController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\EduCashController;
use App\Http\Controllers\EmploymentInfoController;
use App\Http\Controllers\QnAController;
use App\Http\Controllers\ToeicController;
use App\Http\Controllers\OnlineLectureController;
use App\Http\Controllers\AiController;
use App\Http\Controllers\CheckUpController;
use App\Http\Controllers\JobplanetController;
use App\Http\Controllers\StudyRoomController;
use \App\Http\Controllers\ScrapController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MainController::class, "index"])->name("main");
Route::get('/login', [LoginController::class, "index"]);
Route::post('/login', [LoginController::class, "login"])->name("login");
Route::post('/dongaLogin', [LoginController::class, "dongaLogin"])->name("dongaLogin");
Route::get('/logout', [LoginController::class, "logout"])->name("logout");
Route::get('/autoLogout', [LoginController::class, "autoLogout"]);
Route::get('/getType', [LoginController::class, "getType"]);
Route::get('/setPrivacy', [LoginController::class, "setPrivacy"]);
Route::get('/isPrivacy', [LoginController::class, "isPrivacy"]);
Route::get('/confirm', [PasswordConfirmController::class, "index"]);
Route::get('/user/modify', [UserModifyController::class, "index"]);



Route::get('/ajax/login/check', [LoginController::class, "check"]); // 로그인 되어 있는지 체크
Route::post('/ajax/student/search', [StudentController::class, 'search']); // 학생정보가져오기
Route::post('/ajax/user/search', [UserController::class, 'search']); // 학생정보가져오기


/* 취업지원실 */
/*구성원소개*/
Route::get('/support/introduce', [IntroduceController::class, "index"]);
/*찾아오시는길*/
Route::get('/support/location', [LocationController::class, "index"]);
/*취업교육기금*/
Route::get('/support/educash', [EduCashController::class, "index"]);
/*취업프로그램소개*/
Route::get('/support/employmentinfo', [EmploymentInfoController::class, "index"]);
/*QnA*/
Route::get('/support/qna', [QnAController::class, "index"]);


/* 온라인 컨텐츠 */
/*토익 토익스피캉 할인접수*/
Route::get('/online/toeic', [ToeicController::class, "index"]);
/*기업 직무 산업분석 인강*/
Route::get('/online/onlinelecture', [OnlineLectureController::class, "index"]);
/*AI자기소개서 작성 및 평가*/
Route::get('/online/ai', [AiController::class, "index"]);
/*AI자기소개서 작성 및 평가*/
Route::get('/online/checkup', [CheckUpController::class, "index"]);
/*잡플래닛 제휴대학 서비스*/
Route::get('/online/jobplanet', [JobplanetController::class, "index"]);



/* 취업지원실 프로그램 */



/* 취업자료실 */



/* 취업상담 */



/* 스터디룸 예약 */
Route::get('/studyroom', [StudyRoomController::class, "index"])->name('studyroom.index');
Route::get('/studyroom/list', [StudyRoomController::class, "list"]);
Route::get('/studyroom/view', [StudyRoomController::class, "view"]); // 뷰 페이지 메서드
Route::post('/studyroom', [StudyRoomController::class, "create"]); // 예약 메서드
Route::delete('/studyroom', [StudyRoomController::class, "destroy"]); //예약내역삭제

Route::get('/ajax/studyroom/get', [StudyRoomController::class, "get"]); // 스터디룸 가져오기
Route::get('/ajax/studyroom/room', [StudyRoomController::class, "room"]); // 스터디룸 내역 가져오기
Route::get('/ajax/studyroom/time', [StudyRoomController::class, "time"]); // 스터디룸 시간대 가져오기
Route::get('/ajax/studyroom/check', [StudyRoomController::class, "check"]); // 예약 체크
Route::get('/ajax/studyroom/list', [StudyRoomController::class, "room_list"]); // 스터디룸 리스트 가져오기
Route::get('/ajax/studyroom/possible', [StudyRoomController::class, "possible"]); // noshow 및 1주일 이내 예약 체크
Route::get('/ajax/studyroom/student', [StudyRoomController::class, "student"]); //예약한 가져오기


/*스크랩*/
Route::post('/scrap', [ScrapController::class, 'scrap']);


/*댓글*/
Route::resource("/comment", CommentController::class)->names([
    "store" => "comment.store",
    "create" => "comment.create",
    "edit" => "comment.edit",
]);

Route::delete('/comment/{id}', [\App\Http\Controllers\CommentController::class, 'destroy']);
Route::put('/comment/{id}', [\App\Http\Controllers\CommentController::class, 'update']);
Route::get('/comment/{id}/answer', [\App\Http\Controllers\CommentController::class, 'answer']);
Route::post('/comment/{id}/answer', [\App\Http\Controllers\CommentController::class, 'continuity']);

/*ajax*/
Route::get('/ajax/program/receipt/check', [\App\Http\Controllers\BoardReceiptController::class, 'check']);
Route::get('/ajax/worknet/employment', [\App\Http\Controllers\WorknetController::class, 'employment']);
Route::get('/ajax/board/notice', [AjaxBoardController::class, 'notice']);
Route::get('/ajax/board/review', [AjaxBoardController::class, 'review']);
Route::get('/ajax/board/recommend', [AjaxBoardController::class, 'recommend']);
Route::get('/ajax/board/jobs', [AjaxBoardController::class, 'jobs']);
Route::get('/ajax/board/activity', [AjaxBoardController::class, 'activity']);
Route::post('/ajax/cookie', [AjaxBoardController::class, 'setCookie']);


// 통계
Route::get('/ajax/statistics/visit', [AdminStatisticsController::class, 'visit']);
Route::get('/ajax/statistics/board', [AdminStatisticsController::class, 'board']);
Route::get('/ajax/statistics/member', [AdminStatisticsController::class, 'member']);




include_once("board.php");
include_once("mypage.php");
include_once("course.php");

