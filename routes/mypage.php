<?php

use App\Http\Controllers\MyPageController;

/*====================================   마이페이지   ============================================*/

Route::prefix("mypage")->group(function () {
    Route::get("/recommend", [MyPageController::class, "recommendHistory"])->name("mypage.recommend.list");
    Route::get("/recommend/update", [MyPageController::class, "recommendUpdate"])->name("mypage.recommend.update");
    Route::get("/receipt", [MyPageController::class, "receiptHistory"])->name("mypage.receipt.list");
    Route::get("/receipt/details", [MyPageController::class, "receiptDetails"])->name("mypage.receipt.details");
    Route::get("/scrap", [MyPageController::class, "scrapHistory"])->name("mypage.scrap.list");
    Route::get("/interview", [MyPageController::class, "interviewHistory"])->name("mypage.interview.list");
    Route::get("/interview/{id}/result", [MyPageController::class, "interviewResult"])->name("mypage.interview.result");
    Route::put("/interview/update", [MyPageController::class, "interviewUpdate"])->name("mypage.interview.update");
    Route::get("/studyroom", [MyPageController::class, "studyroomHistory"])->name("mypage.studyroom.list");

    Route::get("/alimi", [MyPageController::class, "alimiSetting"])->name("mypage.alimi.list");


});


Route::post('/ajax/alimi', [MyPageController::class, 'setAlimi']);
Route::get('/ajax/alimi', [MyPageController::class, 'getAlimi']);
Route::delete('/ajax/alimi', [MyPageController::class, 'alimiDelete']);
Route::get('/ajax/alimi/page', [MyPageController::class, 'getPage']);
