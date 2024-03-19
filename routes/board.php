<?php

use App\Http\Controllers\BoardDonga300Controller;
use App\Http\Controllers\BoardActivityController;
use App\Http\Controllers\BoardRecommendController;
use App\Http\Controllers\BoardNormalController;
use App\Http\Controllers\BoardPickController;
use App\Http\Controllers\BoardNoticeController;
use App\Http\Controllers\BoardReceiptController;
use App\Http\Controllers\BoardInterviewController;
use App\Http\Controllers\BoardReviewLatestController;
use App\Http\Controllers\BoardReviewBeforeController;
use App\Http\Controllers\BoardReviewParticipateController;
use App\Http\Controllers\RecommendReservationController;


Route::prefix("/jobinfo/upload")->group(function () {
    Route::post("/editor/donga300", [Donga300Editor::class, "run"])->name("jobinfo.upload.editor.donga300");
    Route::post("/editor/activity", [ActivityEditor::class, "run"])->name("jobinfo.upload.editor.activity");
    Route::post("/editor/recommend", [RecommendEditor::class, "run"])->name("jobinfo.upload.editor.recommend");
    Route::post("/editor/normal", [NormalEditor::class, "run"])->name("jobinfo.upload.editor.normal");
    Route::post("/editor/pick", [PickEditor::class, "run"])->name("jobinfo.upload.editor.pick");
});

/*====================================   채용정보(jobinfo) 게시판   ============================================*/
/*추천채용*/
Route::get('/jobinfo/recommend', [BoardRecommendController::class, 'index']);
Route::post('/jobinfo/recommend', [BoardRecommendController::class, 'reservation'])->name("jobinfo.recommend.write");
Route::put('/jobinfo/recommend', [BoardRecommendController::class, 'update'])->name("jobinfo.recommend.update");
Route::get('/jobinfo/recommend/{id}/add', [BoardRecommendController::class, 'create']);
Route::get('/jobinfo/recommend/{id}/edit', [BoardRecommendController::class, 'edit']);
Route::get('/jobinfo/recommend/{id}/view/', [BoardRecommendController::class, 'view']);

/*동아친화기업300*/
Route::get('/jobinfo/donga300', [BoardDonga300Controller::class, 'index']);
//Route::get('/jobinfo/donga300/add', [BoardDonga300Controller::class, 'create']);
//Route::post('/jobinfo/donga300/write', [BoardDonga300Controller::class, 'store'])->name("jobinfo.donga300.write");
Route::get('/jobinfo/donga300/{id}/view', [BoardDonga300Controller::class, 'view']);

/*일반채용*/
Route::get('/jobinfo/normal', [BoardNormalController::class, 'index']);
//Route::get('/jobinfo/normal/add', [BoardNormalController::class, 'create']);
//Route::post('/jobinfo/normal/write', [BoardNormalController::class, 'store'])->name("jobinfo.normal.write");
Route::get('/jobinfo/normal/{id}/view', [BoardNormalController::class, 'view']);

/*각종활동*/
Route::get('/jobinfo/activity', [BoardActivityController::class, 'index']);
//Route::get('/jobinfo/activity/add', [BoardActivityController::class, 'create']);
//Route::post('/jobinfo/activity/write', [BoardActivityController::class, 'store'])->name("jobinfo.activity.write");
Route::get('/jobinfo/activity/{id}/view', [BoardActivityController::class, 'view']);

/*취업컨설턴트 PICK*/
Route::get('/jobinfo/pick', [BoardPickController::class, 'index']);
//Route::get('/jobinfo/pick/add', [BoardPickController::class, 'create']);
//Route::post('/jobinfo/pick/write', [BoardPickController::class, 'store'])->name("jobinfo.pick.write");
Route::get('/jobinfo/pick/{id}/view', [BoardPickController::class, 'view']);


/*====================================   취업지원실 프로그램(program) 게시판   ============================================*/
/*공지사항*/
Route::get('/program/notice', [BoardNoticeController::class, 'index']);
Route::get('/program/notice/{id}/view', [BoardNoticeController::class, 'view'])->name("program.notice.view");
Route::get('/ajax/program/notice/get', [BoardNoticeController::class, 'get']);

