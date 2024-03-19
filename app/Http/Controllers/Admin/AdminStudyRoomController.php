<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\StudyRoom;

class AdminStudyRoomController extends Controller
{

    public function index(Request $request)
    {
        $lists = StudyRoom::get($request);


        return view("admin.study.room.list", [
            'seunghaks' => $lists['seunghak'],
            'bumins' => $lists['bumin'],
        ]);
    }


    public function create()
    {
        return view("admin.study.room.create");
    }


    public function store(Request $request)
    {
        if (StudyRoom::add($request)) {
            return redirect()->route('admin.study.room.index')->with("success", $request->name . "(이)가 정상적으로 등록 되었습니다.");
        }

        return back()->with("status", "등록에 실패 하였습니다. 다시 시도해 주세요.");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    public function edit($id)
    {

        $update = StudyRoom::find($id);

        if ($update) {
            return view("admin.study.room.create", [
                'list' => $update
            ]);
        }
    }


    public function update(Request $request)
    {
        if (!$request->id)
            return back()->with("status", "수정하는데 실패 하였습니다. 다시 시도해 주세요.");

        $update = StudyRoom::find($request->id);

        $update->name = $request->name;
        $update->campus_id = $request->campus_id;
        $update->info_desc = $request->info_desc;
        $update->location = $request->location;
        $update->operating_time = $request->operating_time;
        $update->time = $request->time;
        $update->use = $request->use;
        $update->max_personnel = $request->max_personnel;
        $update->min_personnel = $request->min_personnel;
        $update->office_equipment = $request->office_equipment;
        $update->room_ip = $request->room_ip;
        $update->room_password = $request->room_password;
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
            $delete = StudyRoom::find($id);

            //--- 이미 예약한 사람이 있는 스터디룸이라면 삭제 방지처리
            if (DB::table("room_reservations")->where('room_id', $id)->exists()) {
                return back()->with("error", msg_collection('failure_already_room'));
            }

            //--- 데이터삭제
            if ($delete->delete()) {
                $check = true;
            }
        }

        //--- 성공시
        if ($check) {
            return redirect()->route("admin.study.room.index")->with("success", msg_collection('success_remove'));
        }

        //--- 실패시
        return back()->with("error", msg_collection('failure_remove'));

    }


    //--- 단체 삭제
    public function destroyAll(Request $request)
    {
        $check = false;

        //--- 순회하며 삭제 시킨다.
        foreach ($request->chk as $id) {

            //--- 이미 예약한 사람이 있는 스터디룸이라면 삭제 방지처리
            if (DB::table("room_reservations")->where('room_id', $id)->exists()) {
                return back()->with("error", msg_collection('failure_already_room'));
            }

            //--- 데이터 있는지 체크
            $delete = StudyRoom::find($id);

            //--- 삭제
            if ($delete->delete()) {
                $check = true;
            }
        }

        //--- 성공시
        if ($check) {
            return redirect()->route("admin.study.room.index")->with("success", msg_collection('success_remove'));
        }

        //--- 실패시
        return back()->with("error", msg_collection('failure_remove'));

    }


}
