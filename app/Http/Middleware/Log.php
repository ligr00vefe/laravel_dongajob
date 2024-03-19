<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class Log
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $action = '';
        $comment = '';
        $user_id = Auth::id();
        $route_name = Route::currentRouteName();
        $account = User::find($user_id)->account;
        $keyword = $request->input('term') ?: '';
        $move = $keyword ? '검색' : '접근';
        $pass = false;
        $excel = false;


        if (!session()->get('visit')) {
            session(['visit' => $route_name]);
        } else {
            $pass = session()->get('visit') == $route_name;
            session(['visit' => $route_name]);
        }


        if (!$pass) {
            switch ($route_name) {
                case 'admin.member.manager.index':
                case 'admin.member.manager.store':
                case 'admin.member.manager.update':
                case 'admin.member.manager.destroy':
                case 'admin.member.manager.create':
                case 'admin.member.manager.edit':
                case 'admin.member.manager.destroyAll':
                    $action = "관리자관리";
                    $comment = "{$account}님이 {$action}에 {$keyword} {$move} 했습니다";


                    break;


                case 'admin.jobinfo.recommend.index':
                case 'admin.jobinfo.recommend.store':
                case 'admin.jobinfo.recommend.update':
                case 'admin.jobinfo.recommend.destroy':
                case 'admin.jobinfo.recommend.create':
                case 'admin.jobinfo.recommend.edit':
                case 'admin.jobinfo.recommend.destroyAll':
                    $action = "추천채용";
                    $comment = "{$account}님이 {$action}에 {$keyword} {$move} 했습니다";
                    break;


                case 'admin.jobinfo.support.index':
                case 'admin.jobinfo.support.store':
                case 'admin.jobinfo.support.update':
                case 'admin.jobinfo.support.destroy':
                case 'admin.jobinfo.support.create':
                case 'admin.jobinfo.support.edit':
                case 'admin.jobinfo.support.destroyAll':
                    $action = "지원자관리";
                    $comment = "{$account}님이 {$action}에 {$keyword} {$move} 했습니다";
                    break;


                case 'admin.jobinfo.normal.index':
                case 'admin.jobinfo.normal.store':
                case 'admin.jobinfo.normal.update':
                case 'admin.jobinfo.normal.destroy':
                case 'admin.jobinfo.normal.create':
                case 'admin.jobinfo.normal.edit':
                case 'admin.jobinfo.normal.destroyAll':
                    $action = "일반채용";
                    $comment = "{$account}님이 {$action}에 {$keyword} {$move} 했습니다";
                    break;


                case 'admin.jobinfo.donga300.index':
                case 'admin.jobinfo.donga300.store':
                case 'admin.jobinfo.donga300.update':
                case 'admin.jobinfo.donga300.destroy':
                case 'admin.jobinfo.donga300.create':
                case 'admin.jobinfo.donga300.edit':
                case 'admin.jobinfo.donga300.destroyAll':
                    $action = "동아친화기업 300";
                    $comment = "{$account}님이 {$action}에 {$keyword} {$move} 했습니다";
                    break;

                case 'admin.jobinfo.activity.index':
                case 'admin.jobinfo.activity.store':
                case 'admin.jobinfo.activity.update':
                case 'admin.jobinfo.activity.destroy':
                case 'admin.jobinfo.activity.create':
                case 'admin.jobinfo.activity.edit':
                case 'admin.jobinfo.activity.destroyAll':
                    $action = "각종활동";
                    $comment = "{$account}님이 {$action}에 {$keyword} {$move} 했습니다";
                    break;

                case 'admin.jobinfo.pick.index':
                case 'admin.jobinfo.pick.store':
                case 'admin.jobinfo.pick.update':
                case 'admin.jobinfo.pick.destroy':
                case 'admin.jobinfo.pick.create':
                case 'admin.jobinfo.pick.edit':
                case 'admin.jobinfo.pick.destroyAll':
                    $action = "컨설턴트";
                    $comment = "{$account}님이 {$action}에 {$keyword} {$move} 했습니다";
                    break;


                case 'admin.notice.index':
                case 'admin.notice.store':
                case 'admin.notice.update':
                case 'admin.notice.destroy':
                case 'admin.notice.create':
                case 'admin.notice.edit':
                case 'admin.notice.destroyAll':
                    $action = "공지사항";
                    $comment = "{$account}님이 {$action}에 {$keyword} {$move} 했습니다";
                    break;

                case 'admin.support.program.index':
                case 'admin.support.program.store':
                case 'admin.support.program.update':
                case 'admin.support.program.destroy':
                case 'admin.support.program.create':
                case 'admin.support.program.edit':
                case 'admin.support.program.destroyAll':
                    $action = "프로그램";
                    $comment = "{$account}님이 {$action}에 {$keyword} {$move} 했습니다";
                    break;


                case 'admin.support.applicant.index':
                case 'admin.support.applicant.store':
                case 'admin.support.applicant.update':
                case 'admin.support.applicant.destroy':
                case 'admin.support.applicant.create':
                case 'admin.support.applicant.edit':
                case 'admin.support.applicant.destroyAll':
                    $action = "프로그램 신청";
                    $comment = "{$account}님이 {$action}에 {$keyword} {$move} 했습니다";
                    break;


                case 'admin.support.interview.index':
                case 'admin.support.interview.store':
                case 'admin.support.interview.update':
                case 'admin.support.interview.destroy':
                case 'admin.support.interview.create':
                case 'admin.support.interview.edit':
                case 'admin.support.interview.destroyAll':
                    $action = "서류합격자면접교육 접수";
                    $comment = "{$account}님이 {$action}에 {$keyword} {$move} 했습니다";
                    break;


                case 'admin.archive.reviewlatest.store':
                case 'admin.archive.reviewlatest.update':
                case 'admin.archive.reviewlatest.destroy':
                case 'admin.archive.reviewlatest.create':
                case 'admin.archive.reviewlatest.edit':
                case 'admin.archive.reviewlatest.destroyAll':
                case 'admin.archive.reviewlatest.index':
                    $action = "최신 취업수기 (최근 5년)";
                    $comment = "{$account}님이 {$action}에 {$keyword} {$move} 했습니다";
                    break;


                case 'admin.archive.reviewbefore.store':
                case 'admin.archive.reviewbefore.update':
                case 'admin.archive.reviewbefore.destroy':
                case 'admin.archive.reviewbefore.create':
                case 'admin.archive.reviewbefore.edit':
                case 'admin.archive.reviewbefore.destroyAll':
                case 'admin.archive.reviewbefore.index':
                    $action = "이전 취업수기";
                    $comment = "{$account}님이 {$action}에 {$keyword} {$move} 했습니다";
                    break;


                case 'admin.archive.reviewparticipate.store':
                case 'admin.archive.reviewparticipate.update':
                case 'admin.archive.reviewparticipate.destroy':
                case 'admin.archive.reviewparticipate.create':
                case 'admin.archive.reviewparticipate.edit':
                case 'admin.archive.reviewparticipate.destroyAll':
                case 'admin.archive.reviewparticipate.index':
                    $action = "프로그램 참여후기";
                    $comment = "{$account}님이 {$action}에 {$keyword} {$move} 했습니다";
                    break;


                case 'admin.study.reservation.store':
                case 'admin.study.reservation.update':
                case 'admin.study.reservation.destroy':
                case 'admin.study.reservation.create':
                case 'admin.study.reservation.edit':
                case 'admin.study.reservation.destroyAll':
                case 'admin.study.reservation.index':
                    $action = "스터디룸 예약,등록";
                    $comment = "{$account}님이 {$action}에 {$keyword} {$move} 했습니다";

                    break;


                case 'admin.study.room.store':
                case 'admin.study.room.update':
                case 'admin.study.room.create':
                case 'admin.study.room.edit':
                case 'admin.study.room.destroy':
                case 'admin.study.room.destroyAll':
                case 'admin.study.room.index':
                    $action = "스터디룸 등록,관리";
                    $comment = "{$account}님이 {$action}에 {$keyword} {$move} 했습니다";
                    break;


                case 'admin.statistics.history.store':
                case 'admin.statistics.history.update':
                case 'admin.statistics.history.destroy':
                case 'admin.statistics.history.create':
                case 'admin.statistics.history.edit':
                case 'admin.statistics.history.destroyAll':
                case 'admin.statistics.history.index':
                    $action = "통계";
                    $comment = "{$account}님이 {$action}에 {$keyword} {$move} 했습니다";
                    break;

                case 'admin.log.auth.index':
                case 'admin.log.auth.store':
                case 'admin.log.auth.update':
                case 'admin.log.auth.destroy':
                case 'admin.log.auth.create':
                case 'admin.log.auth.edit':
                case 'admin.log.auth.destroyAll':
                    $action = "로그";
                    $comment = "{$account}님이 {$action}에 {$keyword} {$move} 했습니다";
                    break;


                //*=========================================== 엑셀 ===================================================*/
                case 'admin.excel.export.download.log.logAll':
                case 'admin.excel.export.download.log.logExcel':
                case 'admin.excel.export.download.log.logChange':
                case 'admin.excel.export.download.log.logConnect':
                    $excel = true;
                    $comment = '로그';
                    break;


                case 'admin.excel.export.download.support.interview':
                    $excel = true;
                    $comment = '서류합격자면접교육 접수';
                    break;


                case 'admin.excel.export.download.support.program':
                    $excel = true;
                    $comment = '프로그램 및 신청자 관리';
                    break;


                case 'admin.excel.export.download.archive.reviewparticipate':
                    $excel = true;
                    $comment = '프로그램 참여후기';
                    break;

                case 'admin.excel.export.download.archive.reviewlatest':
                    $excel = true;
                    $comment = '이전 취업수기';
                    break;

                case 'admin.excel.export.download.archive.reviewbefore':
                    $excel = true;
                    $comment = '최신취업수기';
                    break;

                case 'admin.excel.export.download.room.reservation':
                    $excel = true;
                    $comment = '스터디룸 예약리스트';
                    break;


                default:
                    //--- 최초 로그인 하였을 때
                    $generate = explode('::', $route_name);
                    if ($generate[0] == 'generated') {
                        $action = '로그인';
                        $comment = "{$account}님이 로그인 했습니다";
                    }

            }


            $ip = $request->getClientIp();
            $path = $request->getPathInfo();


            //--- 엑셇 다운로드 로그 저장
            if ($excel) {
                \App\Models\Log::record([
                    "user_id" => session()->get('user_id') ?? 1,
                    "keyword" => $request->reason,
                    "action" => '엑셀내역다운로드',
                    "target" => $account,
                    "path" => $path,
                    "ip" => $ip,
                    'comment' => session()->get('account') . '님이 ' . $comment . '엑셀내역다운로드' . ' 했습니다.'
                ]);
            }


            //--- 방문 기록 저장
            $category = "";
            if (!empty($action) && !$excel) {
                $record = \App\Models\Log::record([
                    "user_id" => $user_id,
                    "action" => $action,
                    "route" => $route_name,
                    "target" => $account,
                    "path" => $path,
                    "comment" => $comment,
                    "ip" => $ip,
                    "keyword" => $keyword,
                    "category" => $category,
                ]);
            }
        }

        return $next($request);
    }
}
