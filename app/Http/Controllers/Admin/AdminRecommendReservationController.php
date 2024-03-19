<?php

namespace App\Http\Controllers\Admin;

use App\Boards\Recommend;
use App\Http\Controllers\Controller;
use App\Models\RecommendReservation;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminRecommendReservationController extends Controller
{
    protected RecommendReservation $board;


    public function __construct(Request $request)
    {
        $this->board = new RecommendReservation();
    }

    public function index(Request $request)
    {
        // 게시글 가져오기
        $lists = $this->board->get($request);



        //--- 글작성자정보가져오기
        $users = [];


        foreach ($lists as $list) {
            $student = Student::getStudent($list->account);
            $post = DB::table('board_recommends')->find($list->recommend_id);

            $list->name = $student->name;
            $list->phone_number = $student->phone_number;
            $list->university = $student->university;
            $list->grade = $student->grade;
            $list->department = $student->department;
            $list->academic = $student->academic;
            $list->company_name = $post->company_name;
            $list->recruitment_field = $post->recruitment_field;
        }



        $search = [
            'search' => $request->search,
            'term' => $request->term,
            'from' => $request->from ?? '',
            'to' => $request->to ?? ''
        ];

        return View('admin.jobinfo.support.list', [
            'lists' => $lists,
            'users' => $users,
            'search' => $search
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        //--- post id 값이 없으면 빠꾸
        if (!$id)
            return back()->with("error", msg_collection('access_impossible'));


        //--- 예약 정보 가져오기 (예약 없으면  빠꾸)
        if (!$reservation = DB::table('recommend_reservations')->find($id))
            return back()->with("error", '존재하지 않는 지원내역 입니다.');


        //--- 게시물 정보 가져오기 (게시물이 없으면  빠꾸)
        if (!$list = DB::table('board_recommends')->find($reservation->recommend_id))
            return back()->with("error", msg_collection('none_post'));


        $user = Student::getStudent($reservation->account);




        return View('admin.jobinfo.support.create', [
            'user' => $user,
            'list' => $list,
            'reservation' => $reservation,
        ]);
    }


    public function store(Reqeust $request)
    {
        $write = $this->board->write($request);

        if ($write) {
            return redirect("/jobinfo/recommend")->with("msg", msg_collection('success_enrollment'));
        } else {
            return back()->with("error", msg_collection('error_enrollment'));
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        if (!$id)
            return back()->with("error", msg_collection('error_enrollment'));


        if ($delete = DB::table('recommend_reservations')->where('id', $id)) {

            if ($delete->delete()) {
                return redirect()->route("admin.jobinfo.recommend")->with("success", msg_collection('success_remove'));
            }
        }
        return back()->with("error", msg_collection('failure_remove'));
    }


    //--- 단체 삭제
    public function destroyAll(Request $request)
    {
        $check = true;

        //--- 순회하며 삭제 시킨다.
        foreach ($request->chk as $id) {

            //--- 이미 예약한 사람이 있는 스터디룸이라면 삭제 방지처리
            if (!$delete = DB::table('recommend_reservations')->where('id', $id)) {
                return back()->with("error", msg_collection('failure_remove'));
            }

            //--- 삭제
            if (!$delete->delete()) {
                $check = false;
                break;
            }
        }

        //--- 성공시
        if ($check) {
            return redirect()->route("admin.jobinfo.recommend")->with("success", msg_collection('success_remove'));
        }

        //--- 실패시
        return back()->with("error", msg_collection('failure_remove'));

    }
}
