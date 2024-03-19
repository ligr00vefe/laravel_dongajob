<?php

namespace App\Exports;

use App\Models\Log;
use App\Models\Student;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;


class AdminJobinfoSupportExport implements FromView, WithColumnWidths
{
    protected $from;
    protected $to;

    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function columnWidths(): array
    {

        return [
            'A' => 20,
            'B' => 30,
            'C' => 30,
            'D' => 30,
            'E' => 30,
            'F' => 30,
            'G' => 30,
            'H' => 30,
            'I' => 30,
            'J' => 30,
            'K' => 30,
            'L' => 30,
            'M' => 30,
            'N' => 30,
            'O' => 30,
            'P' => 30,
            'Q' => 30,
            'R' => 30,
        ];
    }

    public function view(): View
    {
        $from = $this->from;
        $to = $this->to;

        $contents = DB::table('recommend_reservations')
            ->when($from, function ($query, $from) use ($to) {
                $query->whereBetween('created_at', [$from, $to]);
            })
            ->get();


        foreach ($contents as $list) {

            $student = Student::getStudent($list->account);
            $post = DB::table('board_recommends')->find($list->recommend_id);

            $list->name = $student->name;
            $list->year = $student->year;
            $list->phone_number = $student->phone_number;
            $list->university = $student->university;
            $list->grade = $student->grade;
            $list->gender = $student->gender;
            $list->grade_score = $student->grade_score;
            $list->department = $student->department;
            $list->academic = $student->academic;
            $list->company_name = $post->company_name;
            $list->recruitment_field = $post->recruitment_field;
        }

        $heads = ["번호", "신청일", "채용명", "학번", "이름", "생년월일", "성별", "학과(부)", "학년", "평균학점", "추천채용지원경로", "추천채용지원경로2", "취업동아리여부", "취업동아리", "졸업(예정)일자", "연락처", "e-mail", "출신고교"];

        return view("admin._excel.jobinfo.support.index", ["heads" => $heads, "contents" => $contents, "index" => 1]);
    }

}
