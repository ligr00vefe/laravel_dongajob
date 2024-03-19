<?php

namespace App\Http\Controllers;

use App\Boards\Notice;
use App\Models\BoardNotice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Blade;

class BoardNoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category_list = get_notice_category();
        $status_list = get_notice_status();
        $category = $request->category ?? key($category_list);

        // 게시글 가져오기
        $lists = BoardNotice::paging($request, $category);

        // 작성자 가져오기
        foreach ($lists as $key => $val) {
            $val->name = User::find($val->user_id)->name;
        }

        // 검색
        $search = [
            'search' => $request->search,
            'term' => $request->term
        ];

        return View('program.notice.list', [
            "lists" => $lists,
            'search' => $search,
            "category" => $category,
            "category_list" => $category_list,
            "status_list" => $status_list,
            'view_count' => $request->view_count
        ]);

    }

    public function view($id)
    {
        //--- 공지사항 id 안들어오면 빠꾸
        if (!$id)
            return back()->with("error", msg_collection('access_impossible'));


        $list = DB::table('board_notices')->find($id);
        if(!$list = DB::table('board_notices')->find($id))
            return back()->with("error", msg_collection('none_post')); // 게시물이 없을때 빠꾸

        $list->user_id = DB::table('users')->find($list->user_id)->name;

        //--- 조회수증가
        DB::table('board_notices')->where("id", $id)->increment('hit', 1);

        //---- 이전 게시물 가져오기
        $prev_list = DB::table("board_notices")->where('id', '<', $id)->orderBy('id', 'desc')->first();

        //---- 다음 게시물 가져오기
        $next_list = DB::table("board_notices") ->where('id', '>', $id)->orderBy('id', 'asc')->first();

        return View('program.notice.view', [
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
        return View('program.notice.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $write = BoardNotice::write($request);

        if ($write) {
            return redirect("/program/notice")->with("msg", "글을 작성했습니다.");
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

    public function get(Request $request): \Illuminate\Http\JsonResponse
    {
        //--- 카테고리 값 안들어오면 빠꾸
        if (!$request->category) {
            return response()->json(['status' => 404]);
        }

        // 게시글 가져오기
        $lists = '';
        $posts = BoardNotice::paging($request, $request->category, 4);
        if ($request->mode == 'main') {
            $lists = get_notice_html($posts);
        }


        return response()->json([
            'status' => $lists ? 200 : 406,
            'lists' => $lists
        ]);
    }


}
