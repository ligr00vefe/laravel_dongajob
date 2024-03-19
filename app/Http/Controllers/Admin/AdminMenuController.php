<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class AdminMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = Menu::get();

        return view("admin.setting.menu.list", [
            "lists" => $lists['lists']
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.setting.menu.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Request $request)
    {
        $chk = false;

        if( isset($request->id) ) { // 개별 삭제
            $delete = Menu::find($request->id);

            if ($delete->delete())
                $chk = true;
        }

        if ($chk) {
            return redirect()->route("admin.setting.menu.index")->with("success", "정상적으로 삭제되었습니다.");
        }

        return back()->with("error", "삭제하는데 실패했습니다. 다시 시도해 주세요.");

    }

    public function destroyAll(Request $request)
    {
        $chk = false;

        foreach ($request->chk as $id) {
            $delete = Menu::find($id);

            if ($delete->delete())
                $chk = true;
        }

        if ($chk) {
            return redirect()->route("admin.setting.menu.index")->with("success", "정상적으로 삭제되었습니다.");
        }

        return back()->with("error", "삭제하는데 실패했습니다. 다시 시도해 주세요.");

    }
}
