<?php

namespace App\Exports;

use App\Models\Log;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class AdminConnectLogExport implements FromView, WithColumnWidths
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
        $from = $this->from;
        $to = $this->to;

        $contents = DB::table("logs")
            ->orderByDesc("id")
            ->where('action', '!=', '관리자생성')
            ->where('action', '!=', '관리자삭제')
            ->where('action', '!=', '엑셀내역다운로드')
            ->when($from, function ($query, $from) use ($to) {
                $query->whereBetween('created_at', [$from, $to]);
            })
            ->get();

        $heads = ["번호", "수행업무", "관리자ID(이름)", "처리한 정보주체", "로그값(출력사유)", "IP", "접속날짜"];
        return view("admin._excel.log.auth.index", ["heads" => $heads, "contents" => $contents, "index" => 1]);
    }

}
