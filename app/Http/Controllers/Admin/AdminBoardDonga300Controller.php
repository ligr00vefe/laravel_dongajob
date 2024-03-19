<?php

namespace App\Http\Controllers\Admin;

use App\Boards\Donga300;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Blade;

class AdminBoardDonga300Controller extends Controller
{
    protected Donga300 $board;

    public function __construct(Request $request)
    {
        $this->board = new Donga300();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 게시글 가져오기
        $lists = $this->board->normalGet($request);

        $search = [
            'search' => $request->search,
            'term' => $request->term ?: ''
        ];

        return View('admin.jobinfo.donga300.list', [
            'lists' => $lists,
            'count' => count($lists),
            'search' => $search,
            'view_count' => $request->view_count
        ]);
    }

    public function view($id)
    {
        $get = DB::table('board_donga300s')
            ->where("id", "=", $id)
            ->first();

        DB::table('board_donga300s')->where("id", $id)
            ->increment('hit',1);

            return View('admin.jobinfo.donga300.view', ['list' => $get]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('admin.jobinfo.donga300.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->contentts = addslashes($request->contents);
        $write = $this->board->write($request);

        if ($write)
        {
            return redirect()->route("admin.jobinfo.donga300.index")->with("success", msg_collection('success_enrollment'));
        }
        else
        {
            return back()->with("error", msg_collection('error_enrollment'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $list = $this->board->find($id);

        $original_names = [];
        for($i = 1; $i <= 5; $i++) {
            $property = 'attachment'.$i;
            if(!$list->$property)
                continue;

            $original_names[$i] = DB::table("attachments")->where("id", $list->$property)->first()->original_name;
        }

        return view("admin.jobinfo.donga300.create", [
            "list" => $list,
            "original_names" => $original_names
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->contentts = addslashes($request->contents);
        $update = $this->board->update($request);
        if ($update)
        {
            return redirect()->route("admin.jobinfo.donga300.index")->with("success", msg_collection('success_enrollment'));
        }
        else
        {
            return back()->with("error", msg_collection('error_enrollment'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // 개별 삭제
    public function destroy(Request $request)
    {
        if (isset($request->id)) {

            $delete = $this->board->delete($request->id);

            if ($delete) {

                /*     for ($i = 1; $i < 5; $i++) {
                         $board->file_delete($request->method(), $delete['attachment' . $i]);
                     }*/

                return redirect()->route("admin.jobinfo.donga300.index")->with("success", msg_collection('success_remove'));
            }else
            {
                return back()->with("error", msg_collection('failure_remove'));
            }
        }

        return back()->with("error", msg_collection('none_post'));
    }

    // 선택 삭제
    public function destroyAll(Request $request)
    {
        $chk = false;
        foreach ($request->chk as $id) {
            $delete = $this->board->delete($id);

            if ($delete)
                $chk = true;
            else {
                $chk = false;
                break;
            }
        }

        if ($chk)
            return redirect()->route("admin.jobinfo.donga300.index")->with("success", "정상적으로 삭제되었습니다.");

        return back()->with("error", "삭제하는데 실패하였습니다. 다시 시도해 주세요.");
    }

}
