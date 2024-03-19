<?php

namespace App\Http\Controllers;

use App\Boards\Activity;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;

class BoardActivityController extends Controller
{
    protected Activity $board;

    public function __construct(Request $request)
    {
        $this->board = new Activity();
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

        return View('jobinfo.activity.list', [
            'lists' => $lists,
            'count' => count($lists),
            'search' => $search,
            'view_count' => $request->view_count
        ]);

    }

    public function view($id)
    {
        $list = DB::table('board_activitys')
            ->where("id", "=", $id)
            ->first();

        DB::table('board_activitys')->where("id", $id)
            ->increment('hit',1);

        //--- 첨부파일 가져오기
        $files = Attachment::getAll($list);

        //---- 이전 게시물 가져오기
        $prev_list = DB::table("board_activitys")->where('id', '<', $id)->orderBy('id', 'desc')->first();

        //---- 다음 게시물 가져오기
        $next_list = DB::table("board_activitys") ->where('id', '>', $id)->orderBy('id', 'asc')->first();

        return View('jobinfo.activity.view', [
            'list' => $list,
            'files' => $files,
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
        return View('jobinfo.activity.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->contents = addslashes($request->contents);
        $write = $this->board->write($request);

        if ($write)
        {
            return redirect("/jobinfo/activity")->with("msg", "글을 작성했습니다.");
        }
        else
        {
            return back()->with("error", "문제가 발생했습니다. 다시 시도해 주세요");
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
