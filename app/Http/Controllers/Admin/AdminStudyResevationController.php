<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudyRoom;
use App\Models\RoomReservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminStudyResevationController extends Controller
{
    public function index(Request $request)
    {

        $campus = $request->campus == 'all' ? '' : $request->campus;
        $room = $request->room ?: '';
        $type = $request->type == 'all' ? '' : $request->type;
        $date = $request->date ?: '';
        $schedule_date = $request->schedule_date ?: '2020-01-01';
        $schedule_end_date = $request->schedule_end_date ?: '';
        $keyword = $request->keyword ?: '';
        $term = $request->term ?: '';


        $lists = DB::table("room_reservations")
            ->select('room_reservations.id', 'room_reservations.room_id', 'room_reservations.date', 'room_reservations.target_type', 'room_reservations.status', 'room_reservations.campus_id', 'room_reservations.created_at', 'room_reservations.use_people', 'room_reservation_students.account')
            ->distinct('room_reservation_students.reservation_id')
            ->leftJoin('study_rooms', 'room_reservations.room_id', '=', 'study_rooms.id')
            ->leftJoin('room_reservation_students', 'room_reservations.id', '=', 'room_reservation_students.reservation_id')
            ->when($campus, function ($query, $campus) {
                return $query->where('room_reservations.campus_id', $campus);
            })
            ->when($type, function ($query, $type) {
                return $query->where('room_reservations.target_type', $type);
            })
            ->when($room, function ($query, $room) {
                return $query->where('study_rooms.name', 'like', '%' . $room . '%');
            })
            ->when($schedule_end_date, function ($query, $schedule_end_date) use ($date, $schedule_date) {
                if ($date == 'application')
                    //return $query->where('room_reservations.created_at', 'like', '%' . $schedule_date . '%');
                    return $query->whereDate('room_reservations.created_at', '>=', $schedule_date)->whereDate('room_reservations.created_at', '<=', $schedule_end_date);
                else if ($date == 'reservation')
                    //return $query->where('room_reservations.date', 'like', '%' . $schedule_date . '%');
                    return $query->whereDate('room_reservations.date', '>=', $schedule_date)->whereDate('room_reservations.date', '<=', $schedule_end_date);
            })
            ->when($term, function ($query, $term) use ($keyword) {
                if ($keyword == 'name') {
                    return $query
                        ->leftJoin('users', 'room_reservation_students.account', '=', 'users.account')
                        ->where('users.name', 'like', '%' . $term . '%');

                } else if ($keyword == 'account') {
                    return $query->where('room_reservation_students.account', 'like', '%' . $term . '%');
                }
            })
            ->where('room_reservation_students.type', 1)
            ->orderByDesc("room_reservations.id")
            ->paginate(10);

        foreach ($lists as $list) {

            // 스터디룸 정보 가져오기
            $room_info = StudyRoom::find($list->room_id);


            // 가지고온 학번통해 학생정보 가져오기
            $student_info = $list->target_type == 1 ? Student::getStudent($list->account) : DB::table('users')->where('account', $list->account)->first();


            //*============================= 시간대 가져오기 =======================================*//

            // 예약한 시간대 가져온다.
            /*  $reservation_times = DB::table("room_reservations")
                  ->select('room_reservation_dates.time')
                  ->leftJoin('room_reservation_dates', 'room_reservations.id', '=', 'room_reservation_dates.reservation_id')
                  ->orderBy('room_reservation_dates.id')
                  ->get();*/


            $reservation_times = DB::table("room_reservation_dates")
                ->where('reservation_id', $list->id)
                ->orderBy('id')
                ->get();

            // 예약한 시간대를 배열에 담는다.
            $times = [];
            foreach ($reservation_times as $val) {
                array_push($times, $val->time);
            }


            // 배열에 담은 시간대의 범위를 return 받는다.
            $range_times = get_time_range($times);

            //--- 예약 내역과 학생정보 합치기
            $list->room_name = $room_info->name ?? '-';
            $list->reservatio_date = $list->date . ' ' . $range_times;
            $list->times = $list->times ?? '-';
            $list->account = $list->account ?? '-';
            $list->student_name = $student_info->name ?? '-';
            $list->department = $student_info->department ?? '-';
            $list->target_type = get_room_target_type($list->target_type);
            $list->status = get_room_status($list->status, true);


        }

        $search = [
            'campus' => $campus,
            'room' => $room,
            'type' => $type,
            'date' => $date,
            'schedule_date' => $request->schedule_date ?: '',
            'schedule_end_date' => $schedule_end_date,
            'keyword' => $keyword,
            'term' => $term
        ];


        return view('admin.study.reservation.list', [
            'lists' => $lists,
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
        //--- 승학 캠퍼스 스터디룸 목록
        $room_list = StudyRoom::get_room_list(1);

        return view('admin.study.reservation.create', [
            'room_list' => $room_list
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation_list = [
            'room_id',
            'campus_id',
            'use_people',
            'use_purpose',
            'office_equipment',
            'location',
            'date'
        ];


        //--- 필수값이 빠졌는지 체크, 빠졌으면 back 시킨다.
        foreach ($validation_list as $key => $value) {

            $property = $value;

            if (!$request->$property)
                return back()->with("error", msg_collection('access_impossible'));

        }

        $params = $request->only($validation_list);
        $params['target_type'] = 2; // 관리자는 2번
        $params['ip'] = $_SERVER['REMOTE_ADDR'];
        $params['created_at'] = date('Y-m-d H:i:s');
        $params['updated_at'] = date('Y-m-d H:i:s');


        //--- 예약할 스터디룸 정보 저장
        $reservation_id = DB::table('room_reservations')->insertGetId($params); // insert 후 auto-incremente 추출

        //*========================== 예약자 정보 저장 ==========================*//

        //--- 예약자 정보 저장
        DB::table('room_reservation_students')->insert([
            'type' => 1,
            'reservation_id' => $reservation_id,
            'account' => session()->get('account')
        ]);

        //--- 동반자 정보 저장
        if ($request->companion_id) {
            foreach ($request->companion_id as $val) {
                DB::table('room_reservation_students')->insert([
                    'type' => 2,
                    'reservation_id' => $reservation_id,
                    'account' => $val
                ]);
            }
        }

        //*========================== 예약자 시간 저장 ==========================*//
        foreach ($request->time as $val) {
            DB::table('room_reservation_dates')->insert([
                'reservation_id' => $reservation_id,
                'time' => $val
            ]);
        }

        return redirect()->route('admin.study.reservation.index')->with('success', msg_collection('success_enrollment'));
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
        // 예약정보 가져오기
        $update = RoomReservation::find($id);

        // 예약정보의 스터디룸 id값을 가지고 스터디룸 정보가져오기
        $room_info = StudyRoom::find($update->room_id);


        //--- 예약한 학생의 정보 가져오기 TODO:: 추후 실제 학생정보로 변경해야함
        $booker = ''; // 예약자 정보 들어갈 배열
        $companions = []; // 동반자 정보 들어갈 배열

        if ($resrvation_students = RoomReservation::get_student_subscriber($update->id)) {
            $index = 0;
            foreach ($resrvation_students as $info) {

                //--- 예약자가 관리자 일경우 관리자 정보 저장
                $student = Student::getStudent($info->account);


                //--- 예약자, 동반자에 따라 다른 변수에 저장
                if ($info->type == 1) {   // 예약자

                    if ($update->target_type == 2) {
                        $booker = User::getUser($info->account);
                    } else {
                        $booker = $student;
                    }


                } else { // 동반자
                    $companions[$index]['info'] = $student;
                    $index++;
                }

            }
        }


        //--- 예약한 시간 정보 가져오기
        $reservation_times = RoomReservation::get_date_subscriber($update->id);

        $times = [];
        foreach ($reservation_times as $info) {
            $times[] = $info->time;
        }



        //--- 예약한 스터디룸의 캠퍼스의 스터디룸 모든 목록 가져오기
        $room_list = StudyRoom::get_room_list($update->campus_id);

        if ($update) {
            return view("admin.study.reservation.create", [
                'list' => $update, // 예약정보
                'booker' => $booker, // 예약한 학생 정보
                'companions' => $companions, // 동반자 정보
                'times' => $times, // 예약한 시간
                'room_info' => $room_info, // 예약한 스터디룸 정보
                'room_list' => $room_list,  // 예약한 캠퍼스의 모든 스터디룸 리스트들
            ]);
        }

        return back()->with('error', msg_collection('none_post'));
    }


    public function update(Request $request)
    {

        $validation_list = [
            'room_id',
            'campus_id',
            'use_people',
            'use_purpose',
            'office_equipment',
            'location',
            'date'
        ];

        //--- 필수값이 빠졌는지 체크, 빠졌으면 back 시킨다.
        foreach ($validation_list as $key => $value) {

            $property = $value;

            if (!$request->$property)
                return back()->with("error", msg_collection('access_impossible'));

        }


        //--- 변경하려는 스터디룸 예약상태 체크
        $check = false;
        $times = $request->time;
        $date = $request->date;
        $original_companion_ids = $request->original_companion_id;
        $original_companion_ids[] = $request->account;
        $room_id = $request->room_id;
        foreach ($times as $time) {

            $reservations = DB::table('room_reservations')
                ->leftJoin('room_reservation_dates', 'room_reservations.id', '=', 'room_reservation_dates.reservation_id')
                ->leftJoin('room_reservation_students', 'room_reservations.id', '=', 'room_reservation_students.reservation_id')
                ->where('room_reservations.room_id', $room_id)
                ->where('room_reservations.date', $date)
                ->where('room_reservation_dates.time', $time)
                ->get();



            //--- 기존에 예약한사람은 체크 제외
            foreach ($reservations as $reservation) {
                if (in_array($reservation->account, $original_companion_ids)) {
                    continue;
                }

                $check = true;
                break;
            }

            //--- 이미 예약이 있으므로 빠꾸
            if ($check) {
                return back()->with("error", $time . '이미 예약이 되어있어 등록이 불가능 합니다.');
            }

        }

        //--- 동반사용자 no-show, 일주일 예약상태 체크
        $companion_ids = $request->companion_id;
        if ($companion_ids) {
            foreach ($companion_ids as $companion_id) {

                if (RoomReservation::is_no_show_check($companion_id, $room_id)) {
                    return back()->with("error", $companion_id . ' 학생은 ' . msg_collection('no_show_dont_reservation'));

                } else if (RoomReservation::is_week_reservation($companion_id, $room_id)) {
                    return back()->with("error", $companion_id . ' 학생은 ' . msg_collection('already_room_reservation'));
                }
            }
        }


        //--- 예약내역 변경
        $reservation_id = $request->id;
        $update = RoomReservation::find($reservation_id);
        $update->room_id = $request->room_id;
        $update->campus_id = $request->campus_id;
        $update->use_people = $request->use_people;
        $update->office_equipment = $request->office_equipment;
        $update->location = $request->location;
        $update->status = $request->status;
        $update->date = $request->date;
        $update->use_purpose = $request->use_purpose;
        $update->updated_at = Now();


        if (!$update->save()) {
            return back()->with("error", "수정하는데 실패 하였습니다. 다시 시도해 주세요.");
        }


        //--- 기존 동반사용자만 삭제
        DB::table('room_reservation_students')
            ->where('reservation_id', $update->id)
            ->where('type', 2)
            ->delete();

        //--- 동반사용자 추가
        if ($companion_ids) {
            foreach ($companion_ids as $companion_id) {
                DB::table('room_reservation_students')->insert([
                    'type' => 2,
                    'reservation_id' => $reservation_id,
                    'account' => $companion_id
                ]);
            }
        }


        //--- 기존 시간 삭제
        DB::table('room_reservation_dates')
            ->where('reservation_id', $update->id)->delete();


        //--- 기존 시간 추가
        foreach ($times as $time) {
            DB::table('room_reservation_dates')->insert([
                'reservation_id' => $reservation_id,
                'time' => $time
            ]);

        }


        if ($update->save()) {
            return back()->with("success", "예약내역이 변경되었습니다.");
        }

        return back()->with("error", "변경하는데 실패 하였습니다. 다시 시도해 주세요.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$id)
            return back()->with("error", msg_collection('failure_remove'));


        $problem = false;

        $delete = DB::table('room_reservation_students')
            ->where('reservation_id', $id);

        //--- 삭제
        if (!$delete->delete()) {
            $problem = true;
        }

        $delete = DB::table('room_reservation_dates')
            ->where('reservation_id', $id);

        //--- 삭제
        if (!$delete->delete()) {
            $problem = true;
        }

        //---예약내역 삭제
        $delete = RoomReservation::find($id);
        //--- 삭제
        if (!$delete->delete()) {
            $problem = true;
        }

        return redirect()->route("admin.study.reservation.index")->with("success", msg_collection('success_remove'));


    }


    //--- 단체 삭제
    public function destroyAll(Request $request)
    {
        $problem = false;

        //--- 순회하며 삭제 시킨다.
        foreach ($request->chk as $id) {


            $delete = DB::table('room_reservation_students')
                ->where('reservation_id', $id);

            //--- 삭제
            if (!$delete->delete()) {
                $problem = true;
            }

            $delete = DB::table('room_reservation_dates')
                ->where('reservation_id', $id);

            //--- 삭제
            if (!$delete->delete()) {
                $problem = true;
            }

            //---예약내역 삭제
            $delete = RoomReservation::find($id);
            //--- 삭제
            if (!$delete->delete()) {
                $problem = true;
            }
        }


        return redirect()->route("admin.study.reservation.index")->with("success", msg_collection('success_remove'));


    }
}
