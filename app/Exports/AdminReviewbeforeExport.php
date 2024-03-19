<?php

namespace App\Exports;

use App\Models\Log;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;


class AdminReviewbeforeExport implements FromView, WithColumnWidths
{

    public function columnWidths(): array
    {


        return [
            'A' => 15,
            'B' => 15,
            'C' => 15,
            'D' => 15,
            'E' => 40,
            'F' => 150,
            'G' => 20,
        ];
    }

    public function view(): View
    {
        $contents =  DB::table("board_review_befores")->get();

        $heads = ["번호", "학번", "이름", "학과(부)", "제목", "내용", "작성일"];
        return view("admin._excel.archive.reviewbefore", ["heads" => $heads, "contents" => $contents, "index" => 1]);
    }

}
