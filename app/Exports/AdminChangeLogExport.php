<?php

namespace App\Exports;

use App\Models\Log;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class AdminChangeLogExport implements FromView
{
    protected $from;
    protected $to;

    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function view(): View
    {
        $from = $this->from;
        $to = $this->to;

        $contents = DB::table("logs")
            ->where('action', '관리자생성')
            ->orWhere('action', '관리자삭제')
            ->orWhere('action', '관리자수정')
            ->orderByDesc("id")
            ->when($from, function ($query, $from) use ($to) {
                $query->whereBetween('created_at', [$from, $to]);
            })
            ->get();

        $heads = ["번호", "수행업무", "작업자ID(이름)", "대상자ID(이름)","변경전 권한", "변경후 권한", "로그값(출력사유)", "IP", "접속날짜"];
        return view("admin._excel.log.auth.index", ["heads" => $heads, "contents" => $contents, "index" => 1]);
    }

}
