<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BoardProgram;
use App\Models\ProgramReservation;
use App\Models\Student;
use Illuminate\Http\Request;

class AdminBoardProgramController extends Controller
{
    public function index(Request $request)
    {
        $lists = BoardProgram::paging($request);



        $search = [
            'search' => $request->search,
            'term' => $request->term,
            'from' => $request->from ?? '',
            'to' => $request->to ?? ''
        ];


        return view('admin.support.program.list', [
            'lists' => $lists,
            'search' => $search,
            'column' => $request->column ?? 'id',
            'orderBy' => $request->orderBy ?? 'desc'
        ]);
    }

    public function view($id)
    {
        if ($list = BoardProgram::find($id)) {

            $applicant_lists = ProgramReservation::paging($id, 1);
            $waiting_lists = ProgramReservation::paging($id, 2);


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

            //--- 학생 데이터 가져와서 합치기
            foreach ($waiting_lists as $key => $waiting_list) {
                $student = Student::getStudent($waiting_list->account);
                $waiting_lists[$key]->name = $student->name;
                $waiting_lists[$key]->phone_number = $student->phone_number;
                $waiting_lists[$key]->university = $student->university;
                $waiting_lists[$key]->department = $student->department;
                $waiting_lists[$key]->academic = $student->academic;
                $waiting_lists[$key]->grade = $student->grade;
            }


            return view('admin.support.program.view', [
                'list' => $list,
                'applicant_lists' => $applicant_lists,
                'waiting_lists' => $waiting_lists
            ]);
        }
        return back()->with("error", msg_collection('access_impossible'));
    }

    public function create()
    {
        return view("admin.support.program.create");
    }

    public function edit($id)
    {
        if ($update = BoardProgram::find($id)) {
            return view('admin.support.program.create', [
                'list' => $update
            ]);
        }
        return back()->with("error", "잘못 접근하였습니다.");
    }

    public function update(Request $request, BoardProgram $notice)
    {
        if (!$request->id)
            return back()->with("error", "수정하는데 실패 하였습니다. 다시 시도해 주세요.");

        if(!$request->contents)
            return back()->with("error", msg_collection('empty_content'));

        $update = $notice::find($request->id);

        $update->subject = $request->subject;
        $update->status_auto = $request->status_auto;
        $update->status = $request->status;
        $update->open = $request->open;
        $update->teacher_name = $request->teacher_name;
        $update->start_reception_date = $request->start_reception_date;
        $update->start_reception_time = $request->start_reception_time;
        $update->end_reception_date = $request->end_reception_date;
        $update->end_reception_time = $request->end_reception_time;
        $update->start_course_date = $request->start_course_date;
        $update->start_course_time = $request->start_course_time;
        $update->end_course_date = $request->end_course_date;
        $update->end_course_time = $request->end_course_time;
        $update->location = $request->location;
        $update->number_students = $request->number_students;
        $update->number_waiting = $request->number_waiting;
        $update->education_target = $request->education_target;
        $update->student_grade = $request->student_grade;
        $update->text_book = $request->text_book;
        $update->tuition_fees = $request->tuition_fees;
        $update->contents = $request->contents;
        $update->deadline_date = $request->deadline_date;
        $update->deadline_time = $request->deadline_time;
        $update->bank_name = $request->bank_name;
        $update->account_holder = $request->account_holder;
        $update->account_number = $request->account_number;
        $update->updated_at = now();


        if ($update->save()) {
            return back()->with("success", "정상적으로 수정되었습니다.");
        }

        return back()->with("error", "수정하는데 실패 하였습니다. 다시 시도해 주세요.");
    }


    public function store(Request $request)
    {
        $params = $request->only([
            'subject',
            'status_auto',
            'status',
            'open',
            'teacher_name',
            'start_reception_date',
            'start_reception_time',
            'end_reception_date',
            'end_reception_time',
            'start_course_date',
            'start_course_time',
            'end_course_date',
            'end_course_time',
            'location',
            'number_students',
            'number_waiting',
            'education_target',
            'student_grade',
            'text_book',
            'tuition_fees',
            'deadline_date',
            'deadline_time',
            'bank_name',
            'account_holder',
            'account_number'
        ]);
        $params['contents'] = $request->contents;
        $params['user_id'] = session()->get('user_id');

//        if(!$request->contents)
//            return back()->with("error", msg_collection('empty_content'));


        if (BoardProgram::create($params)) {
            return redirect()->route("admin.support.program.index")->with("success", "정상적으로 등록되었습니다.");
        }

        return back()->with("error", "등록에 실패하였습니다.");

    }

    // 개별 삭제
    public function destroy(Request $request)
    {
        $id = $request->id;

        if (isset($id)) {

            //--- 신청자가 있는지 체크
            if (ProgramReservation::where('program_id', $id)->exists()) {
                return redirect()->back()->with(['error' => '신청자로 인해 삭제가 불가능합니다.']);
            }

            //--- 삭제
            if (BoardProgram::find($id)->delete()) {
                return redirect()->route("admin.support.program.index")->with("success", "정상적으로 삭제되었습니다.");
            }

        }

        return back()->with("error", "삭제하는데 실패했습니다. 다시 시도해 주세요.");
    }

    // 선택 삭제
    public function destroyAll(Request $request)
    {
        $chk = false;
        foreach ($request->chk as $id) {
            $delete = BoardProgram::find($id);

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
