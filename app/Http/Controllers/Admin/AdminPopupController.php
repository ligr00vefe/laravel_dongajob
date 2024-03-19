<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Log;
use Illuminate\Http\Request;
use App\Models\Popup;

class AdminPopupController extends Controller
{
    private string $title;
    private string $path;
    private string $alias;
    private string $route;

    public function __construct()
    {
        $this->title = '팝업';
        $this->alias = 'popup';
        $this->route = ADMIN_PATH . '.' . $this->alias;
        $this->path = $this->alias . '/info';
    }

    public function index()
    {
        $lists = Popup::paginate(10);

        return view($this->route . '.list', [
            'title' => $this->title,
            'search' => [],
            'lists' => $lists,
            'path' => $this->path
        ]);
    }

    public function create()
    {
        return view($this->route . '.create', [
            'title' => $this->title
        ]);
    }

    public function store(Request $request)
    {
        $params = $request->only(['device', 'start_time', 'end_time', 'disable_hours', 'left', 'top', 'height', 'width', 'subject']);
        $params['contents'] = addslashes($request->contents);
        $params['user_id'] = session()->get('user_id');

        //--- 내용이 없으면 빠꾸
        if (!$params['contents']) {
            return back()->with("error", msg_collection('empty_content'));
        }

        if (Popup::create($params)) {
            //--- 로그기록
            Log::record([
                "user_id" => $params['user_id'],
                "action" => '게시글등록',
                "target" => session()->get('account'),
                "path" => $request->getPathInfo(),
                "ip" => $request->getClientIp(),
                'comment' => session()->get('account') . '님이 ' . $this->title . ' 게시판에서 팝업을 등록했습니다.'
            ]);

            return redirect()->route($this->route . ".index")->with("success", msg_collection('success_enrollment'));
        }
        return back()->with("error", msg_collection('error_enrollment'));
    }

    public function edit($id)
    {
        if ($list = Popup::find($id)) {

            return view('admin.popup.create', [
                'list' => $list,
                'title' => $this->title
            ]);
        }
        return back()->with("error", msg_collection('error_enrollment'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        if (!$id) {
            return back()->with("error", msg_collection('failure_correction'));
        }

        $update = Popup::find($id);
        $update->device = $request->device;
        $update->start_time = $request->start_time;
        $update->end_time = $request->end_time;
        $update->disable_hours = $request->disable_hours;
        $update->left = $request->left;
        $update->top = $request->top;
        $update->height = $request->height;
        $update->width = $request->width;
        $update->subject = $request->subject;
        $update->contents = addslashes($request->contents);

        if ($update->save()) {
            //--- 로그기록
            Log::record([
                "user_id" => session()->get('user_id'),
                "action" => '게시글수정',
                "target" => session()->get('account'),
                "path" => $request->getPathInfo(),
                "ip" => $request->getClientIp(),
                'comment' => session()->get('account') . '님이 ' . $this->title . ' 게시판에서 팝업을 수정했습니다.'
            ]);

            return redirect()->route($this->route . ".index")->with("success", msg_collection('success_correction'));
        }

        return back()->with("error", msg_collection('failure_correction'));
    }

    public function destroy(Request $request)
    {
        if (Popup::find($request->id)->delete()) {
            return redirect()->route($this->route . ".index")->with("success", msg_collection('success_remove'));
        }
    }

    public function destroyAll(Request $request)
    {
        foreach ($request->chk as $id) {
            if (!(bool)Popup::find($id)->delete()) {
                return back()->with("error", msg_collection('failure_remove'));
            }
        }
        return redirect()->route($this->route . ".index")->with("success", msg_collection('success_remove'));
    }
}
