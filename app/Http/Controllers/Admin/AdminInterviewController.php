<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BoardInterview;
use App\Models\BoardProgram;
use App\Models\ProgramReservation;
use App\Models\Student;
use Illuminate\Http\Request;

class AdminInterviewController extends Controller
{
    public function index(Request $request)
    {
        $lists = BoardInterview::paging($request);

        $search = [
            'search' => $request->search,
            'term' => $request->term,
            'from' => $request->from ?? '',
            'to' => $request->to ?? ''
        ];

        return view('admin.support.interview.list', [
            'lists' => $lists,
            'search' => $search,
            'column' => $request->column ?? 'id',
            'orderBy' => $request->orderBy ?? 'desc',
        ]);
    }

    public function view($id)
    {
        if ($list = BoardProgram::find($id)) {

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


            return view('admin.support.program.view', [
                'list' => $list,
                'applicant_lists' => $applicant_lists
            ]);
        }
        return back()->with("error", "잘못 접근하였습니다.");
    }

    public function create()
    {
        return view("admin.support.interview.create");
    }

    public function store(Request $request)
    {
        $params = $request->only([
            'enterprise',
            'category',
            'support_division',
            'support_job',
            'next_round',
            'user_id',
            'next_round_schedule',
        ]);

        //--- 필수값이 비었는지 체크
//        foreach ($params as $param) {
//            if ($param == '') {
//                return back()->with("error", "모든값을 입력해주시길 바랍니다.");
//            }
//        }

        $params['contents'] = $request->contents ?: ' ';


        if(!Student::getStudent($params['user_id'])) {
            return back()->with("error", "존재하지 않는 아이디 입니다. 체크 바랍니다.");
        }

        if (BoardInterview::create($params)) {
            return redirect('/superviser/support/interview')->with("success", "정상적으로 등록되었습니다.");
        }

        return back()->with("error", "등록에 실패하였습니다.");
    }

    public function edit($id)
    {
        if ($update = BoardInterview::find($id)) {
            return view('admin.support.interview.create', [
                'list' => $update
            ]);
        }
        return back()->with("error", "잘못 접근하였습니다.");
    }

    public function update(Request $request)
    {
        if (!$request->id)
            return back()->with("error", "수정하는데 실패 하였습니다. 다시 시도해 주세요.");

        $update = BoardInterview::find($request->id);

        $update->enterprise = $request->enterprise;
        $update->category = $request->category;
        $update->support_division = $request->support_division;
        $update->support_job = $request->support_job;
        $update->next_round = $request->next_round;
        $update->next_round_schedule = $request->next_round_schedule;
        $update->contents = $request->contents;
        $update->updated_at = now();



        if ($update->save()) {
            return back()->with("success", "정상적으로 수정되었습니다.");
        }

        return back()->with("error", "수정하는데 실패 하였습니다. 다시 시도해 주세요.");
    }

    // 개별 삭제
    public function destroy(Request $request)
    {
        if (isset($request->id)) {
            $delete = BoardInterview::find($request->id);

            if ($delete->delete()) {
                return redirect('/superviser/support/interview')->with("success", "정상적으로 삭제되었습니다.");
            }
        }

        return back()->with("error", "삭제하는데 실패했습니다. 다시 시도해 주세요.");
    }

    // 선택 삭제
    public function destroyAll(Request $request)
    {
        $chk = false;
        foreach ($request->chk as $id) {
            $delete = BoardInterview::find($id);

            if ($delete->delete())
                $chk = true;
            else {
                $chk = false;
                break;
            }
        }

        if ($chk)
            return back()->with("success", "정상적으로 삭제되었습니다.");

        return back()->with("error", "삭제하는데 실패하였습니다. 다시 시도해 주세요.");
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {

            $origin_name = $request->file('upload')->getClientOriginalName();
            $file_name = pathinfo($origin_name, PATHINFO_FILENAME);
            $extension_name = $request->file('upload')->getClientOriginalExtension();
            $encrypted_fileName = bin2hex(random_bytes(20)) . '_' . time() . '.' . $extension_name;

            $request->file('upload')->move(storage_path('/app/public/program/images'), $encrypted_fileName);


            return response()->json([
                'uploaded' => 1,
                'original_name' => $file_name,
                'url' => '/storage/program/images/' . $encrypted_fileName
            ]);
        }
    }
}
