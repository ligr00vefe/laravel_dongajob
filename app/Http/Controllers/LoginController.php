<?php

namespace App\Http\Controllers;

use App\Models\AccessLog;
use App\Models\accessStudent;
use App\Models\Privacys;
use App\Models\Student;
use dongaAdminAccess;
use Illuminate\Support\Facades\DB;
use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;
use phpDocumentor\Reflection\Types\True_;

class LoginController extends Controller
{

    public function index(Request $request)
    {
        //--- 로그인상태라면 빠꾸
        if (session()->get('login_check'))
            return redirect()->back();


        if (isAdminCheck(session()->get('donga_type'))) { // 관리자일시
            return redirect('/' . ADMIN_URL);
        }

        if (isStudentCheck(session()->get('donga_type'))) { // 학생일시
            return redirect('/');
        }

        return view('login', [
            'redirect' => $request->redirect
        ]);
    }


    public function create(Request $request)
    {
        //--- 임시 저장용
        $params = $request->only(['name', 'sutdent_id', 'password']);
        $params['password'] = bcrypt($params['password']);
        $user = User::create($params);

        return response()->json($user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function login(Request $request)
    {
        $accessLog = new AccessLog();
        $adminAccess = new dongaAdminAccess();
        $params = ['account' => $request->user_id, 'password' => $request->user_password];


        //--- 관리자 로그인 횟수 체크
        if (User::getUser($params['account']) && $accessLog->isAccessCheck($params['account'])) {
            $msg = '로그인 ' . $accessLog->access_cnt . ' 회 이상 실패로 인해 로그인이 불가능합니다. \n관리자에게 연락 바랍니다.';
            return back()->with("status", $msg);
        }


        //--- 관리자 로그인
        if (Auth::attempt($params)) {


            //--- 삭제된 관리자인지 체크
            if (isDeleteCheck(Auth::user()->level)) {
                return back()->with("status", '로그인 정보를 확인 하세요.');
            }


            //--- 입장가능 IP 체크
            if (Auth::user()->level == 1 && !$adminAccess->isAccess(Auth::user()->ip)) {
                return back()->with("status", '외부에서 접근이 불가능합니다.');
            }

            //--- 관리자 로그인횟수 초기화
            $accessLog->initialization($params['account']);


            $request->session()->put('user_id', Auth::user()->id);
            $request->session()->put('account', Auth::user()->account);
            $request->session()->put('name', Auth::user()->name);
            $request->session()->put('menu', Auth::user()->menu);
            $request->session()->put('donga_type', 'admin');
            $request->session()->put('login_check', 'true');
            $request->session()->put('level', Auth::user()->level);


            //--- 허용된 페이지로 리다이렉트
            $url = session()->get('level') == 1 ? ADMIN_URL . get_admin_menu_route(explode(',', Auth::user()->menu)[0]) : ADMIN_URL;
            $redirect = '/' . $url;
            return redirect()->intended($redirect);
        }


        //--- 학생정보 로그인 : 입력한정보가 맞을경우 (테스트서버에서만 사용)
        /*
        if ($user = DB::table("students")->where("account", "=", $params['account'])->first()) {

            // 비밀번호가 다를경우
            if (!password_verify($params['password'], $user->password)) {
                return back()->with('status', '로그인 정보를 확인하세요.');
            }



            $request->session()->put('account', $user->account);
            $request->session()->put('name', $user->name);
            $request->session()->put('university', $user->university);
            $request->session()->put('department', $user->department);
            $request->session()->put('grade', $user->grade);
            $request->session()->put('academic', $user->academic);
            $request->session()->put('phone_number', $user->phone_number);
            $request->session()->put('email', $user->email);
            $request->session()->put('year', $user->year);
            $request->session()->put('line', $user->line);
            $request->session()->put('grade_score', $user->grade_score);
            $request->session()->put('type', $user->type);
            $request->session()->put('account', $user->account);
            $request->session()->put('donga_type', 'student');
            $request->session()->put('login_check', 'true');


            return redirect()->intended('/');
        }
        */


        //--- 로그인 제한 횟수 증가
        $msg = '로그인 정보를 확인하세요.';
        if (User::getUser($params['account'])) {
            $cnt = $accessLog->countUp($params['account']);
            $msg .= '\n' . $cnt . '/' . $accessLog->access_cnt . ' 실패시 로그인이 제한됩니다.';
        }


        return back()->with("status", $msg);
    }

    /**
     * 동아대학생로그인 (동아대학생로그인은 해당 메서드를 사용함)
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function dongaLogin(Request $request)
    {

        //접속정보가 잘못되었을경우
        if (!$request->accounts) {
            // 비밀번호 5회초과시 문구
            //$msg = $request->err_cd == 'LOGIN_FALSE_CNT_OVE' ? explode('.', $request->msg)[0] . '관리자에게 초기화 진행 요청 바랍니다.' : $request->msg;
            $msg = '동아대학교 학생정보(student.donga.ac.kr)에 접속하시어 비밀번호 변경 바랍니다';
            return redirect()->route('login')->with("status", $msg ?: "로그인 정보를 확인하세요.");
        }


        //$account = KISA_GET_DATA($request->account);
        $account = $request->accounts; // 학생계정
        $donga_type = get_manager_value_type(KISA_GET_DATA($request->type)); // 교직원 or 학생타입
        $token = bin2hex(random_bytes(32));

        // 학생정보 전체를 동아대서버에서 가져옴
        if ($student = Student::getStudent($account)) {

            // 토큰이없을경우 insert를 진행하고 있을경우 update를 진행한다.
            accessStudent::isToken($account) ? accessStudent::updateToken($account, $token) : accessStudent::setToken($account, $token);

            // 학생정보는 세션에 저장
            $request->session()->put('account', $account);
            $request->session()->put('name', $student->name);
            $request->session()->put('university', $student->university);
            $request->session()->put('department', $student->department);
            $request->session()->put('grade', $student->grade);
            $request->session()->put('academic', $student->academic);
            $request->session()->put('phone_number', $student->phone_number);
            $request->session()->put('email', $student->email);
            $request->session()->put('year', $student->year);
            $request->session()->put('line', $student->line);
            $request->session()->put('grade_score', $student->grade_score);
            $request->session()->put('type', $student->type);
            $request->session()->put('donga_type', $donga_type);
            $request->session()->put('token', $token);
            $request->session()->put('login_check', 'true');

            return redirect()->route('main');
        }

        // 토큰이없을경우 insert를 진행하고 있을경우 update를 진행한다.
        accessStudent::isToken($account) ? accessStudent::updateToken($account, $token) : accessStudent::setToken($account, $token);
        // 관계자 일때 (관계자는 가져온정보를 바로 세션에 담는다.)
        $request->session()->put('account', $account);
        $request->session()->put('name', KISA_GET_DATA($request->name));
        $request->session()->put('phone_number', $request->phone_number == '-' ?: KISA_GET_DATA($request->phone_number));
        $request->session()->put('email', $request->email == '-' ?: KISA_GET_DATA($request->email));
        $request->session()->put('year', KISA_GET_DATA($request->year));
        $request->session()->put('type', KISA_GET_DATA($request->type));
        $request->session()->put('donga_type', $donga_type);
        $request->session()->put('login_check', 'true');
        $request->session()->put('token', $token);

        return redirect()->route('main');


        return redirect()->route('login')->with("status", "로그인 정보를 확인하세요.");
    }


    public function logout(Request $request)
    {
        $donga_type = session()->get('donga_type');
        $msg = "로그아웃 되었습니다.";
        Auth::logout();
        session()->flush();


        //--- 동아대서버이면 sso 로그아웃 처리
        if (isDongaServer()) {
            if (isStudentCheck($donga_type) || isStaffCheck($donga_type)) {
                return redirect()->to('/exsignon/sso/logout.php');
            }
        }


        // 중복 로그인일경우 (middleware/StudentAuthenticate.php에서 체크)
        if ($request->input('access') === 1) {
            $msg = '다른 환경에 동일한 ID가 로그인되어 로그아웃되었습니다.';
        } else if($request->input('access') === 2) {
            $msg = '로그인 정보가 올바르지 않습니다.';
        }
        return redirect()->intended('/')->with("status", $msg);

    }


//로그인 했는지 체크
    public function check()
    {

        $check = (bool)session()->get('login_check');


        return response()->json([
            'status' => 200,
            'check' => $check
        ]);

    }

    //--- 자동로그아웃시 체크
    public function autoLogout()
    {
        return response()->json([
            'status' => $this->check()->original['check'] ? 200 : 404
        ]);
    }

    //--- donga 타입 반환
    public function getType()
    {
        return response()->json([
            'type' => session()->get('donga_type')
        ]);
    }

    public function isPrivacy(Request $request)
    {
        $status = 404;

        if (Student::isStudent($request->account)) {
            $status = Privacys::isPrivacy($request->account) ? 200 : 204;
        }


        return response()->json([
            'status' => $status
        ]);
    }

    public function setPrivacy(Request $request)
    {
        if (!Privacys::isPrivacy($request->account)) {
            return response()->json([
                'status' => Privacys::setPrivacy($request->account, $request->yn) ? 200 : 404
            ]);
        }

        return response()->json([
            'status' => 204
        ]);


    }


}
