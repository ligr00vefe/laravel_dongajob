<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminPermissionLog;
use App\Models\Log;
use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminManagerController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lists = Manager::paging($request);

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
        if (!Manager::getExists($account_id)) {

            $params = $request->only(['account', 'name', 'password']);
            $params['password'] = bcrypt($params['password']);
            $params['menu'] = implode(',', $menus);

            if (Manager::create($params)) {

                $action = "관리자 생성";
                $record = [
                    "user_id" => session()->get('user_id') ?? 1,
                    "action" => $action,
                    "target" => $account_id,
                    "comment" => '',
                    "path" => $request->getPathInfo(),
                    "ip" => $request->getClientIp()
                ];
                AdminPermissionLog::record($record);

                $record['action'] = "관리자 권한 " . $action;
                Log::record($record);

                redirect()->route("admin.member.manager.index")->with("success", "정상적으로 등록되었습니다.");

            }
        } else {
            return back()->with("error", "이미 등록되어 있는 아이디 입니다.");
        }


        return back()->with("error", "등록에 실패하였습니다.");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Manager $manager
     * @return \Illuminate\Http\Response
     */
    public function show(Manager $manager)
    {
        $lists = Menu::get();


        return view("admin.setting.menu.list", [
            'lists' => $lists['list']
        ]);
    }


    public function edit($id)
    {
        $update = Manager::find($id);

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
    public function update(Request $request, Manager $manager)
    {
        if (!$request->id)
            return back()->with("error", "수정하는데 실패 하였습니다. 다시 시도해 주세요.");

        $update = $manager::find($request->id);

        $update->name = $request->name;
        $update->menu = implode(',', $request->menu);

        if ($request->password) {
            $update->password = bcrypt($request->password);
        }

        if ($update->save()) {
            return back()->with("success", "정상적으로 수정되었습니다.");
        }

        return back()->with("error", "수정하는데 실패 하였습니다. 다시 시도해 주세요.");
    }

    // 개별 삭제
    public function destroy(Request $request)
    {
        if (isset($request->id)) {
            $delete = Manager::find($request->id);

            if ($delete->delete()) {

                $action = "관리자 삭제";
                $record = [
                    "user_id" => session()->get('user_id') ?? 1,
                    "action" => $action,
                    "target" => $delete->account,
                    "comment" => '',
                    "path" => $request->getPathInfo(),
                    "ip" => $request->getClientIp()
                ];

                AdminPermissionLog::record($record);
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
            $delete = Manager::find($id);

            if ($delete->delete()) {
                $action = "관리자 삭제";
                $record = [
                    "user_id" => session()->get('user_id') ?? 1,
                    "action" => $action,
                    "target" => $delete->account,
                    "comment" => '',
                    "path" => $request->getPathInfo(),
                    "ip" => $request->getClientIp()
                ];

                AdminPermissionLog::record($record);
                Log::record($record);
                $chk = true;
            }else {
                $chk = false;
                break;
            }
        }

        if ($chk)
            return redirect()->route("admin.member.manager.index")->with("success", "정상적으로 삭제되었습니다.");

        return back()->with("error", "삭제하는데 실패하였습니다. 다시 시도해 주세요.");
    }


}
