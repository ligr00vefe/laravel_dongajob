<?php

use App\Http\Controllers\Admin\AdminStudyRoomPreventionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminExcelExportController;
use App\Http\Controllers\Admin\AdminUploadController;

Route::namespace('Admin')->group(function () {
    $adminUrl = "superviser";
    Route::prefix("{$adminUrl}")->group(function () {


        /*============================================== 메인 ==============================================*/
        Route::get('/', [App\Http\Controllers\Admin\UserController::class, "index"]);
        Route::get('/isAdmin', [App\Http\Controllers\Admin\UserController::class, "isAdmin"]);
        Route::get('/member/manager/limit', [App\Http\Controllers\Admin\UserController::class, "limit"]);


        /*============================================== 회원관리 ==============================================*/

        //--- 관리자 관리
        Route::delete("/member/manager/delete_all", [App\Http\Controllers\Admin\UserController::class, "destroyAll"])->name("admin.member.manager.destroyAll");
        Route::resource("/member/manager", UserController::class)->names([
            "index" => "admin.member.manager.index",
            "store" => "admin.member.manager.store",
            "update" => "admin.member.manager.update",
            "destroy" => "admin.member.manager.destroy",
            "create" => "admin.member.manager.create",
            "edit" => "admin.member.manager.edit"
        ]);

        /*============================================== 채용관리 ==============================================*/

        //--- 추천채용
        Route::delete("/jobinfo/recommend/delete_all", [App\Http\Controllers\Admin\AdminBoardRecommendController::class, "destroyAll"])->name("admin.jobinfo.recommend.destroyAll");
        Route::resource("/jobinfo/recommend", AdminBoardRecommendController::class)->names([
            "index" => "admin.jobinfo.recommend.index",
            "store" => "admin.jobinfo.recommend.store",
            "update" => "admin.jobinfo.recommend.update",
            "destroy" => "admin.jobinfo.recommend.destroy",
            "create" => "admin.jobinfo.recommend.create",
            "edit" => "admin.jobinfo.recommend.edit"
        ]);

        //--- 지원자관리
        Route::delete("/jobinfo/support/delete_all", [App\Http\Controllers\Admin\AdminRecommendReservationController::class, "destroyAll"])->name("admin.jobinfo.support.destroyAll");
        Route::resource("/jobinfo/support", AdminRecommendReservationController::class)->names([
            "index" => "admin.jobinfo.support.index",
            "store" => "admin.jobinfo.support.store",
            "update" => "admin.jobinfo.support.update",
            "destroy" => "admin.jobinfo.support.destroy",
            "create" => "admin.jobinfo.support.create",
            "edit" => "admin.jobinfo.support.edit"
        ]);

        //--- 일반채용
        Route::delete("/jobinfo/normal/delete_all", [App\Http\Controllers\Admin\AdminBoardNormalController::class, "destroyAll"])->name("admin.jobinfo.normal.destroyAll");
        Route::resource("/jobinfo/normal", AdminBoardNormalController::class)->names([
            "index" => "admin.jobinfo.normal.index",
            "store" => "admin.jobinfo.normal.store",
            "update" => "admin.jobinfo.normal.update",
            "destroy" => "admin.jobinfo.normal.destroy",
            "create" => "admin.jobinfo.normal.create",
            "edit" => "admin.jobinfo.normal.edit"
        ]);

        //--- 동아친화기업 300
        Route::delete("/jobinfo/donga300/delete_all", [App\Http\Controllers\Admin\AdminBoardDonga300Controller::class, "destroyAll"])->name("admin.jobinfo.donga300.destroyAll");
        Route::resource("/jobinfo/donga300", AdminBoardDonga300Controller::class)->names([
            "index" => "admin.jobinfo.donga300.index",
            "store" => "admin.jobinfo.donga300.store",
            "update" => "admin.jobinfo.donga300.update",
            "destroy" => "admin.jobinfo.donga300.destroy",
            "create" => "admin.jobinfo.donga300.create",
            "edit" => "admin.jobinfo.donga300.edit"
        ]);

        //--- 각종활동
        Route::delete("/jobinfo/activity/delete_all", [App\Http\Controllers\Admin\AdminBoardActivityController::class, "destroyAll"])->name("admin.jobinfo.activity.destroyAll");
        Route::resource("/jobinfo/activity", AdminBoardActivityController::class)->names([
            "index" => "admin.jobinfo.activity.index",
            "store" => "admin.jobinfo.activity.store",
            "update" => "admin.jobinfo.activity.update",
            "destroy" => "admin.jobinfo.activity.destroy",
            "create" => "admin.jobinfo.activity.create",
            "edit" => "admin.jobinfo.activity.edit"
        ]);

        //--- 컨설턴트
        Route::delete("/jobinfo/pick/delete_all", [App\Http\Controllers\Admin\AdminBoardPickController::class, "destroyAll"])->name("admin.jobinfo.pick.destroyAll");
        Route::resource("/jobinfo/pick", AdminBoardPickController::class)->names([
            "index" => "admin.jobinfo.pick.index",
            "store" => "admin.jobinfo.pick.store",
            "update" => "admin.jobinfo.pick.update",
            "destroy" => "admin.jobinfo.pick.destroy",
            "create" => "admin.jobinfo.pick.create",
            "edit" => "admin.jobinfo.pick.edit"
        ]);


        /*============================================== 공지사항 ==============================================*/

        Route::delete("/notice/delete_all", [App\Http\Controllers\Admin\AdminNoticeController::class, "destroyAll"])->name("admin.notice.destroyAll");
        Route::resource("/notice", AdminNoticeController::class)->names([
            "index" => "admin.notice.index",
            "store" => "admin.notice.store",
            "update" => "admin.notice.update",
            "destroy" => "admin.notice.destroy",
            "create" => "admin.notice.create",
            "edit" => "admin.notice.edit"
        ]);


        /*============================================== 온라인 컨텐츠 관리 ==============================================*/


        /*============================================== 취업 지원실 프로그램 관리 ==============================================*/

        //--- 프로그램
        Route::delete("/support/program/delete_all", [App\Http\Controllers\Admin\AdminBoardProgramController::class, "destroyAll"])->name("admin.support.program.destroyAll");
        Route::get("/support/program/{id}/view", [App\Http\Controllers\Admin\AdminBoardProgramController::class, "view"])->name("admin.support.program.view");
        Route::resource("/support/program", AdminBoardProgramController::class)->names([
            "index" => "admin.support.program.index",
            "store" => "admin.support.program.store",
            "update" => "admin.support.program.update",
            "destroy" => "admin.support.program.destroy",
            "create" => "admin.support.program.create",
            "edit" => "admin.support.program.edit"
        ]);

        //---프로그램 신청 예약
        Route::delete("/support/applicant/delete_all", [App\Http\Controllers\Admin\AdminProgramReservationController::class, "destroyAll"])->name("admin.support.applicant.destroyAll");
        Route::delete("/support/waite/delete_all", [App\Http\Controllers\Admin\AdminProgramReservationController::class, "destroyAll"]);
        Route::resource("/support/applicant", AdminProgramReservationController::class)->names([
            "store" => "admin.support.applicant.store",
            "update" => "admin.support.applicant.update",
            "destroy" => "admin.support.applicant.destroy",
            "create" => "admin.support.applicant.create",
            "edit" => "admin.support.applicant.edit"
        ]);

        Route::get("/support/waite/create", [App\Http\Controllers\Admin\AdminProgramReservationController::class, "create"]);


        //--- 서류합격자면접교육 접수
        Route::delete("/support/interview/delete_all", [App\Http\Controllers\Admin\AdminInterviewController::class, "destroyAll"])->name("admin.support.interview.destroyAll");
        Route::resource("/support/interview", AdminInterviewController::class)->names([
            "index" => "admin.support.interview.index",
            "store" => "admin.support.interview.store",
            "update" => "admin.support.interview.update",
            "destroy" => "admin.support.interview.destroy",
            "create" => "admin.support.interview.create",
            "edit" => "admin.support.interview.edit"
        ]);


        /*============================================== 취업자료실 ==============================================*/

        //--- 최신 취업수기 (최근 5년)
        Route::post("/archive/reviewlatest/move_all", [App\Http\Controllers\Admin\AdminBoardReviewLatestController::class, "moveAll"])->name("admin.archive.reviewlatest.moveAll");
        Route::delete("/archive/reviewlatest/delete_all", [App\Http\Controllers\Admin\AdminBoardReviewLatestController::class, "destroyAll"])->name("admin.archive.reviewlatest.destroyAll");
        Route::resource("/archive/reviewlatest", AdminBoardReviewLatestController::class)->names([
            "index" => "admin.archive.reviewlatest.index",
            "store" => "admin.archive.reviewlatest.store",
            "update" => "admin.archive.reviewlatest.update",
            "destroy" => "admin.archive.reviewlatest.destroy",
            "create" => "admin.archive.reviewlatest.create",
            "edit" => "admin.archive.reviewlatest.edit"
        ]);

        //--- 이전 취업수기
        Route::delete("/archive/reviewbefore/delete_all", [App\Http\Controllers\Admin\AdminBoardReviewBeforeController::class, "destroyAll"])->name("admin.archive.reviewbefore.destroyAll");
        Route::resource("/archive/reviewbefore", AdminBoardReviewBeforeController::class)->names([
            "index" => "admin.archive.reviewbefore.index",
            "store" => "admin.archive.reviewbefore.store",
            "update" => "admin.archive.reviewbefore.update",
            "destroy" => "admin.archive.reviewbefore.destroy",
            "create" => "admin.archive.reviewbefore.create",
            "edit" => "admin.archive.reviewbefore.edit"
        ]);

        //--- 프로그램 참여후기
        Route::delete("/archive/reviewparticipate/delete_all", [App\Http\Controllers\Admin\AdminBoardReviewParticipateController::class, "destroyAll"])->name("admin.archive.reviewparticipate.destroyAll");
        Route::resource("/archive/reviewparticipate", AdminBoardReviewParticipateController::class)->names([
            "index" => "admin.archive.reviewparticipate.index",
            "store" => "admin.archive.reviewparticipate.store",
            "update" => "admin.archive.reviewparticipate.update",
            "destroy" => "admin.archive.reviewparticipate.destroy",
            "create" => "admin.archive.reviewparticipate.create",
            "edit" => "admin.archive.reviewparticipate.edit"
        ]);


        /*============================================== 스터디룸 ==============================================*/

        //--- 스터디룸 예약,등록
        Route::delete("/study/reservation/delete_all", [App\Http\Controllers\Admin\AdminStudyResevationController::class, "destroyAll"])->name("admin.study.reservation.destroyAll");
        Route::resource("/study/reservation", AdminStudyResevationController::class)->names([
            "index" => "admin.study.reservation.index",
            "store" => "admin.study.reservation.store",
            "destroy" => "admin.study.reservation.destroy",
            "create" => "admin.study.reservation.create",
            "edit" => "admin.study.reservation.edit"
        ]);

        Route::put("/study/reservation/{id}", [App\Http\Controllers\Admin\AdminStudyResevationController::class, 'update'])->name("admin.study.reservation.update");

        //--- 스터디룸 등록,관리
        Route::delete("/study/room/delete_all", [App\Http\Controllers\Admin\AdminStudyRoomPreventionController::class, "destroyAll"])->name("admin.study.room.destroyAll");
        Route::resource("/study/room", AdminStudyRoomController::class)->names([
            "index" => "admin.study.room.index",
            "store" => "admin.study.room.store",
            "update" => "admin.study.room.update",
            "destroy" => "admin.study.room.destroy",
            "create" => "admin.study.room.create",
            "edit" => "admin.study.room.edit"
        ]);

        //--- 스터디룸 예약막기
        Route::delete("/study/prevention/delete_all", [App\Http\Controllers\Admin\AdminStudyRoomPreventionController::class, "destroyAll"])->name("admin.study.prevention.destroyAll");
        Route::resource("/study/prevention", AdminStudyRoomPreventionController::class)->names([
            "index" => "admin.study.prevention.index",
            "store" => "admin.study.prevention.store",
            "update" => "admin.study.prevention.update",
            "destroy" => "admin.study.prevention.destroy",
            "create" => "admin.study.prevention.create",
            "edit" => "admin.study.prevention.edit"
        ]);


        /*통계*/
        Route::get('/statistics', [AdminStatisticsController::class, "index"])->name('admin.statistics.index');

        Route::get("/api/student", [\App\Http\Controllers\Admin\UserController::class, "search"]);
        Route::post("/upload", [AdminUploadController::class, "run"])->name("admin.upload.run");
    });


    /*로그*/
    Route::prefix("{$adminUrl}/log")->group(function () {

        Route::resource("/auth", AdminLogController::class)->names([
            "index" => "admin.log.auth.index",
            "show" => "admin.log.auth.show",
            "create" => "admin.log.autch.create",
            "store" => "admin.log.auth.store",
            "edit" => "admin.log.auth.edit",
            "update" => "admin.log.auth.update",
            "destroy" => "admin.log.auth.destroy",
        ]);

    });

    /*통계*/
    Route::prefix("{$adminUrl}/statistics")->group(function () {

        Route::resource("/history", AdminStatisticsController::class)->names([
            "index" => "admin.statistics.history.index",
            "show" => "admin.statistics.history.show",
            "create" => "admin.statistics.history.create",
            "store" => "admin.statistics.history.store",
            "edit" => "admin.statistics.history.edit",
            "update" => "admin.statistics.history.update",
            "destroy" => "admin.statistics.history.destroy",
        ]);

    });


    /*팝업*/
    Route::prefix("{$adminUrl}/popup")->group(function () {
        Route::delete("/info/delete_all", [App\Http\Controllers\Admin\AdminPopupController::class, "destroyAll"])->name("admin.popup.destroyAll");
        Route::resource("/info", AdminPopupController::class)->names([
            "index" => "admin.popup.index",
            "show" => "admin.popup.show",
            "create" => "admin.popup.create",
            "store" => "admin.popup.store",
            "edit" => "admin.popup.edit",
            "update" => "admin.popup.update",
            "destroy" => "admin.popup.destroy"
        ]);
    });


    Route::prefix("{$adminUrl}/excel")->group(function () {
        Route::get("/export", [AdminExcelExportController::class, "index"])->name("admin.excel.export.index");


        /*=== 엑셀 다운로드 ===*/

        // 로그
        Route::post("/export/download/log/all", [AdminExcelExportController::class, "logAll"])->name("admin.excel.export.download.log.logAll");
        Route::post("/export/download/log/excel", [AdminExcelExportController::class, "logExcel"])->name("admin.excel.export.download.log.logExcel");
        Route::post("/export/download/log/change", [AdminExcelExportController::class, "logChange"])->name("admin.excel.export.download.log.logChange");
        Route::post("/export/download/log/connect", [AdminExcelExportController::class, "logConnect"])->name("admin.excel.export.download.log.logConnect");


        // 스터디룸 예약 리스트
        Route::post("/export/download/room/reservation", [AdminExcelExportController::class, "roomReservation"])->name("admin.excel.export.download.room.reservation");


        // 최신취업수기
        Route::post("/export/download/archive/reviewlatest", [AdminExcelExportController::class, "reviewlatest"])->name("admin.excel.export.download.archive.reviewlatest");
        // 이전 취업수기
        Route::post("/export/download/archive/reviewbefore", [AdminExcelExportController::class, "reviewbefore"])->name("admin.excel.export.download.archive.reviewbefore");
        // 프로그램 참여후기
        Route::post("/export/download/archive/reviewparticipate", [AdminExcelExportController::class, "reviewparticipate"])->name("admin.excel.export.download.archive.reviewparticipate");

        // 신청자 관리
        Route::post("/export/download/support/interview", [AdminExcelExportController::class, "supportInterview"])->name("admin.excel.export.download.support.interview");
        // 프로그램 및 신청자 관리
        Route::post("/export/download/support/program", [AdminExcelExportController::class, "supportProgram"])->name("admin.excel.export.download.support.program");

        // 프로그램 및 신청자 명단
        Route::post("/export/download/support/programlist", [AdminExcelExportController::class, "supportProgramlist"])->name("admin.excel.export.download.support.programlist");

        // 프로그램 및 대기자
        Route::post("/export/download/support/programwaitlist", [AdminExcelExportController::class, "supportProgramWaitlist"])->name("admin.excel.export.download.support.programwaitlist");


        //--- 추천채용

        // 채용관리
        Route::post("/export/download/jobinfo/recommend", [AdminExcelExportController::class, "jobinfoRecommend"])->name("admin.excel.export.download.jobinfo.recommend");
        // 지원자 관리
        Route::post("/export/download/jobinfo/support", [AdminExcelExportController::class, "jobinfoSupport"])->name("admin.excel.export.download.jobinfo.support");





        //일반채용
        Route::post("/export/download/jobinfo/normal", [AdminExcelExportController::class, "jobinfoNormal"])->name("admin.excel.export.download.jobinfo.normal");

        //동아친화기업 300
        Route::post("/export/download/jobinfo/donga300", [AdminExcelExportController::class, "jobinfoDonga300"])->name("admin.excel.export.download.jobinfo.donga300");


        // 각종활동
        Route::post("/export/download/jobinfo/activity", [AdminExcelExportController::class, "jobinfoActivity"])->name("admin.excel.export.download.jobinfo.activity");


        // 취업컨설턴트 PICK 관리
        Route::post("/export/download/jobinfo/pick", [AdminExcelExportController::class, "jobinfoPick"])->name("admin.excel.export.download.jobinfo.pick");




    });
});
