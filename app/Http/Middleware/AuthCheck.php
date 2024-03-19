<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AuthCheck
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

        if (!Auth::guard('web')->check())
            return redirect()->route('main')->with('error', '접근하실수없습니다.');

        if (!session()->get('login_check'))
            return redirect()->route('main')->with('error', '접근하실수없습니다.');



        if (session()->get('level') == 1) {

            $menus = explode(',', session()->get('menu'));
            $route_name = Route::current()->action['controller'];
            $menu_id = false;
            $pass = false;

            switch ($route_name) {

                //--- 회원관리는 그냥 누구나 패스
                /*case 'App\Http\Controllers\AdminManagerController@index':
                case 'App\Http\Controllers\Admin\UserController@index':
                    $pass = true;
                    break;*/

                //--- 첨부파일 라우트 경로는 모두 통과하도록 처리
                case 'App\Http\Controllers\Admin\AdminUploadController@run':
                    $pass = true;
                    break;

                case 'App\Http\Controllers\Admin\UserController@index':
                case 'App\Http\Controllers\Admin\UserController@update':
                case 'App\Http\Controllers\Admin\UserController@destroy':
                case 'App\Http\Controllers\Admin\UserController@create':
                case 'App\Http\Controllers\Admin\UserController@edit':
                case 'App\Http\Controllers\Admin\UserController@destroyAll':
                    $menu_id = 100;
                    break;


                case 'App\Http\Controllers\Admin\AdminBoardRecommendController@index':
                case 'App\Http\Controllers\Admin\AdminBoardRecommendController@store':
                case 'App\Http\Controllers\Admin\AdminBoardRecommendController@update':
                case 'App\Http\Controllers\Admin\AdminBoardRecommendController@destroy':
                case 'App\Http\Controllers\Admin\AdminBoardRecommendController@create':
                case 'App\Http\Controllers\Admin\AdminBoardRecommendController@edit':
                case 'App\Http\Controllers\Admin\AdminBoardRecommendController@destroyAll':

                case 'App\Http\Controllers\Admin\AdminRecommendReservationController@index':
                case 'App\Http\Controllers\Admin\AdminRecommendReservationController@store':
                case 'App\Http\Controllers\Admin\AdminRecommendReservationController@update':
                case 'App\Http\Controllers\Admin\AdminRecommendReservationController@destroy':
                case 'App\Http\Controllers\Admin\AdminRecommendReservationController@create':
                case 'App\Http\Controllers\Admin\AdminRecommendReservationController@edit':
                case 'App\Http\Controllers\Admin\AdminRecommendReservationController@destroyAll':

                case 'App\Http\Controllers\Admin\AdminBoardNormalController@index':
                case 'App\Http\Controllers\Admin\AdminBoardNormalController@store':
                case 'App\Http\Controllers\Admin\AdminBoardNormalController@update':
                case 'App\Http\Controllers\Admin\AdminBoardNormalController@destroy':
                case 'App\Http\Controllers\Admin\AdminBoardNormalController@create':
                case 'App\Http\Controllers\Admin\AdminBoardNormalController@edit':
                case 'App\Http\Controllers\Admin\AdminBoardNormalController@destroyAll':

                case 'App\Http\Controllers\Admin\AdminBoardDonga300Controller@index':
                case 'App\Http\Controllers\Admin\AdminBoardDonga300Controller@store':
                case 'App\Http\Controllers\Admin\AdminBoardDonga300Controller@update':
                case 'App\Http\Controllers\Admin\AdminBoardDonga300Controller@destroy':
                case 'App\Http\Controllers\Admin\AdminBoardDonga300Controller@create':
                case 'App\Http\Controllers\Admin\AdminBoardDonga300Controller@edit':
                case 'App\Http\Controllers\Admin\AdminBoardDonga300Controller@destroyAll':

                case 'App\Http\Controllers\Admin\AdminBoardActivityController@index':
                case 'App\Http\Controllers\Admin\AdminBoardActivityController@store':
                case 'App\Http\Controllers\Admin\AdminBoardActivityController@update':
                case 'App\Http\Controllers\Admin\AdminBoardActivityController@destroy':
                case 'App\Http\Controllers\Admin\AdminBoardActivityController@create':
                case 'App\Http\Controllers\Admin\AdminBoardActivityController@edit':
                case 'App\Http\Controllers\Admin\AdminBoardActivityController@destroyAll':

                case 'App\Http\Controllers\Admin\AdminBoardPickController@index':
                case 'App\Http\Controllers\Admin\AdminBoardPickController@store':
                case 'App\Http\Controllers\Admin\AdminBoardPickController@update':
                case 'App\Http\Controllers\Admin\AdminBoardPickController@destroy':
                case 'App\Http\Controllers\Admin\AdminBoardPickController@create':
                case 'App\Http\Controllers\Admin\AdminBoardPickController@edit':
                case 'App\Http\Controllers\Admin\AdminBoardPickController@destroyAll':
                    $menu_id = 200;
                    break;


                case 'App\Http\Controllers\Admin\AdminNoticeController@store':
                case 'App\Http\Controllers\Admin\AdminNoticeController@index':
                case 'App\Http\Controllers\Admin\AdminNoticeController@update':
                case 'App\Http\Controllers\Admin\AdminNoticeController@destroy':
                case 'App\Http\Controllers\Admin\AdminNoticeController@create':
                case 'App\Http\Controllers\Admin\AdminNoticeController@edit':
                case 'App\Http\Controllers\Admin\AdminNoticeController@destroyAll':
                    $menu_id = 300;
                    break;


                case 'App\Http\Controllers\Admin\AdminBoardProgramController@index':
                case 'App\Http\Controllers\Admin\AdminBoardProgramController@store':
                case 'App\Http\Controllers\Admin\AdminBoardProgramController@view':
                case 'App\Http\Controllers\Admin\AdminBoardProgramController@update':
                case 'App\Http\Controllers\Admin\AdminBoardProgramController@destroy':
                case 'App\Http\Controllers\Admin\AdminBoardProgramController@create':
                case 'App\Http\Controllers\Admin\AdminBoardProgramController@edit':
                case 'App\Http\Controllers\Admin\AdminBoardProgramController@destroyAll':

                case 'App\Http\Controllers\Admin\AdminInterviewController@index':
                case 'App\Http\Controllers\Admin\AdminInterviewController@store':
                case 'App\Http\Controllers\Admin\AdminInterviewController@update':
                case 'App\Http\Controllers\Admin\AdminInterviewController@destroy':
                case 'App\Http\Controllers\Admin\AdminInterviewController@create':
                case 'App\Http\Controllers\Admin\AdminInterviewController@edit':
                case 'App\Http\Controllers\Admin\AdminInterviewController@destroyAll':

                case 'App\Http\Controllers\Admin\AdminExcelExportController@index':
                case 'App\Http\Controllers\Admin\AdminExcelExportController@supportProgram':
                case 'App\Http\Controllers\Admin\AdminExcelExportController@supportProgramlist':

                case 'App\Http\Controllers\Admin\AdminProgramReservationController@destroyAll':
                case 'App\Http\Controllers\Admin\AdminProgramReservationController@index':
                case 'App\Http\Controllers\Admin\AdminProgramReservationController@store':
                case 'App\Http\Controllers\Admin\AdminProgramReservationController@update':
                case 'App\Http\Controllers\Admin\AdminProgramReservationController@destroy':
                case 'App\Http\Controllers\Admin\AdminProgramReservationController@edit':


                    $menu_id = 500;
                    break;

                case 'App\Http\Controllers\Admin\AdminBoardReviewLatestController@index':
                case 'App\Http\Controllers\Admin\AdminBoardReviewLatestController@store':
                case 'App\Http\Controllers\Admin\AdminBoardReviewLatestController@update':
                case 'App\Http\Controllers\Admin\AdminBoardReviewLatestController@destroy':
                case 'App\Http\Controllers\Admin\AdminBoardReviewLatestController@create':
                case 'App\Http\Controllers\Admin\AdminBoardReviewLatestController@edit':
                case 'App\Http\Controllers\Admin\AdminBoardReviewLatestController@destroyAll':
                    $menu_id = 600;
                    break;


                case 'App\Http\Controllers\Admin\AdminStudyRoomController@index':
                case 'App\Http\Controllers\Admin\AdminStudyRoomController@store':
                case 'App\Http\Controllers\Admin\AdminStudyRoomController@update':
                case 'App\Http\Controllers\Admin\AdminStudyRoomController@destroy':
                case 'App\Http\Controllers\Admin\AdminStudyRoomController@create':
                case 'App\Http\Controllers\Admin\AdminStudyRoomController@edit':
                case 'App\Http\Controllers\Admin\AdminStudyRoomController@destroyAll':

                case 'App\Http\Controllers\Admin\AdminStudyResevationController@index':
                case 'App\Http\Controllers\Admin\AdminStudyResevationController@store':
                case 'App\Http\Controllers\Admin\AdminStudyResevationController@update':
                case 'App\Http\Controllers\Admin\AdminStudyResevationController@destroy':
                case 'App\Http\Controllers\Admin\AdminStudyResevationController@create':
                case 'App\Http\Controllers\Admin\AdminStudyResevationController@edit':
                case 'App\Http\Controllers\Admin\AdminStudyResevationController@destroyAll':

                    // 스터디룸 날짜금지
                case 'App\Http\Controllers\Admin\AdminStudyRoomPreventionController@index':
                case 'App\Http\Controllers\Admin\AdminStudyRoomPreventionController@store':
                case 'App\Http\Controllers\Admin\AdminStudyRoomPreventionController@update':
                case 'App\Http\Controllers\Admin\AdminStudyRoomPreventionController@destroy':
                case 'App\Http\Controllers\Admin\AdminStudyRoomPreventionController@create':
                case 'App\Http\Controllers\Admin\AdminStudyRoomPreventionController@edit':
                case 'App\Http\Controllers\Admin\AdminStudyRoomPreventionController@destroyAll':
                    $menu_id = 700;
                    break;

                case 'App\Http\Controllers\Admin\AdminStatisticsController@index':
                case 'App\Http\Controllers\Admin\AdminStatisticsController@store':
                case 'App\Http\Controllers\Admin\AdminStatisticsController@update':
                case 'App\Http\Controllers\Admin\AdminStatisticsController@destroy':
                case 'App\Http\Controllers\Admin\AdminStatisticsController@create':
                case 'App\Http\Controllers\Admin\AdminStatisticsController@edit':
                case 'App\Http\Controllers\Admin\AdminStatisticsController@destroyAll':
                    $menu_id = 800;
                    break;

                case 'App\Http\Controllers\Admin\AdminLogController@index':
                case 'App\Http\Controllers\Admin\AdminLogController@store':
                case 'App\Http\Controllers\Admin\AdminLogController@update':
                case 'App\Http\Controllers\Admin\AdminLogController@destroy':
                case 'App\Http\Controllers\Admin\AdminLogController@create':
                case 'App\Http\Controllers\Admin\AdminLogController@edit':
                case 'App\Http\Controllers\Admin\AdminLogController@destroyAll':
                    $menu_id = 900;
                    break;

            }



            if (!$pass) {
                if (!$menu_id || !in_array($menu_id, $menus)) {
                    return redirect()->back()->with('error', '접근하실수없습니다.');
                }

            }

        }


        return $next($request);
    }
}
