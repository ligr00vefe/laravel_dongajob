<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AdminAllLogExport;
use App\Exports\AdminChangeLogExport;
use App\Exports\AdminConnectLogExport;
use App\Exports\AdminExcelLogExport;
use App\Exports\AdminJobinfoActivityExport;
use App\Exports\AdminJobinfoDonga300Export;
use App\Exports\AdminJobinfoNormalExport;
use App\Exports\AdminJobinfoPickExport;
use App\Exports\AdminJobinfoRecommendExport;
use App\Exports\AdminJobinfoSupportExport;
use App\Exports\AdminLogExport;
use App\Exports\AdminReviewbeforeExport;
use App\Exports\AdminReviewlatestExport;
use App\Exports\AdminReviewparticipateExport;
use App\Exports\AdminRoomReservationExport;
use App\Exports\AdminStudyRoomExport;
use App\Exports\AdminStudyRoomRervetionExport;
use App\Exports\AdminSupportInterviewExport;
use App\Exports\AdminSupportProgramExport;
use App\Exports\BoardSearchExport;
use App\Exports\CommentsExport;
use App\Exports\AdminSupportProgramListExport;
use App\Exports\AdminSupportProgramWaitListExport;
use App\Http\Controllers\Controller;
use App\Models\Log;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminExcelExportController extends Controller
{
    public function index(Request $request)
    {
        //var_dump($request);
        $from = $request->input('from');
        $to = $request->input('to');
        $from = $from ? date("Y-m-d", strtotime($from." -1 day")) : '';
        $to = $to ? date("Y-m-d", strtotime($to." +1 day")) : '';
        $schedule_date = $request->input('schedule_date');
        $schedule_end_date = $request->input('schedule_end_date');
        $schedule_date = $schedule_date ? date("Y-m-d", strtotime($schedule_date." -1 day")) : '';
        $schedule_end_date = $schedule_end_date ? date("Y-m-d", strtotime($schedule_end_date." +1 day")) : '';
//dd($request);
        return view("admin._excel.index", [
            'data' => $request->data,
            'url' => $request->url,
            'from' => $from,
            'to' => $to
        ]);

    }

    /*===== 스터디룸 리스트 =======*/
    public function roomReservation(Request $request)
    {
        return Excel::download(new AdminRoomReservationExport($request,'1'), "스터디룸_예약리스트_내역" . date("Y-m-d") . ".xlsx");
    }


    /*===== 수기 =======*/
    public function reviewlatest()
    {
        return Excel::download(new AdminReviewlatestExport(), "최신_취업수기(최근 5년)_내역" . date("Y-m-d") . ".xlsx");
    }

    public function reviewbefore()
    {
        return Excel::download(new AdminReviewbeforeExport(), "이전_취업수기_내역" . date("Y-m-d") . ".xlsx");
    }

    public function reviewparticipate()
    {
        return Excel::download(new AdminReviewparticipateExport(), "프로그램_참여후기_내역" . date("Y-m-d") . ".xlsx");
    }

    /*===== 추천채용 =======*/

    // 채용관리
    public function jobinfoRecommend()
    {
        return Excel::download(new AdminJobinfoRecommendExport(), "채용관리_내역" . date("Y-m-d") . ".xlsx");
    }

    // 지원자 관리
    public function jobinfoSupport(Request $request)
    {
        return Excel::download(new AdminJobinfoSupportExport($request->input('from'), $request->input('to')), "채용관리_지원자_내역" . date("Y-m-d") . ".xlsx");
    }



    /*===== 취업지원실 프로그램 관리 =======*/

    // 일반채용
    public function jobinfoNormal()
    {
        return Excel::download(new AdminJobinfoNormalExport(), "일반채용_내역" . date("Y-m-d") . ".xlsx");
    }

    // 동아친화기업 300 관리
    public function jobinfoDonga300()
    {
        return Excel::download(new AdminJobinfoDonga300Export(), "동아친화기업_300_내역" . date("Y-m-d") . ".xlsx");
    }

    // 각종활동
    public function jobinfoActivity()
    {
        return Excel::download(new AdminJobinfoActivityExport(), "각종활동_내역" . date("Y-m-d") . ".xlsx");
    }

    // 취업컨설턴트 PICK 관리
    public function jobinfoPick()
    {
        return Excel::download(new AdminJobinfoPickExport(), "취업컨설턴트_PICK_관리" . date("Y-m-d") . ".xlsx");
    }

    public function supportInterview()
    {
        return Excel::download(new AdminSupportInterviewExport(), "서류합격자_면접교육_접수" . date("Y-m-d") . ".xlsx");
    }

    //
    public function supportProgram()
    {
        return Excel::download(new AdminSupportProgramExport(), "프로그램및_신청자_관리" . date("Y-m-d") . ".xlsx");
    }

    public function supportProgramlist(Request $request)
    {
        return Excel::download(new AdminSupportProgramListExport($request->input('id'),$request->input('from'), $request->input('to')), "프로그램및_신청자_명단" . date("Y-m-d") . ".xlsx");
    }

    public function supportProgramWaitlist(Request $request)
    {

        return Excel::download(new AdminSupportProgramWaitListExport($request->input('id'),$request->input('from'), $request->input('to')), "프로그램및_대기자_명단" . date("Y-m-d") . ".xlsx");
    }


    /*===== 로그 =======*/
    public function logAll(Request $request)
    {
        return Excel::download(new AdminAllLogExport($request->input('from'), $request->input('to')), "로그_전체_내역" . date("Y-m-d") . ".xlsx");
    }

    public function logConnect(Request $request)
    {
        return Excel::download(new AdminConnectLogExport($request->input('from'), $request->input('to')), "관리자_접속기록_내역" . date("Y-m-d") . ".xlsx");
    }

    public function logChange(Request $request)
    {
        return Excel::download(new AdminChangeLogExport($request->input('from'), $request->input('to')), "관리자_권한변경_내역" . date("Y-m-d") . ".xlsx");
    }

    public function logExcel(Request $request)
    {
        return Excel::download(new AdminExcelLogExport($request->input('from'), $request->input('to')), "엑셀_다운로드_내역" . date("Y-m-d") . ".xlsx");
    }
}
