<?php

namespace App\Exports;

use App\Models\Log;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;


class AdminJobinfoPickExport implements FromView, WithColumnWidths
{

    public function columnWidths(): array
    {

        return [
            'A' => 20,
            'B' => 30,
            'C' => 30,
            'D' => 80,
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
        $contents = DB::table('board_picks')->get();

        $heads = ["번호", "기업명", "채용공고", "근무지역", "접수마감일", "등록날짜"];
        return view("admin._excel.jobinfo.pick.index", ["heads" => $heads, "contents" => $contents, "index" => 1]);
    }

}
