<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BoardReviewLatest;
use App\Models\BoardReviewBefore;


class AdminBoardReviewLatestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 게시글 가져오기
        $lists = BoardReviewLatest::paging($request);

        //--- 글작성자 학생정보가져오기
        foreach ($lists as $key => $val) {
            if (isStudentCheck($val->user_type)) {
                $student = Student::getStudent($val->account);
                $val->name = $student->name;
                $val->dpt = $student->department;
            } else if (isAdminCheck($val->user_type)) {
                $val->name = User::getUser($val->account)->name;
                $val->dpt = '-';
            }
        }

        $search = [
            'search' => $request->search,
            'term' => $request->term
        ];

        return View('admin.archive.reviewlatest.list', [
            "lists" => $lists,
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
        return View('admin.archive.reviewlatest.create');
    }

       /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params = $request->only('subject');
        $params['contents'] = addslashes($request->contents);
        $params['account'] = session()->get('account');
        $params['user_type'] = get_manager_type_value(session()->get('donga_type'));

        // 첨부파일 등록했는지 체크
        if ($request->file()) {

            // 첨부파일 등록
            $attachment = new BoardReviewLatest;
            $attach = $attachment->set($request);

            // 리턴된 값이 없으면 return 하여 db에 저장하지 않음
            if (!$attach)
                return;

            for ($i = 1; $i <= 5; $i++) {
                if (isset($attach['attachment' . $i])) {
                    $params['attachment' . $i] = $attach['attachment' . $i];
                }
            }
        }

        if (BoardReviewLatest::create($params)) {
            return redirect()->route("admin.archive.reviewlatest.index")->with("success", msg_collection('success_enrollment'));
        }

        return back()->with("error", msg_collection('error_enrollment'));

    }

    public function edit($id)
    {
        if ($update = BoardReviewLatest::find($id)) {
            return view('admin.archive.reviewlatest.create', [
                'list' => $update
            ]);
        }
    }

    public function update(Request $request, BoardReviewLatest $reviewLatest)
    {
        if (!$request->id) {
            return back()->with("error", msg_collection('failure_correction'));
        }

        $update = $reviewLatest::find($request->id);
        $update->subject = $request->subject;
        $update->contents = addslashes($request->contents);

        if ($request->file()) {
            $attachment = new BoardReviewLatest;
            $attach = $attachment->set($request);

            if (!$attach)
                return;

            for ($i = 1; $i <= 5; $i++) {
                if (isset($attach['attachment' . $i])) {
                    $update['attachment' . $i] = $attach['attachment' . $i];
                }
            }
        }

        if ($update->save()) {
            return redirect()->route("admin.archive.reviewlatest.index")->with("success", msg_collection('success_correction'));
        }

        return back()->with("error", msg_collection('failure_correction'));
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
            $board = new BoardReviewLatest;
            $delete = BoardReviewLatest::find($request->id);

            if ($delete->delete()) {

                /*     for ($i = 1; $i < 5; $i++) {
                         $board->file_delete($request->method(), $delete['attachment' . $i]);
                     }*/

                return redirect()->route("admin.archive.reviewlatest.index")->with("success", "정상적으로 삭제되었습니다.");
            }
        }

        return back()->with("error", "삭제하는데 실패했습니다. 다시 시도해 주세요.");
    }

    // 선택 삭제
    public function destroyAll(Request $request)
    {
        $chk = false;
        foreach ($request->chk as $id) {
            $delete = BoardReviewLatest::find($id);

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

    // 선택 이동
    public function moveAll(Request $request)
    {
        $chk = false;
        foreach ($request->chk as $id) {
            $move = BoardReviewLatest::find($id);

            $params = $move->only([
                'subject',
                'contents',
                'account',
                'user_type',
                'hit',
                'attachment1',
                'attachment2',
                'attachment3',
                'attachment4',
                'attachment5',
            ]);

            if ($update = BoardReviewBefore::create($params)) {

                $update->created_at = $move->created_at;
                $update->updated_at = $move->updated_at;

                $update->save();

                if ($move->delete())
                    $chk = true;
                else {
                    $chk = false;
                    break;
                }
            }else {
                return back()->with("error", msg_collection('error_enrollment'));
            }
        }

        if ($chk)
            return back()->with("success", "정상적으로 이동되었습니다.");

        return back()->with("error", "이동하는데 실패하였습니다. 다시 시도해 주세요.");
    }
}
