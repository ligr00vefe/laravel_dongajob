<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoomPrevention;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\StudyRoom;

class AdminStudyRoomPreventionController extends Controller
{
    public function __construct()
    {
        $this->path = 'admin.study.prevention';
        $this->table = new RoomPrevention();
    }


    public function index(Request $request)
    {
        $lists = $this->table->paginate(15);
        return view($this->path . ".list", compact('lists'));
    }


    public function create()
    {
        return view($this->path . ".create");
    }

    public function edit($id)
    {

        $list = $this->table->find($id);

        if ($list) {
            return view($this->path . ".create", compact('list'));
        }

        return back()->with("status", "존재하지 않는 게시물입니다.");
    }


    public function store(Request $request)
    {
        $name = $request->input('name') ?? '-';
        $day = $request->input('day');
        $end_day = $request->input('end_day');


        $store = $this->table->insertGetId([
            'name' => $name,
            'phrases' => '예약이 불가능 합니다.',
            'day' => $day,
            'end_day' => $end_day,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);


        if ($store) {
            return redirect()->route('admin.study.prevention.index')->with("success", "정상적으로 등록 되었습니다.");
        }

        return back()->with("status", "등록에 실패 하였습니다. 다시 시도해 주세요.");
    }

    public function update(Request $request)
    {
        if (!$request->id) {
            return back()->with("status", "수정하는데 실패 하였습니다. 다시 시도해 주세요.");
        }

        $update = $this->table->find($request->id);
        $update->name = $request->name;
        $update->day = $request->day;
        $update->end_day = $request->end_day;
        $update->updated_at = Now();

        if ($update->save()) {
            return back()->with("success", "정상적으로 수정되었습니다.");
        }

        return back()->with("error", "수정하는데 실패 하였습니다. 다시 시도해 주세요.");
    }


    //--- 개벽 삭제
    public function destroy(Request $request)
    {
        $check = false;
        $id = $request->id;

        //--- 데이터 있는지 체크
        if ($id) {

            //--- 삭제 대상체 있는지 체크
            $delete = $this->table->get($id);


            //--- 데이터삭제
            if ($delete->delete()) {
                $check = true;
            }
        }

        //--- 성공시
        if ($check) {
            return redirect()->route("admin.study.prevetion.index")->with("success", msg_collection('success_remove'));
        }

        //--- 실패시
        return back()->with("error", msg_collection('failure_remove'));

    }


    //--- 단체 삭제
    public function destroyAll(Request $request)
    {
        $check = false;
        $lists = $request->input('chk');


        //--- 순회하며 삭제 시킨다.
        foreach ($lists as $id) {

            //--- 데이터 있는지 체크
            $delete = $this->table->find($id);

            //--- 삭제
            if ($delete->delete()) {
                $check = true;
            }
        }

        //--- 성공시
        if ($check) {
            return redirect()->route("admin.study.prevention.index")->with("success", msg_collection('success_remove'));
        }

        //--- 실패시
        return back()->with("error", msg_collection('failure_remove'));

    }

}
