<?php

namespace App\Http\Controllers;

use App\Boards\Interview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Blade;

class BoardInterviewController extends Controller
{


    public function __construct(Request $request)
    {
        $this->board = new Interview();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        return View('program.interview.list');
    }

    public function view($id)
    {
        $list = DB::table('board_interviews')
            ->where("id", "=", $id)
            ->first();

        //---- 이전 게시물 가져오기
        $prev_list = DB::table("board_interviews")->where('id', '<', $id)->orderBy('id', 'desc')->first();

        //---- 다음 게시물 가져오기
        $next_list = DB::table("board_interviews")->where('id', '>', $id)->orderBy('id', 'asc')->first();

        return View('program.interview.view', [
            'list' => $list,
            'prev_list' => $prev_list,
            'next_list' => $next_list
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('program.interview.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->contents = addslashes($request->contents);
        $write = $this->board->write($request);

        if ($write) {

            if (is_manager_check(session()->get('donga_type'))) {
                return redirect('/program/interview')->with("success", '작성이 완료되었습니다.\n관리자는 관리자페이지에서 확인바랍니다.');
            } else {
                return redirect()->route("mypage.interview.list")->with("success", "작성이 완료되었습니다.");
            }


        } else {
            return back()->with("error", "문제가 발생했습니다. 다시 시도해 주세요");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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

    public function resultUpdate()
    {

        return View('program.interview.result');
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
}
