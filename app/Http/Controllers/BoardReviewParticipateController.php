<?php

namespace App\Http\Controllers;

use App\Models\BoardReviewParticipate;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;

class BoardReviewParticipateController extends Controller
{

    public function index(Request $request)
    {
        $status_list = get_notice_status();

        // 게시글 가져오기
        $lists = BoardReviewParticipate::paging($request);

        // 작성자 가져오기
        foreach ($lists as $key => $val) {

            if (isStudentCheck($val->user_type)) {
                $student = Student::getStudent($val->account);
                $val->name = $student->name;
                $val->dpt = $student->department;
            } else if (isAdminCheck($val->user_type)) {
                $val->name = User::getUser($val->account)->name;
                $val->dpt = '-';
            }

            $val->comment_cnt = DB::table('comments')->where('board_id', $val->id)->where('board_title', 'reviewparticipate')->count();
        }

        // 검색
        $search = [
            'search' => $request->search,
            'term' => $request->term
        ];

        return View('archive.reviewparticipate.list', [
            "lists" => $lists,
            'search' => $search,
            "status_list" => $status_list,
            'view_count' => $request->view_count
        ]);
    }

    public function view($id)
    {
        if (!$id)
            return back()->with("error", msg_collection('access_impossible'));

        //--- 존재하지 않는 게시물 빠꾸
        if (!$list = DB::table('board_review_participates')->find($id)) {
            return redirect("/archive/reviewparticipate")->with("error", msg_collection('none_post'));
        }

        //--- 게시판 명칭
        $board_title = 'reviewparticipate';


        DB::table('board_review_participates')->where("id", $id)->increment('hit', 1);
        $list = DB::table('board_review_participates')->find($id);

        //--- 게시물 작성자 이름가져오기
        //--- 게시물 작성자 이름가져오기
        if (isStudentCheck($list->user_type)) {
            $student = Student::getStudent($list->account);
            $list->name = $student->name;
            $list->dpt = $student->department;
        } else if (isAdminCheck($list->user_type)) {
            $list->name = User::getUser($list->account)->name;
            $list->dpt = '-';
        }

        //--- 학번가져오기
        $account = session()->get('login_check') ? session()->get('account') : '';

        //--- 댓글 가져오기
        $index_nums = DB::table('comments')
            ->where(['board_title' => $board_title, 'class'=> 0])
            ->pluck('id');

        // 페이지네이션번호마다 포함되는 대댓글 개수파악
        $reply_count = DB::table('comments')
            ->where(['board_title' => $board_title, 'class'=> 1])
            ->whereIn('group_num',$index_nums)
            ->pluck('id');

        $array =Arr::collapse([$index_nums, $reply_count]);


        $comments = DB::table('comments')->where('board_id', $id)
            ->whereIn('group_num',$array)
            ->orderBy('group_num','asc')
            ->orderBy('id','asc')
            ->orderBy('order','asc')
            ->get();


        //--- 작성자와 로그인사용자가 일치하는지 체크
        $writer_check = session()->get('login_check') && session()->get('account') == $list->account ?: false;
        $login_check = (bool)session()->get('login_check');

        //---- 이전 게시물 가져오기
        $prev_list = DB::table("board_review_participates")->where('id', '<', $id)->orderBy('id', 'desc')->first();

        //---- 다음 게시물 가져오기
        $next_list = DB::table("board_review_participates") ->where('id', '>', $id)->orderBy('id', 'asc')->first();

        return View('archive.reviewparticipate.view', [
            'list' => $list,
            'comments' => $comments,
            'account' => $account,
            'board_title' => $board_title,
            'writer_check' => $writer_check,
            'login_check' => $login_check,
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
        return View('archive.reviewparticipate.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params = $request->only(['status_id', 'subject']);
        $params['contents'] = addslashes($request->contents);
        $params['account'] = session()->get('account');
        $params['user_type'] = get_manager_type_value(session()->get('donga_type'));


        // 첨부파일 등록했는지 체크
        if ($request->file()) {

            // 첨부파일 등록
            $attachment = new BoardReviewParticipate;
            $attach = $attachment->set($request);

            // 리턴된 값이 없으면 return 하여 db에 저장하지 않음
            if (!$attach)
                return;

            for ($i = 1; $i <= 2; $i++) {
                if (isset($attach['attachment' . $i])) {
                    $params['attachment' . $i] = $attach['attachment' . $i];
                }
            }
        }

        if (BoardReviewParticipate::create($params)) {
            return redirect()->route("archive.reviewparticipate.index")->with("success", msg_collection('success_enrollment'));
        }

        return back()->with("error", msg_collection('error_enrollment'));
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
        if ($update = BoardReviewParticipate::find($id)) {
            return view('archive.reviewparticipate.create', [
                'list' => $update
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BoardReviewParticipate $reviewParticipate)
    {
        if (!$request->id) {
            return back()->with("error", msg_collection('failure_correction'));
        }

        $update = $reviewParticipate::find($request->id);
        $update->subject = $request->subject;
        $update->contents = addslashes($request->contents);

        if ($request->file()) {
            $attachment = new BoardReviewParticipate;
            $attach = $attachment->set($request);

            if (!$attach)
                return;

            for ($i = 1; $i <= 2; $i++) {
                if (isset($attach['attachment' . $i])) {
                    $update['attachment' . $i] = $attach['attachment' . $i];
                }
            }
        }

        if ($update->save()) {
            return redirect()->route("archive.reviewparticipate.index")->with("success", msg_collection('success_correction'));
        }

        return back()->with("error", msg_collection('failure_correction'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (isset($request->id)) {
            $board = new BoardReviewParticipate;
            $delete = BoardReviewParticipate::find($request->id);

            if ($delete->delete()) {

                /* for ($i = 1; $i < 5; $i++) {
                     $board->file_delete($request->method(), $delete['attachment' . $i]);
                 }*/

                return redirect()->route("archive.reviewparticipate.index")->with("success", "정상적으로 삭제되었습니다.");
            }
        }

        return back()->with("error", "삭제하는데 실패했습니다. 다시 시도해 주세요.");
    }

    // 선택 삭제
    public function destroyAll(Request $request)
    {
        $chk = false;
        foreach ($request->chk as $id) {
            $delete = BoardReviewParticipate::find($id);

            if ($delete->delete())
                $chk = true;
            else {
                $chk = false;
                break;
            }
        }

        if ($chk)
            return back()->with("success", "정상적으로 삭제되었습니다.");

        return back()->with("error", "삭제하는데 실패하였습니다. 다시 시도해 주세요.");
    }
}
