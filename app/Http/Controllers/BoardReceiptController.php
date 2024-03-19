<?php

namespace App\Http\Controllers;

use App\Boards\Receipt;
use App\Models\BoardProgram;
use App\Models\ProgramReservation;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BoardReceiptController extends Controller
{
    protected Receipt $board;


    public function __construct(Request $request)
    {
        $this->board = new Receipt();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($_SERVER['REMOTE_ADDR'] == '')
        // 게시글 가져오기
        $request->open = 1;
        $lists = BoardProgram::paging($request);


        return View('program.receipt.list', [
            "lists" => $lists,
            'term' => $request->term ?? '',
            'search_cate' => $request->search_cate ?? 'sch-all',
            'view_count' => $request->view_count ?? '',
        ]);
    }

    public function view($id)
    {
        if ($list = BoardProgram::find($id)) {
            $possible_status = [0, 1, 3]; // 접수대기, 접수중, 대기접수중 (접수가가능한 상태값)
            $result = ['msg' => '강좌신청', 'disabled' => ''];// 출력 상태값 배열


            //--- 비공개 프로그램일시
            if (!$list->open) {
                return back()->with('error', '비공개처리된 접수목록 입니다.');
            }

            $applicant_lists = ProgramReservation::paging($id);

            //--- 학생 데이터 가져와서 합치기
            foreach ($applicant_lists as $key => $applicant_list) {
                $student = Student::getStudent($applicant_list->account);
                $applicant_lists[$key]->name = $student->name;
                $applicant_lists[$key]->phone_number = $student->phone_number;
                $applicant_lists[$key]->university = $student->university;
                $applicant_lists[$key]->department = $student->department;
                $applicant_lists[$key]->academic = $student->academic;
                $applicant_lists[$key]->grade = $student->grade;
            }


            // 토큰 생성 (add 페이지에서 체크할때 쓰인다.)
            $program_token = getRandStr(30);
            session(['program_token' => $program_token]);


            $s_date = $list->start_reception_date . ' ' . $list->start_reception_time; // 접수시작일
            $e_date = $list->end_reception_date . ' ' . $list->end_reception_time; // 접수마감일
            $s_over = is_time_over($s_date); // true시 접수불가
            $e_over = is_time_over($e_date); // true시 접수가능



            //--- 상태값 체크
            if (is_program_status_auto($list->status_auto)) { //상태값 자동일경우
                $status = get_status_type($list);
                if (!in_array($status, $possible_status)) {
                    $result = [
                        'msg' => get_program_status_lists($status),
                        'disabled' => 'disabled',
                    ];
                }

            } else { // 상태값 수동일경우

                //--- 접수시간 지났는지 체크
                if (!$e_over) {
                    $result = [
                        'msg' => '접수마감',
                        'disabled' => 'disabled',
                    ];
                } else if ($s_over) {
                    $result = [
                        'msg' => '접수대기',
                        'disabled' => 'disabled',
                    ];
                } else {
                    if (!in_array($list->status, $possible_status)) {
                        $result = [
                            'msg' => get_program_status_lists($list->status),
                            'disabled' => 'disabled',
                        ];
                    }
                }
            }


            // 예약했는지 체크
            if (ProgramReservation::is_reservation_user($id, session()->get('account'))) {
                $result = [
                    'msg' => '접수완료',
                    'disabled' => 'disabled'
                ];
            }

            //--- 로그인 안되어 있거나 관계자일경우
            if (!session()->get('login_check') || isStaffCheck(session()->get('donga_type'))) {
                $result['disabled'] = 'disabled';
            }


            //---- 이전 게시물 가져오기
            $prev_list = DB::table("board_programs")->where('id', '<', $id)->orderBy('id', 'desc')->first();

            //---- 다음 게시물 가져오기
            $next_list = DB::table("board_programs")->where('id', '>', $id)->orderBy('id', 'asc')->first();


            return View('program.receipt.view', [
                'list' => $list,
                'applicant_lists' => $applicant_lists,
                'program_token' => $program_token,
                'result' => $result,
                'e_over' => $e_over,
                's_over' => $s_over,
                'prev_list' => $prev_list,
                'next_list' => $next_list
            ]);
        }

        return back()->with("error", msg_collection('none_post'));
    }



    public function create(Request $request)
    {
        $id = $request->id;

        //--- 로그인 체크
        if (!session()->get('login_check'))
            return redirect()->route('login')->with('error', msg_collection('failure_login'));

        if (!$id) {
            return redirect()->route('program.receipt.index')->with('error', msg_collection('access_impossible'));
        }

        //--- 있는게시물인지 체크
        if (!$list = BoardProgram::find($id)) {
            return redirect()->back()->with('error', msg_collection('none_post'));
        }

        //--- 비공개 프로그램일시
        if (!$list->open) {
            return back()->with('error', '비공개처리된 접수목록 입니다.');
        }

        if (is_manager_check(session()->get('donga_type'))) {
            return back()->with('error', msg_collection('failure_manager'));
        }

        $student = Student::getStudent(session()->get('account'));

        //-- 예약했는지
        $check = false;
        $possible_status = [0, 1, 3]; // 접수대기, 접수중 (접수가가능한 상태값)
        $result = ['msg' => '강좌신청', 'disabled' => ''];


        // 예약했는지 체크
        if (ProgramReservation::is_reservation_user($request->id, session()->get('account'))) {
            $result = [
                'msg' => '접수완료',
                'disabled' => 'disabled'
            ];
        } else {

            //--- view 페이지를 통해 들어오지 않았을 경우  view 페이지에서 받은 토큰값 체크
            if (!session()->has('program_token') || $request->program_token != session()->pull('program_token')) {
                return back()->with('error', '토큰값이 일치하지 않습니다. \n재신청 하시길 바랍니다.');
            }

            //--- 상태값 체크
            if (is_program_status_auto($list->status_auto)) { //상태값 자동일경우
                $status = get_status_type($list);
                if (!in_array($status, $possible_status)) {
                    $result = [
                        'msg' => get_program_status_lists($status),
                        'disabled' => 'disabled',
                    ];
                }

            } else { // 상태값 수동일경우

                $s_date = $list->start_reception_date . ' ' . $list->start_reception_time; // 접수시작일
                $e_date = $list->end_reception_date . ' ' . $list->end_reception_time; // 접수마감일
                $s_over = is_time_over($s_date); // true시 접수불가
                $e_over = is_time_over($e_date); // true시 접수가능

                //--- 접수시간 지났는지 체크
                if (!$e_over) {
                    $result = [
                        'msg' => '접수마감',
                        'disabled' => 'disabled',
                    ];
                } else if ($s_over) {
                    $result = [
                        'msg' => '접수대기',
                        'disabled' => 'disabled',
                    ];
                } else {
                    if (!in_array($list->status, $possible_status)) {
                        $result = [
                            'msg' => get_program_status_lists($list->status),
                            'disabled' => 'disabled',
                        ];
                    }
                }
            }
        }

        return View('program.receipt.create', [
            'user' => $student,
            'id' => $request->id,
            'result' => $result
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
        $id = $request->program_id;

        //--- 로그인 체크
        if (!session()->get('login_check'))
            return redirect()->route('login')->with('error', msg_collection('failure_login'));

        if (!$id) {
            return redirect()->route('program.receipt.index')->with('error', msg_collection('access_impossible'));
        }

        //--- 있는게시물인지 체크
        if (!$list = BoardProgram::find($id)) {
            return redirect()->back()->with('error', msg_collection('none_post'));
        }

        //--- 비공개 프로그램일시
        if (!$list->open) {
            return back()->with('error', '비공개처리된 접수목록 입니다.');
        }


        $params = $request->only(['program_id']);
        $params['account'] = session()->get('account');
        $status = [1, 2]; // 1 : 수강인원, 2: 대기인원

        // 예약했는지 체크
        if (ProgramReservation::is_reservation_user($params['program_id'], $params['account'])) {
            return redirect()->back()->with("error", msg_collection('reservation_already'));
        }


        foreach ($status as $val) {
            if (!ProgramReservation::is_reservation_full($params['program_id'], $val)) {
                $params['status'] = $val;

                //--- 등록 될경우
                if (ProgramReservation::create($params)) {
                    return redirect()->route('mypage.receipt.list')->with("success", msg_collection('success_enrollment'));
                }


                return redirect()->route('program.receipt.index')->with("error", msg_collection('error_enrollment'));
            }

        }

        return redirect()->route('program.receipt.index')->with("error", msg_collection('reservation_full'));

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

    public function check(Request $request)
    {
        if (!$request->program_id)
            return response()->json(['status' => 404]);

        $status = [1, 2]; // 1 : 수강인원, 2: 대기인원
        $account = $request->studnet_id ?? session()->get('account');


        // 예약했는지 체크
        if (ProgramReservation::is_reservation_user($request->program_id, $account)) {
            return response()->json(['status' => 204]);
        }

        //--- 수강인원, 대기인원 신청이 가능 한지 체크한다.
        foreach ($status as $val) {
            if (ProgramReservation::is_reservation_full($request->program_id, $val)) {
                return response()->json(['status' => 200]); // 예약이 가능하면 200 을주고 return
            }
        }

        return response()->json(['status' => 206]);

    }


    function worknet()
    {

    }
}
