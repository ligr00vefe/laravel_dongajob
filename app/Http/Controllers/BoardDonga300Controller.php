<?php

namespace App\Http\Controllers;

use App\Boards\Donga300;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Blade;

class BoardDonga300Controller extends Controller
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

//        $request->term ='광역시';
//        $area_lists = get_work_area_lists();
//        $arr = [];
//        foreach ($area_lists as $list) {
//
//            if(strpos($area_lists , $request->area) !== false) {
//                $arr[] = $list;
//            }
//
//        }

        // 게시글 가져오기
        $lists = $this->board->normalGet($request);

        $search = [
            'search' => $request->search ?: '',
            'term' => $request->term ?: ''
        ];

        return View('jobinfo.donga300.list', [
            'lists' => $lists,
            'count' => count($lists),
            'search' => $search,
            'view_count' => $request->view_count
        ]);
    }

    public function view($id)
    {
        $list = DB::table('board_donga300s')
            ->where("id", "=", $id)
            ->first();

        //--- 조회수 증가
        $this->board->hitUp($id);

        //--- 첨부파일 가져오기
        $files = Attachment::getAll($list);

        //---- 이전 게시물 가져오기
        $prev_list = DB::table("board_donga300s")->where('id', '<', $id)->orderBy('id', 'desc')->first();

        //---- 다음 게시물 가져오기
        $next_list = DB::table("board_donga300s") ->where('id', '>', $id)->orderBy('id', 'asc')->first();


        return View('jobinfo.donga300.view', [
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
        return View('jobinfo.donga300.create');
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
            return redirect("/jobinfo/donga300")->with("msg", "글을 작성했습니다.");
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
