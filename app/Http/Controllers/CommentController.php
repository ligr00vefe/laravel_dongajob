<?php

namespace App\Http\Controllers;


use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function edit($id)
    {
        if ($update = Comment::find($id)) {

            $account = '';
            if (session()->get('login_check')) {
                $account = session()->get('account');
            }

            return view('comment.create', [
                'list' => $update,
                'mode' => '수정',
                'account' => $account
            ]);
        }
    }


    public function store(Request $request)
    {
        if (!session()->get('login_check'))
            return back()->with("error", msg_collection('failure_login'));


        $params = $request->only('comment', 'board_id', 'board_title');
        $params['account'] = session()->get('account');
        $params['created_at'] = \Carbon\Carbon::now();
        $params['updated_at'] = \Carbon\Carbon::now();
        $params['writer_type'] = get_manager_type_value(session()->get('donga_type'));


        //테이블 틀에 이름, 내용 게시글 번호를 저장하고 indexComments값을 가져옵니다.
        $store = DB::table('comments')->insertGetId($params);

        // 댓글이기 떄문에 이 인덱스 값을 그룹번호로 저장해줍니다.
        DB::table('comments')->where('id', $store)->update(['group_num' => $store]);
        if ($confirm = DB::table('comments')->where('id', $store)->first()) {
            return back()->with("success", msg_collection('success_enrollment'));
        } else {
            return back()->with("success", msg_collection('error_enrollment'));
        }

    }

    public function answer($id)
    {
        if ($update = Comment::find($id)) {

            $account = '';
            if (session()->get('login_check')) {
                $account = session()->get('account');
            }

            return view('comment.create', [
                'list' => $update,
                'mode' => '답변',
                'account' => $account,
            ]);
        }
    }

    public function continuity(Request $request)
    {
        //대댓글 작성한 댓글의 인덱스 번호를 가져옵니다.(그룹번호로 저장해야합니다.)
        $params = $request->only('board_id', 'board_title');
        $params['group_num'] = $request->input('id');


        //저장하려는 대댓글이 첫 대댓글인지 확인하기위한 쿼리입니다. 순서를 정해야하기때문에요
        $order_num = DB::table('comments')->where($params)->orderBy('order', 'desc')->first();

        $params['class'] = 1;
        $params['account'] = session()->get('account');
        $params['order'] = $order_num ? $order_num->order + 1 : 0;
        $params['comment'] = $request->comment;
        $params['created_at'] = \Carbon\Carbon::now();
        $params['updated_at'] = \Carbon\Carbon::now();
        $params['writer_type'] = get_manager_type_value(session()->get('donga_type'));


        //가장 마지막 대댓글 숫자에 +1을 추가해서 저장해줍니다.
        $store = DB::table('comments')->insertGetId($params);


        if ($confirm = DB::table('comments')->where('id', $store)->first()) {
            return back()->with("success", msg_collection('success_enrollment'));
        } else {
            return back()->with("error", msg_collection('error_enrollment'));
        }
    }


    public function update(Request $request)
    {
        if ($update = Comment::find($request->id)) {
            $update->comment = $request->comment;

            if ($update->save()) {
                return back()->with("success", "정상적으로 수정되었습니다.");
            } else {
                return back()->with("error", "문제가 발생했습니다. 다시 시도해 주세요");
            }

        } else {
            return back()->with("error", "문제가 발생했습니다. 다시 시도해 주세요");
        }
    }

    public function destroy(Request $request)
    {

        if (isset($request->comment_id)) {
            $delete = Comment::find($request->comment_id);

            if ($delete->delete()) {
                return back()->with("success", msg_collection('success_remove'));
            }
        }

        return back()->with("error", "삭제하는데 실패했습니다. 다시 시도해 주세요.");
    }
}
