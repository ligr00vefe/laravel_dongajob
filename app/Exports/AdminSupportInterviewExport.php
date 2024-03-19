<?php

namespace App\Exports;

use App\Models\Log;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;


class AdminSupportInterviewExport implements FromView, WithColumnWidths
{

    public function columnWidths(): array
    {

        return [
            'A' => 20,
            'B' => 30,
            'C' => 30,
            'D' => 40,
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
        $contents = DB::table('board_interviews')->get();

        $heads = ["번호", "이름", "학번", "지원기업", "지원구분", "지원사업부","상태", "접속날짜"];
        return view("admin._excel.support.interview.index", ["heads" => $heads, "contents" => $contents, "index" => 1]);
    }

}
