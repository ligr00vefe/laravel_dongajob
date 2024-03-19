<?php

namespace App\Exports;

use App\Models\Log;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;


class AdminSupportProgramExport implements FromView, WithColumnWidths
{

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
        $contents = DB::table('board_programs')->get();

        $heads = ["번호", "강좌명", "수강장소", "수강인원", "수강일시", "접수일시", "공개여부", "접수상태", "등록날짜"];
        return view("admin._excel.support.program.index", ["heads" => $heads, "contents" => $contents, "index" => 1]);
    }

}
