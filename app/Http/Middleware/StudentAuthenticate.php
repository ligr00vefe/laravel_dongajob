<?php

namespace App\Http\Middleware;

use App\Models\accessStudent;
use App\Models\StatisticsLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class StudentAuthenticate
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
        //--- 방문자 기록 저장
        $request_ip = $request->ip();
        $path = $request->path();
        $route_name = Route::current()->action['controller'];
        $devel = [
            '118.235.41.211',
            ' 115.88.69.98'
        ];


        // 동시접속체크 (로그인시에는 동시접속을 체크를 하지 않는다.)
        if (($route_name !== 'App\Http\Controllers\LoginController@index' && session()->get('account') && isStudentCheck(session()->get('donga_type'))) || isStaffCheck(session()->get('donga_type'))) {
            $tokenInfo = accessStudent::getToken(session()->get('account'));

            if(empty($tokenInfo)){
                session()->flush();
                return redirect()->route('logout', ['access' => 2]);
            }

            if ($tokenInfo->remember_token != session()->get('token')) {
                session()->flush();
                return redirect()->route('logout', ['access' => 1]);
            }

        }


        if (Cookie::get('visit_ip') != $request_ip) {

            // 쿠키 세팅
            Cookie::queue('visit_ip', $request_ip, 86400);

            // 저장
            $result = StatisticsLog::insert([
                'ip' => $request_ip,
                'referer' => $request->headers->get('referer'),
                'agent' => $request->headers->get('user-agent'),

            ]);
        }

        //--- 비로그인시 접근 제한
        if (!$request->session()->get('login_check')) {

            // 입장불가 path
            $impossibles = [
                'jobinfo',
                'program',
                'archive',
                'studyroom',
                'course',
                'mypage'
            ];

            // 입장불가 url 이면 로그인페이지로 리다이렉트
            foreach ($impossibles as $impossible) {
                if (strpos($path, $impossible) !== false) {
                    return redirect()->route('login')->with("error", "로그인 후 이용 가능합니다.");
                }
            }
        }

        //--- 관계자 입장 제한
        if (isStaffCheck($request->session()->get('donga_type'))) {
            // 입장불가 path
            $impossibles = [
                'program/interview'
            ];

            // 입장불가 url 이면 로그인페이지로 리다이렉트
            foreach ($impossibles as $impossible) {
                if (strpos($path, $impossible) !== false) {
                    return redirect()->back()->with("error", "관계자는 이용 불가능합니다.");
                }
            }

        }


        return $next($request);
    }
}
