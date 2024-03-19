<?php

namespace App\Http\Controllers;

use App\Boards\Recommend;
use App\Models\Attachment;
use App\Models\RecommendReservation;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BoardRecommendController extends Controller
{
    protected Recommend $board;
    protected RecommendReservation $reservationBoard;

    public function __construct(Request $request)
    {
        $this->board = new Recommend();
        $this->reservationBoard = new RecommendReservation();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 게시글 가져오기
        $lists = $this->board->normalGet($request);


        return View('jobinfo.recommend.list', [
            'lists' => $lists,
            'count' => count($lists),
            'keyword' => $request->keyword,
            'term' => $request->term ?: '',
            'view_count' => $request->view_count
        ]);
    }

    public function view($id)
    {
        //--- 게시판 아이디값이 없으면 빠꾸
        if (!$id)
            return back()->with("error", msg_collection('access_impossible'));

        //--- 조회수 증가
        $this->board->hitUp($id);


        //--- 게시물 가져오기
        if (!$list = $this->board->find($id)) // 게시물이 없으면 다시 빠꾸
            return back()->with("error", msg_collection('none_post'));

        //--- 첨부파일 가져오기
        $files = Attachment::getAll($list);


        //--- 접수시간 지났는지 체크
        $s_date = $list->receipt_start_date . ' ' . $list->receipt_start_time; // 접수시작일
        $e_date = $list->receipt_end_date . ' ' . $list->receipt_end_time; // 접수마감일
        $s_over = is_time_over($s_date); // true시 접수불가
        $e_over = is_time_over($e_date); // true시 접수가능

        //--- 접수 비활성화 처리
        $result = [
            'msg' => '지원하기',
            'disabled' => '',
            'href' => '/jobinfo/recommend/' . $list->id . '/add',
        ];


        if (!$e_over) {
            $result = [
                'msg' => '접수마감',
                'disabled' => 'disabled',
                'href' => 'javascript:void(0)'
            ];
        } else if ($s_over) {
            $result = [
                'msg' => '접수대기',
                'disabled' => 'disabled',
                'href' => 'javascript:void(0)'
            ];
        }


        //--- 지원했는지 체크
        if (session()->get('login_check') && count($this->reservationBoard->bring($list->id, session()->get('account')))) {
            $result = [
                'msg' => '지원완료',
                'disabled' => 'disabled',
                'href' => 'javascript:void(0)'
            ];
        }

        //--- 로그인 안되어 있거나 관계자일경우
        if (!session()->get('login_check') || isStaffCheck(session()->get('donga_type'))) {
            $result['href'] = 'javascript:void(0)';
        }

        //---- 이전 게시물 가져오기
        $prev_list = DB::table("board_recommends")->where('id', '<', $id)->orderBy('id', 'desc')->first();

        //---- 다음 게시물 가져오기
        $next_list = DB::table("board_recommends")->where('id', '>', $id)->orderBy('id', 'asc')->first();


        return View('jobinfo.recommend.view', [
            'list' => $list,
            'files' => $files,
            's_over' => $s_over,
            'e_over' => $e_over,
            'result' => $result,
            'prev_list' => $prev_list,
            'next_list' => $next_list
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
   /*     $success_ip = [
            '115.88.69.98',
            '118.235.43.7'
        ];

        if (!in_array($_SERVER['REMOTE_ADDR'], $success_ip)) {
            return back()->with("error", '22년 6월 15일 12시까지 점검 예정입니다. 죄송합니다.');
        }*/

        //--- 로그인하지 않았으면 빠꾸
        if (!session()->get('login_check'))
            return back()->with("error", msg_collection('failure_login'));

        //--- post id 값이 없으면 빠꾸
        if (!$id)
            return back()->with("error", msg_collection('access_impossible'));


        if (is_manager_check(session()->get('donga_type')))
            return back()->with("error", msg_collection('failure_manager'));


        //--- 게시물 정보 가져오기 (게시물이 없으면  빠꾸)
        if (!$list = $this->board->find($id))
            return back()->with("error", msg_collection('none_post'));


        //--- 접수시간 지났는지 체크
        $s_date = $list->receipt_start_date . ' ' . $list->receipt_start_time; // 접수시작일
        $e_date = $list->receipt_end_date . ' ' . $list->receipt_end_time; // 접수마감일
        $s_over = is_time_over($s_date); // true시 접수불가
        $e_over = is_time_over($e_date); // true시 접수가능

        //--- 접수 비활성화 처리
        $result = [
            'msg' => '지원하기',
            'disabled' => '',
            'href' => '/jobinfo/recommend/' . $list->id . '/add',
            'login' => 0
        ];
        if (!$e_over) {
            $result['msg'] = '접수마감';
            $result['disabled'] = 'disabled';
            $result['href'] = 'javascript:void(0)';
        } else if ($s_over) {
            $result['msg'] = '접수대기';
            $result['disabled'] = 'disabled';
            $result['href'] = 'javascript:void(0)';
        }


        //--- 지원했는지 체크
        if (count($this->reservationBoard->bring($list->id, session()->get('account')))) {
            $result['msg'] = '지원완료';
            $result['disabled'] = 'disabled';
            $result['href'] = 'javascript:void(0)';
        }


        return View('jobinfo.recommend.create', [
            'user' => Student::getStudent(session()->get('account')),
            'list' => $list,
            's_over' => $s_over,
            'e_over' => $e_over,
            'result' => $result
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public
    function store(Request $request)
    {
        //--- 로그인하지 않았으면 빠꾸
        if (!session()->get('login_check'))
            return back()->with("error", msg_collection('failure_login'));


        //--- post id 값이 없으면 빠꾸
        if (!$request->recommend_id)
            return back()->with("error", msg_collection('access_impossible'));

        //--- 이미 예약했으면 빠꾸
        if (!count($this->reservationBoard->bring($request->recommend_id, session()->get('account'))))
            return back()->with("error", msg_collection('reservation_already'));


        if ($write = $this->board->write($request)) {
            return redirect()->route("mypage.recommend.list")->with("success", "글을 작성했습니다.");
        } else {
            return back()->with("error", "문제가 발생했습니다. 다시 시도해 주세요");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function edit($id)
    {
        //--- 로그인하지 않았으면 빠꾸
        if (!session()->get('login_check'))
            return back()->with("error", msg_collection('failure_login'));

        //--- post id 값이 없으면 빠꾸
        if (!$id)
            return back()->with("error", msg_collection('access_impossible'));


        //--- 예약 정보 가져오기 (예약 없으면  빠꾸) -- TODO:: 변경요망
        if (!$reservation = DB::table('recommend_reservations')->find($id))
            return back()->with("error", '존재하지 않는 지원내역 입니다.');


        //--- 예약자와 다른 아이디가 접근하려고 했을 때 빠꾸
        if ($reservation->account != session()->get('account'))
            return back()->with("error", msg_collection('access_impossible'));


        //--- 게시물 정보 가져오기 (게시물이 없으면  빠꾸)
        if (!$list = $this->board->find($reservation->recommend_id))
            return back()->with("error", msg_collection('none_post'));


        $result['msg'] = '저장';
        $result['disabled'] = '';
        $result['href'] = 'javascript:void(0)';


        return View('jobinfo.recommend.create', [
            'user' => Student::getStudent(session()->get('account')),
            'list' => $list,
            'reservation' => $reservation,
            'result' => $result
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request)
    {
        $id = $request->id;

        //--- 로그인하지 않았으면 빠꾸
        if (!session()->get('login_check'))
            return back()->with("error", msg_collection('failure_login'));

        //--- post id 값이 없으면 빠꾸
        if (!$id)
            return back()->with("error", msg_collection('access_impossible'));


        if (!$update = DB::table('recommend_reservations')->find($id))
            return back()->with("error", '존재하지 않는 지원내역 입니다.');

        $update->question1 = $request->question1;
        $update->question2 = $request->question2;
        $update->question3 = $request->question3;
        $update->question4 = $request->question4;
        $update->question5 = $request->question5;
        $update->question6 = $request->question6;
        $update->question7 = $request->question7;
        $update->question8 = $request->question8;
        $update->question9 = $request->question9;
        $update->attachment1 = $request->attachment1;
        $update->attachment2 = $request->attachment2;
        $update->attachment3 = $request->attachment3;
        $update->proof_photo = $request->proof_photo;

        if ($this->reservationBoard->update($request)) {
            return redirect()->route("mypage.recommend.list")->with("success", "지원 내역이 수정되었습니다.");
        } else {
            return back()->with("error", "문제가 발생했습니다. 다시 시도해 주세요");
        }
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

    public function reservation(Request $request)
    {

        //--- 로그인하지 않았으면 빠꾸
        if (!session()->get('login_check'))
            return back()->with("error", msg_collection('failure_login'));


        //--- post id 값이 없으면 빠꾸
        if (!$request->recommend_id)
            return back()->with("error", msg_collection('access_impossible'));

        //--- 이미 예약했으면 빠꾸
        if (count($this->reservationBoard->bring($request->recommend_id, session()->get('account'))))
            return back()->with("error", msg_collection('reservation_already'));


        if ($write = $this->reservationBoard->write($request)) {
            return redirect()->route("mypage.recommend.list")->with("success", msg_collection('success_enrollment'));
        } else {
            return back()->with("error", msg_collection('error_enrollment'));
        }
    }
}
