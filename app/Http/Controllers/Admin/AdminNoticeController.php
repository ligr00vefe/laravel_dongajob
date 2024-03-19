<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BoardCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BoardNotice;

class AdminNoticeController extends Controller
{
    protected BoardCategory $boardCategory;
    protected $menu_id;

    public function __construct()
    {
        $this->boardCategory = new BoardCategory();
        $this->menu_id = array_search('공지사항', get_admin_menu_list(), true);
    }
    public function index(Request $request)
    {
        $category_list = get_notice_category();
        $status_list = get_notice_status();
        $category = $request->category ?? key($category_list);

        $lists = BoardNotice::paging($request, $category);

        // 작성자 가져오기
        foreach ($lists as $key => $val) {
            $val->name = User::find($val->user_id)->name;
        }

        $search = [
            'search' => $request->search,
            'term' => $request->term,
            'from' => $request->from ?? '',
            'to' => $request->to ?? ''
        ];

        return view('admin.notice.list', [
            'lists' => $lists,
            'search' => $search,
        ]);
    }

    public function create()
    {
        return view("admin.notice.create");
    }

    public function store(Request $request)
    {
        $params = $request->only(['subject', 'status_id', 'category_id', 'schedule_date']);
        $params['contents'] = addslashes($request->contents);
        $params['user_id'] = session()->get('user_id');
        $categories = $request->category_id;

        // 첨부파일 등록했는지 체크
        if ($request->file()) {

            // 첨부파일 등록
            $attachment = new BoardNotice;
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


        if ($notice = BoardNotice::create($params)) {
            $category = $request->category_id;

            $this->boardCategory->setData($this->menu_id, $notice->id, $category);

            return redirect()->route("admin.notice.index")->with("success", msg_collection('success_enrollment'));
        }

        return back()->with("error", msg_collection('error_enrollment'));
    }

    public function edit($id)
    {
        if ($update = BoardNotice::find($id)) {
            return view('admin.notice.create', [
                'list' => $update
            ]);
        }
    }

    public function update(Request $request, BoardNotice $notice)
    {
        $id = $request->id;
        if (!$id) {
            return back()->with("error", msg_collection('failure_correction'));
        }

        $update = $notice::find($id);
        $update->subject = $request->subject;
        $update->category_id = $request->category_id;
        $update->schedule_date = $request->schedule_date;
        $update->contents = addslashes($request->contents);
        $update->status_id = $request->status_id;

        if ($request->file()) {
            $attachment = new BoardNotice;
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

            //--- 카테고리 저장 (모두 삭제하고 다시 insert 한다.)
            $category = $request->category_id;
            $this->boardCategory->deleteData($this->menu_id, $id);
            $this->boardCategory->setData($this->menu_id, $id, $category);

            return redirect()->route("admin.notice.index")->with("success", msg_collection('success_correction'));
        }

        return back()->with("error", msg_collection('failure_correction'));
    }


    // 개별 삭제
    public function destroy(Request $request)
    {

        if (isset($request->id)) {
            $board = new BoardNotice;
            $delete = BoardNotice::find($request->id);

            if ($delete->delete()) {

           /*     for ($i = 1; $i < 5; $i++) {
                    $board->file_delete($request->method(), $delete['attachment' . $i]);
                }*/

                return redirect()->route("admin.notice.index")->with("success", msg_collection('success_remove'));
            }
        }

        return back()->with("error", msg_collection('failure_remove'));
    }

    // 선택 삭제
    public function destroyAll(Request $request)
    {
        $chk = false;
        foreach ($request->chk as $id) {
            $delete = BoardNotice::find($id);

            if ($delete->delete())
                $chk = true;
            else {
                $chk = false;
                break;
            }
        }

        if ($chk)
            return redirect()->route("admin.notice.index")->with("success", msg_collection('success_remove'));

        return back()->with("error", msg_collection('failure_remove'));
    }
}
