<?php

namespace App\Http\Controllers;

use App\Models\Alimi;
use App\Models\AlimiDelete;
use App\Models\BoardCategory;
use App\Models\BoardInterview;
use App\Models\BoardProgram;
use App\Models\RecommendReservation;
use App\Models\RoomReservation;
use App\Models\StudyRoom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Blade;
use App\Boards\Recommend;
use Illuminate\Support\Facades\Route;
use StudentAlimi;

class MyPageController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    }

    public function view()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function recommendHistory(Request $request)
    {
        if (is_null(session()->get('login_check'))) {
            return redirect()->route('login')->with('error', msg_collection('failure_login'));
        } else if (session()->get('donga_type') == 'admin') {
            return redirect('/' . ADMIN_URL);
        }


        $category = $request->category ?: 'all';
        $term = $request->term ?: '';


        // 게시글 가져오기
        $lists = DB::table('recommend_reservations')
            ->select('recommend_reservations.id', 'board_recommends.company_name', 'board_recommends.recruitment_field', 'recommend_reservations.created_at')
            ->join('board_recommends', 'board_recommends.id', '=', 'recommend_reservations.recommend_id')
            ->when($term, function ($query, $term) use ($category) {
                if ($category == 'all') {

                } else {
                    return $query->where('board_recommends.' . $category, "LIKE", "%{$term}%");
                }
            })
            ->where('recommend_reservations.account', session()->get('account'))
            ->paginate(10);

        $search = [
            'category' => $category,
            'term' => $term
        ];
        return View('mypage.recommend.list', [
            'lists' => $lists,
            'count' => count($lists),
            'search' => $search
        ]);
    }

    public function recommendUpdate()
    {
        return View('mypage.recommend.update');
    }


    public function interviewHistory(Request $request)
    {
        if (is_null(session()->get('login_check'))) {
            return redirect()->route('login')->with('error', msg_collection('failure_login'));
        } else if (session()->get('donga_type') == 'admin') {
            return redirect('/' . ADMIN_URL);
        }

        $request->user_id = session()->get('account');
        $lists = BoardInterview::paging($request);


        return View('mypage.interview.list', [
            'lists' => $lists
        ]);
    }

    public function interviewResult($id)
    {
        //--- 로그인 체크
        if (is_null(session()->get('login_check'))) {
            return redirect()->route('login')->with('error', msg_collection('failure_login'));
        } else if (session()->get('donga_type') == 'admin') {
            return redirect('/' . ADMIN_URL);
        }

        //--- 파라미터로 값이 안넘어왔을 때
        if (!$id)
            return redirect()->back()->with('error', msg_collection('access_impossible'));

        //--- 존재하지 않는게시물
        if (!$post = BoardInterview::find($id))
            return redirect()->back()->with('error', msg_collection('none_post'));


        //--- 작성자와 다른 사용자가 접근하였을 때
        if (session()->get('account') != $post->user_id)
            return redirect()->back()->with('error', msg_collection('access_impossible'));


        return View('mypage.interview.result', [
            'list' => $post
        ]);
    }


    public function interviewUpdate(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        //--- 로그인 체크
        if (is_null(session()->get('login_check'))) {
            return redirect()->route('login')->with('error', msg_collection('failure_login'));
        } else if (session()->get('donga_type') == 'admin') {
            return redirect('/' . ADMIN_URL);
        }

        //--- 파라미터로 값이 안넘어왔을 때
        if (!$id && !$status)
            return redirect()->back()->with('error', '결과를 선택해주시길 바랍니다.');

        //--- 존재하지 않는게시물
        if (!$update = BoardInterview::find($id))
            return redirect()->back()->with('error', msg_collection('none_post'));


        //--- 작성자와 다른 사용자가 접근하였을 때
        if (session()->get('account') != $update->user_id)
            return redirect()->back()->with('error', msg_collection('access_impossible'));


        $update->status = $status;
        $update->updated_at = Now();
        if ($update->save()) {
            return redirect()->route('mypage.interview.list')->with('success', msg_collection('success_correction'));
        }

        return redirect()->route('mypage.interview.list')->with('success', msg_collection('failure_correction'));

    }

    public function receiptHistory(Request $request)
    {
        //--- 로그인 체크
        if (is_null(session()->get('login_check'))) {
            return redirect()->route('login')->with('error', msg_collection('failure_login'));
        } else if (session()->get('donga_type') == 'admin') {
            return redirect('/' . ADMIN_URL);
        }


        $lists = BoardProgram::student(session()->get('account'));

        return View('mypage.receipt.list', [
            'lists' => $lists
        ]);
    }

    public function receiptDetails()
    {
        return View('mypage.receipt.details');
    }


    public function scrapHistory(Request $request)
    {
        //--- 로그인 체크
        if (is_null(session()->get('login_check'))) {
            return redirect()->route('login')->with('error', msg_collection('failure_login'));
        } else if (session()->get('donga_type') == 'admin') {
            return redirect('/' . ADMIN_URL);
        }

        //--- 검색 세팅
        $term = $request->term ?: '';
        $keyword = $request->keyword ?: 'all';


        //--- 스크랩 내역 가져오기 (스크랩은 여기에서만 불러오기때문에 따로 모델을 정의하지 않음)
        $lists = DB::table('scrap_lists')
            ->where('account', session()->get('account'))
            ->when($keyword, function ($query, $keyweord) use ($term) {
                //--- 전체이면
                if ($keyweord == 'all') {
                    return $query->where('board_title', 'like', '%' . $term . '%')
                        ->where('subject', 'like', '%' . $term . '%');
                } else {
                    if ($keyweord == 'title') $keyweord = 'board_title';
                    return $query->where($keyweord, 'like', '%' . $term . '%');
                }
            })->paginate(10);


        //--- 검색 배열화
        $search = [
            'keyword' => $keyword,
            'term' => $term
        ];

        return View('mypage.scrap.list', [
            'lists' => $lists,
            'search' => $search
        ]);
    }


    public function studyroomHistory()
    {
        //--- 로그인 체크
        if (is_null(session()->get('login_check'))) {
            return redirect()->route('login')->with('error', msg_collection('failure_login'));
        } else if (session()->get('donga_type') == 'admin') {
            return redirect('/' . ADMIN_URL);
        }


        $student = session()->get('account');


        $lists = DB::table("room_reservations")
            ->select('room_reservations.id', 'room_reservations.room_id', 'room_reservations.status', 'room_reservations.created_at', 'room_reservations.campus_id', 'room_reservations.target_type', 'room_reservations.date', 'room_reservation_students.account', 'room_reservation_students.reservation_id')
            ->join('room_reservation_students', 'room_reservations.id', '=', 'room_reservation_students.reservation_id')
            ->where('room_reservation_students.account', $student)
            ->orderByDesc("room_reservations.id")
            ->paginate(15);


        foreach ($lists as $list) {

            // 스터디룸 정보 가져오기
            $room_info = StudyRoom::find($list->room_id);

            // 예약한 시간대 가져온다.
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


            // 예약 학생정보를 가져온다.
            $reservation_students = DB::table("room_reservations")
                ->select('room_reservation_students.account', 'room_reservation_students.type')
                ->leftJoin('room_reservation_students', 'room_reservations.id', '=', 'room_reservation_students.reservation_id')
                ->where('room_reservation_students.reservation_id', '=', $list->id)
                ->orderBy('room_reservation_students.id')
                ->get();


            //--- 예약 내역과 학생정보 합치기
            $list->students = $reservation_students;
            $list->room_name = $room_info->name ?? '-';
            $list->campus_name = get_campus_name($list->campus_id);
            $list->reservatio_date = $list->date . ' ' . $range_times;
            $list->times = $list->times ?? '-';
            $list->account = $account ?? '-';
            $list->student_name = $student->name ?? '-';
            $list->department = $student_info->department ?? '-';
            $list->target_type = get_room_target_type($list->target_type);
            $list->status = get_room_status($list->status);
            $list->room_password = $room_info->room_password;

        }


        //--- 무단 미사용 횟수
        $no_show_cnt = RoomReservation::get_no_show_count($student);

        return View('mypage.studyroom.list', [
            'lists' => $lists,
            'no_show_cnt' => $no_show_cnt
        ]);
    }

    public function alimiSetting(Request $request)
    {
        $account = session()->get('account');
        $recommend_page = $request->get('recommend_page') ?: 1;
        $notice_page = $request->get('notice_page') ?: 1;
        $alimi_category = $recommend_lists = $notice_lists = [];
        $recommend_cnt = $notice_cnt = [];
        $boardCategory = new BoardCategory();
        $studentAlimi = new StudentAlimi();
        $categoryData = $studentAlimi->getCategoryList($account);  // 로그인한 학생이 설정한 알리미 카테고리를 가져와 배열에 담음.


        // 순회하여 데이터를 가져온다.
        foreach ($categoryData as $key => $val) {

            if (!count($val)) {
                continue;
            }

            $list = [];
            foreach ($val as $category) {
                $list['category_id'][] = $category->category_id;
                $list['date'][$category->category_id] = $category->updated_at;
                $alimi_category[$key][] = $category->category_id;
            }


            switch ($key) {
                case array_search('채용정보', get_admin_menu_list(), true):
                    $recommend_lists = $boardCategory->getData($key, get_admin_menu_table($key), $list, $recommend_page);
                    $recommend_cnt = $boardCategory->getCnt($key, get_admin_menu_table($key), $list, $recommend_page);
                    break;

                case array_search('공지사항', get_admin_menu_list(), true):
                    $notice_lists = $boardCategory->getData($key, get_admin_menu_table($key), $list, $notice_page);
                    $notice_cnt = $boardCategory->getCnt($key, get_admin_menu_table($key), $list, $recommend_page);
                    break;
            }
        }


        return View('mypage.alimi.list', [
            'alimi_recommend_list' => $studentAlimi->getRecommendCategory(),
            'alimi_notice_list' => $studentAlimi->getNoticeCategory(),
            'alimi_category' => $alimi_category,
            'recommend_list' => $recommend_lists,
            'notice_list' => $notice_lists,
            'recommend_page' => $recommend_page,
            'notice_page' => $notice_page,
            'recommend_cnt' => $recommend_cnt,
            'notice_cnt' => $notice_cnt,
            'keyword' => ''
        ]);
    }

    public function setAlimi(Request $request)
    {
        $menu_id = $request->id;
        $category_ids = $request->data;
        $account = session()->get('account');

        $alimi = new Alimi();
        $studentAlimi = new StudentAlimi();

        if(!$category_ids) {
            return response()->json([
                'status' => 200
            ]);
        }


        //--- 저장되어 있던 카테고리를 가져온다.
        $categoryData = $studentAlimi->getCategoryList($account);

        //--- 해제되었던 카테고리를 삭제한다.
        foreach ($categoryData[$menu_id] as $category) {

            $category_id = $category->category_id;

            if (!in_array($category_id, $category_ids)) {
                $alimi->deleteData($account, $menu_id, $category_id);
            }
        }

        if(is_array($category_ids)) {

            //--- 체크하였던 카테고리를 저장한다.
            foreach ($category_ids as $category_id) {

                // 이미 저장된 카테고리라면 저장하지 않는다.
                if ($alimi->isData($account, $menu_id, $category_id)) {
                    continue;
                }

                // 저장
                $alimi->setData($account, $menu_id, $category_id);
            }
        }

        return response()->json([
            'status' => 200
        ]);
    }

    public function getAlimi(Request $request)
    {

        if($request->get('bool'))
            $this->setAlimi($request);

        $account = session()->get('account');
        $page = $request->get('page') ?: 1;
        $id = $request->get('id');
        $alimi_category = $recommend_lists = $notice_lists = [];
        $boardCategory = new BoardCategory();
        $studentAlimi = new StudentAlimi();
        $categoryData = $studentAlimi->getCategoryList($account);  // 로그인한 학생이 설정한 알리미 카테고리를 가져와 배열에 담음.


        // 순회하여 데이터를 가져온다.
        foreach ($categoryData as $key => $val) {

            if (!count($val)) {
                continue;
            }

            $list = [];
            foreach ($val as $category) {
                $list['category_id'][] = $category->category_id;
                $list['date'][$category->category_id] = $category->updated_at;
            }

            switch ($key) {
                case array_search('채용정보', get_admin_menu_list(), true):
                    $recommend_lists = $boardCategory->getData($key, get_admin_menu_table($key), $list, $page);
                    break;

                case array_search('공지사항', get_admin_menu_list(), true):
                    $notice_lists = $boardCategory->getData($key, get_admin_menu_table($key), $list, $page);
            }

        }


        return view('mypage.alimi.table', [
            'recommend_list' => $recommend_lists,
            'notice_lists' => $notice_lists,
            'id' => $id
        ]);


    }

    public function getPage(Request $request)
    {
        $menu_id = $request->get('id');
        $page = $request->get('page');
        $account = session()->get('account');
        $cnt = [];

        $boardCategory = new BoardCategory();
        $studentAlimi = new StudentAlimi();
        $categoryData = $studentAlimi->getCategoryList($account);  // 로그인한 학생이 설정한 알리미 카테고리를 가져와 배열에 담음.


        // 순회하여 데이터를 가져온다.
        foreach ($categoryData as $key => $val) {

            if (!count($val)) {
                continue;
            }

            $list = [];
            foreach ($val as $category) {
                $list['category_id'][] = $category->category_id;
                $list['date'][$category->category_id] = $category->updated_at;
            }

            if ($key == $menu_id) {
                $cnt = $boardCategory->getCnt($key, get_admin_menu_table($key), $list, $page);
            }

        }


        return view('mypage.alimi.page', [
            'cnt' => count($cnt),
            'page' => $page
        ]);

    }


    public function alimiDelete(Request $request) {
        $menu_id = $request->id;
        $post_id = $request->postId;
        $account = session()->get('account');
        $alimiDelete = new AlimiDelete();

        foreach ($post_id as $id) {
            $alimiDelete->setData($account, $menu_id, $id);
        }


        return response()->json([
            'status' => 200
        ]);

    }

}
