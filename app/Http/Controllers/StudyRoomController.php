<?php

namespace App\Http\Controllers;

use App\Models\RoomReservation;
use App\Models\StudyRoom;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class StudyRoomController extends Controller
{
    public function index(Request $request)
    {
        $lists = StudyRoom::get($request);

        return view("studyroom.index", [
            'seunghaks' => $lists['seunghak'],
            'bumins' => $lists['bumin'],
        ]);
    }

    public function list(Request $request)
    {
        return View('studyroom.list');
    }


    //--- 예약 작성 페이지
    public function view(Request $request)
    {
        //--- 스터디룸 id가 넘어오지 않았을때 return
        if (!$request->room_id)
            return back()->with("error", msg_collection('access_impossible'));

        //--- 로그인 하지 않았을 때 return
        if (!session()->get('login_check'))
            return back()->with("error", msg_collection('failure_login'));

        //--- 관리자는 예약불가
        if (session()->get('donga_type') == 'admin') {
            //return back()->with("error", msg_collection('failure_manager'));
        }


        //--- 스터디룸이 예약이 있는지 체크
        $times = $request->time;
        $room_id = $request->room_id;
        $date = $request->date;
        foreach ($times as $time) {
            $post = DB::table('room_reservations')
                ->leftJoin('room_reservation_dates', 'room_reservation_dates.reservation_id', '=', 'room_reservations.id')
                ->where('room_reservations.date', $date)
                ->where('room_reservations.room_id', $room_id)
                ->where('room_reservation_dates.time', $time)
                ->exists();

            if ($post) {
                return redirect()->route('studyroom.index')->with('error', msg_collection('studyroom_already'));
            }
        }

        //--- 2회예약, 노쇼 체크
        if (RoomReservation::is_no_show_check($request->account)) {
            return redirect()->route('studyroom.index')->with('error', ' 의 무단 미사용으로 인해 한달간 예약을 하실수가 없습니다.');
        } else if (RoomReservation::is_week_reservation($request->account)) {
            return redirect()->route('studyroom.index')->with('error', ' 2회예약으로 인해 일주일간 예약을 하실수가 없습니다.');
        }


        //--- 정보 가져오기
        $list = StudyRoom::find($request->room_id); // 스터디룸 정보를 뿌려줘야 하므로 스터디룸 id를 통해 스터디룸 정보 가져오기


        //--- 룸 정보와 학생정보 합치기 TODO: 추후 학생정보로 변경해야함
        $list->account = session()->get('account');
        $list->student_name = session()->get('name');
        $list->date = $request->date;
        $list->times = $times; // 시간대는 배열로 들어옴
        $list->room_id = $request->room_id;

        return View('studyroom.create', [
            'list' => $list
        ]);
    }

    public function store()
    {

    }

    public function room(Request $request)
    {
        if (!$request->campus)
            return response()->json(['status' => 404]);


        if (!$request->date)
            $request->date = date('Y-m-d');

        $lists = null;
        $week = date('w', strtotime($request->date));

        //--- 주말 체크
        if ($week == 0 || $week == 6) {
            $lists = '<div>주말은 이용이 불가능 합니다.</div>';
        } else {


            // 예약 금지 체크


            //$is = DB::table('room_preventions')->where('day', $request->date)->exists();


            $is = DB::table('room_preventions')
                ->where('day', '<=', $request->date)
                ->where('end_day', '>=', $request->date)
                ->exists();

            if ($is) {
                $lists = '<div>예약이 불가능 합니다.</div>';
            } else {
                $lists = StudyRoom::get_room_list($request->campus);
                $lists = get_room_html($lists);
            }

        }


        return response()->json([
            'status' => $lists ? 200 : 404,
            'lists' => $lists
        ]);

    }

    public function time(Request $request)
    {
        if (!$request->campus && $request->id && !$reqeust->date)
            return response()->json(['status' => 404]);

        if (!$times = StudyRoom::get_time_list($request->campus, $request->id))
            return response()->json(['status' => 404]);


        //--- 예약이 있는지 체크
        $reservations = DB::table('room_reservations')
            ->where('room_id', $request->id)
            ->where('date', $request->date)
            ->get();

        //--- 예약이 있으면 시간을 가져온다.
        $reservation_times = [];
        if ($reservations) {

            foreach ($reservations as $reservation) {

                $reservation_dates = DB::table('room_reservation_dates')
                    ->where('reservation_id', $reservation->id)
                    ->get();

                //--- 예약시간을 $reservation_times 배열에 저장
                foreach ($reservation_dates as $reservation_date) {
                    if (!in_array($reservation_date->time, $reservation_times, true)) {
                        $reservation_times[] = $reservation_date->time;
                    }
                }
            }
        }


        //--- 파라미터 mode 로 time이 들어오면 시간만 반환한다.
        if ($request->mode == 'time') {
            $lists = $times;
        } else if ($request->mode == 'time_reservation') {

            foreach ($times as $time) {

                $check = DB::table('room_reservations')
                    ->leftJoin('room_reservation_dates', 'room_reservations.id', '=', 'room_reservation_dates.reservation_id')
                    ->where('room_reservations.room_id', $request->id)
                    ->where('room_reservations.date', $request->date)
                    ->where('room_reservation_dates.time', $time)
                    ->exists();


                if ($check)
                    $time .= '/reservation';

                $lists[] = $time;
            }


        } else {
            $lists = get_room_time_html($times, $reservation_times);
        }

        return response()->json([
            'status' => $lists ? 200 : 404,
            'lists' => $lists
        ]);

    }


    //--- 스터디룸 예약 체크
    public function check(Request $request)
    {
        //--- room_id 가 넘어오지 않았으면 return
        if (!$request->room_id)
            return response()->json(['status' => 404]);


        $lists = true;


        return response()->json([
            'status' => $lists ? 200 : 404,
            'lists' => $lists
        ]);

    }


    //--- 예약
    public function create(Request $request)
    {

        $validation_list = [
            'room_id',
            'campus_id',
            'use_people',
            'target_type',
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


        $times = $request->time;
        $room_id = $request->room_id;
        $date = $request->date;
        $companion_ids = $request->companion_id;
        $companion_ids[] = $request->account;


        //--- 오늘 예약이 있는지 체크
        foreach ($companion_ids as $account) {
            $result = StudyRoom::is_today_reservation($account);

            // 오늘예약이 있으므로 리턴
            if ($result) {
                return redirect()->route('studyroom.index')->with('error', '오늘 이미 예약을 하셨습니다.');
            }
        }


        //--- 스터디룸이 예약이 있는지 체크
        foreach ($times as $time) {
            $post = DB::table('room_reservations')
                ->leftJoin('room_reservation_dates', 'room_reservation_dates.reservation_id', '=', 'room_reservations.id')
                ->where('room_reservations.date', $date)
                ->where('room_reservations.room_id', $room_id)
                ->where('room_reservation_dates.time', $time)
                ->exists();

            if ($post) {
                return redirect()->route('studyroom.index')->with('error', msg_collection('studyroom_already'));
            }
        }


        //--- 2회예약, 노쇼 체크
        if ($companion_ids) {
            foreach ($companion_ids as $companion_id) {

                if (RoomReservation::is_no_show_check($companion_id)) {
                    return redirect()->route('studyroom.index')->with('error', $companion_id . ' 의 무단 미사용으로 인해 한달간 예약을 하실수가 없습니다.');
                } else if (RoomReservation::is_week_reservation($companion_id)) {
                    return redirect()->route('studyroom.index')->with('error', $companion_id . ' 2회예약으로 인해 일주일간 예약을 하실수가 없습니다.');
                }
            }
        }


        $params = $request->only($validation_list);
        $params['target_type'] = $request->target_type;
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
            'account' => $request->account
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

        //--- 관리자 일시
        if ($params['target_type'] == 2) {
            return redirect()->route('studyroom.index')->with('success', '정상적으로 예약되었습니다.\n관리자는 관리자 페이지에서 예약 확인이 가능합니다.');
        }


        return redirect()->route('mypage.studyroom.list')->with('success', msg_collection('success_enrollment'));
    }

    //--- ajax 스터디룸 가져오기
    function room_list(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->campus_id)
            return response()->json(['status' => 404]);

        $room_lists = StudyRoom::get_room_list($request->campus_id);

        return response()->json([
            'status' => $room_lists ? 200 : 404,
            'lists' => $room_lists
        ]);
    }


    //--- 스터디룸 id 값을 통해 스터디룸 정보 가져오기
    function get(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->id)
            return response()->json(['status' => 404]);

        if ($study_room = StudyRoom::find($request->id)) {
            $study_room->campus_name = get_campus_name($study_room->campus_id); // 캠퍼스 이름 가져오기
        }

        return response()->json([
            'status' => $study_room ? 200 : 404,
            'data' => $study_room
        ]);
    }


    //--- noshow 및 1주일 이내 예약체크
    function possible(Request $request)
    {
        $account = '';
        $result = false;
        $msg = '';
        if ($request->account) {
            $account = $request->account;
        } else {
            $account = session()->get('account');
        }

        if (!$account) {
            $result = false;
            $msg = '계정이 존재하지 않습니다.';
        }


        //--- no-show 체크
        if ($result = RoomReservation::is_no_show_check($account)) {
            $msg = '무단 미사용으로 인해 한달간 예약을 하실수가 없습니다.';
        } else {

            if ($result = RoomReservation::is_week_reservation($account)) {
                $msg = '2회예약으로 인해 일주일간 예약을 하실수가 없습니다.';
            }

        }


        return response()->json([
            'result' => $result,
            'msg' => $msg
        ]);
    }

    function no_show(Request $request)
    {
        $account = '';
        if ($request->account) {
            $account = $request->account;
        } else {
            $account = User::find(session()->get('login_check'))->account;
        }


        if (RoomReservation::is_no_show_check($account)) {

        }
    }

    public function student(Request $request)
    {

        if (!$request->id)
            return response()->json(['status' => 404]);

        // 예약 학생정보를 가져온다.
        $reservation_students = DB::table("room_reservation_students")
            ->where('reservation_id', $request->id)->get();


        $lists = get_mypage_modal_html($reservation_students);


        return response()->json([
            'status' => $lists ? 200 : 404,
            'data' => $lists
        ]);

    }


    public function destroy(Request $request)
    {
        $id = $request->id;
        $check = false;

        //--- 데이터 있는지 체크
        if ($id) {

            //--- 삭제 대상체 있는지 체크
            if (!$delete = DB::table('room_reservations')->where('id', $id)) {
                return back()->with("error", msg_collection('failure_remove'));
            }

            //--- 데이터삭제
            if ($delete->delete()) {
                $check = true;
            }
        }

        //--- 성공시
        if ($check) {
            return back()->with("success", msg_collection('success_remove'));
        }

        //--- 실패시
        return back()->with("error", msg_collection('failure_remove'));

    }

}
