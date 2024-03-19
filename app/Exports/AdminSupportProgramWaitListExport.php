<?php

namespace App\Exports;

use App\Models\BoardProgram;
use App\Models\Log;
use App\Models\ProgramReservation;
use App\Models\Student;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;


class AdminSupportProgramWaitListExport implements FromView, WithColumnWidths
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function columnWidths(): array
    {

        return [
            'A' => 20,
            'B' => 40,
            'C' => 40,
            'D' => 30,
            'E' => 30,
            'F' => 30,
            'G' => 30,
            'H' => 30,
            'I' => 30,
            'J' => 30,
            'K' => 30,
        ];
    }

    public function view(): View
    {
        $contents = BoardProgram::find($this->id);

        $applicant_lists = ProgramReservation::getData($this->id, 1);
        $waiting_lists = ProgramReservation::getData($this->id, 2);


        //--- 학생 데이터 가져와서 합치기
        foreach ($applicant_lists as $key => $applicant_list) {
            $student = Student::getStudent($applicant_list->account);
            $applicant_lists[$key]->name = $student->name;
            $applicant_lists[$key]->phone_number = $student->phone_number;
            $applicant_lists[$key]->university = $student->university;
            $applicant_lists[$key]->department = $student->department;
            $applicant_lists[$key]->academic = $student->academic;
            $applicant_lists[$key]->grade = $student->grade;
            $applicant_lists[$key]->line = $student->line;
            $applicant_lists[$key]->gender = $student->gender;

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
            $waiting_lists[$key]->line = $student->line;
            $waiting_lists[$key]->gender = $student->gender;

        }


        $heads = ["번호", "프로그램명", "신청일시", "이름", "성별", "전화번호", "학번", "대학교", "학부(과)", "학년", "학적"];
        return view("admin._excel.support.program.list", ["heads" => $heads, "contents" => $contents, 'applicant_lists' => $waiting_lists, "index" => 1]);
    }

}
