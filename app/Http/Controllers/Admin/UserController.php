<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccessLog;
use App\Models\AdminPermissionLog;
use App\Models\Log;
use App\Models\Manager;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->level = 1;
        $lists = User::paging($request);
        $search = [
            'search' => $request->search,
            'term' => $request->term
        ];

        return view("admin.member.manager.list", [
            'lists' => $lists,
            'search' => $search
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.member.manager.create");
    }


    public function store(Request $request)
    {
        $account_id = $request->account;
        $menus = $request->menu;


        //--- 등록이 되지 않았는지 체크
        if (!User::getExists($account_id)) {

            $params = $request->only(['account', 'name', 'password', 'ip']);
            $params['password'] = bcrypt($params['password']);
            $params['menu'] = implode(',', $menus);
            $params['level'] = 1;
            $params['remember_token'] = Str::random(32);


            if (User::create($params)) {

                $action = "관리자생성";
                $record = [
                    "user_id" => session()->get('user_id') ?? 1,
                    "action" => $action,
                    "target" => $account_id,
                    "path" => $request->getPathInfo(),
                    "ip" => $request->getClientIp(),
                    'comment' => session()->get('account') . '님이 ' . $params['account'] . $action . ' 했습니다.'
                ];
                Log::record($record);

                return redirect()->route("admin.member.manager.index")->with("success", "정상적으로 등록되었습니다.");
            }
        } else {
            return back()->with("error", "이미 등록되어 있는 아이디 입니다.");
        }


        return back()->with("error", "등록에 실패하였습니다.");
    }


    public function edit($id)
    {
        $update = User::find($id);

        if ($update) {
            return view("admin.member.manager.create", [
                "list" => $update
            ]);
        }

        return redirect()->route("admin.member.manager.index")->with("error", "잘못접근되었습니다.");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Manager $manager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if (!$request->id)
            return back()->with("error", "수정하는데 실패 하였습니다. 다시 시도해 주세요.");


        $update = $user::find($request->id);

        //--- 어떤권한이 변경되었는지
        $current_menu = $update->menu;
        $change_menu = implode(',', $request->menu);

        $update->name = $request->name;
        $update->menu = $change_menu;
        $update->ip = $request->ip;
        $password = $request->password;


        //--- 비밀번호 변경시
        if ($password) {

            //--- 이전 비밀번호와 같은지 체크
            if (password_verify($password, $update->password)) {
                return back()->with("error", "동일한 비밀번호는 변경 불가능 합니다.");
            }

            $update->password = bcrypt($password);
        }

        if ($update->save()) {

            //--- 로그기록 저장
            $action = '관리자수정';
            $record = [
                "user_id" => session()->get('user_id') ?? 1,
                "action" => $action,
                "target" => $update->account,
                "keyword" => $current_menu . '/' . $change_menu,
                'comment' => session()->get('account') . '님이 ' . $update->account . $action . ' 했습니다.',
                "path" => $request->getPathInfo(),
                "ip" => $request->getClientIp()
            ];
            Log::record($record);


            return back()->with("success", "정상적으로 수정되었습니다.");
        }

        return back()->with("error", "수정하는데 실패 하였습니다. 다시 시도해 주세요.");
    }

    // 개별 삭제
    public function destroy(Request $request)
    {
        if (isset($request->id)) {
            $delete = User::find($request->id);
            $delete->level = 0;
            if ($delete->update()) {

                $action = "관리자삭제";
                $record = [
                    "user_id" => session()->get('user_id') ?? 1,
                    "action" => $action,
                    "target" => $delete->account,
                    'comment' => session()->get('account') . '님이 ' . $delete->account . $action . ' 했습니다.',
                    "path" => $request->getPathInfo(),
                    "ip" => $request->getClientIp()
                ];

                Log::record($record);

                return redirect()->route("admin.member.manager.index")->with("success", "정상적으로 삭제되었습니다.");
            }
        }

        return back()->with("error", "삭제하는데 실패했습니다. 다시 시도해 주세요.");
    }

    // 선택 삭제
    public function destroyAll(Request $request)
    {
        $chk = false;
        foreach ($request->chk as $id) {

            $delete = User::find($id);
            $delete->level = 0;
            if ($delete->update()) {

                $action = "관리자삭제";
                $record = [
                    "user_id" => session()->get('user_id') ?? 1,
                    "action" => $action,
                    "target" => $delete->account,
                    'comment' => session()->get('account') . '님이 ' . $delete->account . $action . ' 했습니다.',
                    "path" => $request->getPathInfo(),
                    "ip" => $request->getClientIp()
                ];

                Log::record($record);
                $chk = true;
            } else {
                $chk = false;
                break;
            }
        }

        if ($chk) {
            return redirect()->route("admin.member.manager.index")->with("success", "정상적으로 삭제되었습니다.");
        }

        return back()->with("error", "삭제하는데 실패하였습니다. 다시 시도해 주세요.");
    }


    public
    function search(Request $request)
    {

        $data = '';
        $status = 200;
        if ($request->account) {
            if ($user = User::getUser($request->account, $request->student_name)) {


                // 검색한 대상체가 자기 자신일 때
                if ($user->id == session()->get('user_id')) {
                    $status = 204;
                }

                $data = [
                    'account' => $user->account,
                    'name' => $user->name
                ];

            }
        }

        return response()->json([
            'status' => $data ? $status : 404,
            'data' => $data
        ]);
    }


    public function isAdmin(Request $request)
    {
        $result = User::getExists($request->account);


        $response = 0;

        if ($result) {
            $data = '<span style="color: red">사용 불가능</span>';
        } else {
            $data = '<span style="color: blue">사용가능</span>';
            $response = 1;
        }


        return response()->json([
            'data' => $data,
            'response' => $response
        ]);
    }

    public function limit(Request $request)
    {
        $accessLog = new AccessLog();

        return response()->json([
            'response' => $accessLog->limitPermit($request->value, $request->id)
        ]);
    }
}
