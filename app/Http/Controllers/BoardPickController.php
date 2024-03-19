<?php

namespace App\Http\Controllers;


use App\Boards\Pick;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BoardPickController extends Controller
{
    protected Pick $board;

    public function __construct(Request $request)
    {
        $this->board = new Pick();
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

        return View('jobinfo.pick.list', [
            'lists' => $lists,
            'count' => count($lists),
            'keyword' => $request->keyword,
            'term' => $request->term ?: '',
            'view_count' => $request->view_count
        ]);
    }

    public function view($id)
    {
        $list = DB::table('board_picks')
            ->where("id", "=", $id)
            ->first();

        //--- 조회수 증가
        $this->board->hitUp($id);

        //---- 이전 게시물 가져오기
        $prev_list = DB::table("board_picks")->where('id', '<', $id)->orderBy('id', 'desc')->first();

        //---- 다음 게시물 가져오기
        $next_list = DB::table("board_picks") ->where('id', '>', $id)->orderBy('id', 'asc')->first();

        return View('jobinfo.pick.view', [
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
            return View('jobinfo.pick.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $write = $this->board->write($request);

        if ($write)
        {
            return redirect("/jobinfo/pick")->with("msg", "글을 작성했습니다.");
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