/*프로그램 접수*/
Route::get('/program/receipt', [BoardReceiptController::class, 'index'])->name('program.receipt.index');
Route::post('/program/receipt', [BoardReceiptController::class, 'store'])->name("program.receipt.write");
Route::get('/program/receipt/add', [BoardReceiptController::class, 'create']);
Route::get('/program/receipt/{id}/view', [BoardReceiptController::class, 'view']);


/*서류합격자 면접교육 접수*/
Route::get('/program/interview', [BoardInterviewController::class, 'create']);
Route::get('/program/interview/add', [BoardInterviewController::class, 'create']);
Route::post('/program/interview/write', [BoardInterviewController::class, 'store'])->name("program.interview.write");
Route::get('/program/interview/view', [BoardInterviewController::class, 'view']);
Route::get('/program/interview/result', [BoardInterviewController::class, 'resultUpdate']);

/*주요일정*/
Route::get("/program/calendar/notice", [App\Http\Controllers\BoardScheduleController::class, 'notice']);
Route::get("/program/calendar/program", [App\Http\Controllers\BoardScheduleController::class, 'program']);

Route::resource("/program/schedule", BoardScheduleController::class)->names([
    "index" => "program.schedule.index",
    "store" => "program.schedule.store",
    "update" => "program.schedule.update",
    "destroy" => "program.schedule.destroy",
    "create" => "program.schedule.create",
    "edit" => "program.schedule.edit"
]);


/*====================================   취업자료실(archive) 게시판   ============================================*/
/*최신 취업수기*/
Route::get('/archive/reviewlatest', [BoardReviewLatestController::class, 'index'])->name("archive.reviewlatest.index");
Route::get('/archive/reviewlatest/create', [BoardReviewLatestController::class, 'create']);
Route::post('/archive/reviewlatest/store', [BoardReviewLatestController::class, 'store'])->name("archive.reviewlatest.store");
Route::get('/archive/reviewlatest/{id}/view', [BoardReviewLatestController::class, 'view']);
Route::get('/archive/reviewlatest/{id}/edit', [BoardReviewLatestController::class, 'edit'])->name("archive.reviewlatest.edit");
Route::put('/archive/reviewlatest/{id}/update', [BoardReviewLatestController::class, 'update'])->name("archive.reviewlatest.update");
Route::delete("/archive/reviewlatest/{id}/destroy", [BoardReviewLatestController::class, "destroy"])->name("archive.reviewlatest.destroy");

/*이전 취업수기*/
Route::get('/archive/reviewbefore', [BoardReviewBeforeController::class, 'index'])->name("archive.reviewbefore.index");
Route::get('/archive/reviewbefore/create', [BoardReviewBeforeController::class, 'create']);
Route::post('/archive/reviewbefore/store', [BoardReviewBeforeController::class, 'store'])->name("archive.reviewbefore.store");
Route::get('/archive/reviewbefore/{id}/view', [BoardReviewBeforeController::class, 'view']);
Route::get('/archive/reviewbefore/{id}/edit', [BoardReviewBeforeController::class, 'edit'])->name("archive.reviewbefore.edit");
Route::put('/archive/reviewbefore/{id}/update', [BoardReviewBeforeController::class, 'update'])->name("archive.reviewbefore.update");
Route::delete("/archive/reviewbefore/{id}/destroy", [BoardReviewBeforeController::class, "destroy"])->name("archive.reviewbefore.destroy");

/*프로그램 참여 후기*/
Route::get('/archive/reviewparticipate', [BoardReviewParticipateController::class, 'index'])->name("archive.reviewparticipate.index");
Route::get('/archive/reviewparticipate/create', [BoardReviewParticipateController::class, 'create']);
Route::post('/archive/reviewparticipate/store', [BoardReviewParticipateController::class, 'store'])->name("archive.reviewparticipate.write");
Route::get('/archive/reviewparticipate/{id}/view', [BoardReviewParticipateController::class, 'view']);
Route::get('/archive/reviewparticipate/{id}/edit', [BoardReviewParticipateController::class, 'edit'])->name("archive.reviewparticipate.edit");
Route::put('/archive/reviewparticipate/{id}/update', [BoardReviewParticipateController::class, 'update'])->name("archive.reviewparticipate.update");
Route::delete("/archive/reviewparticipate/{id}/destroy", [BoardReviewParticipateController::class, "destroy"])->name("archive.reviewparticipate.destroy");
