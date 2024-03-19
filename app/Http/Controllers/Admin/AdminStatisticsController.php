<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StatisticsLog;
use App\Models\ViewAdminPermissionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminStatisticsController extends Controller
{

    public function index(Request $request)
    {
        return view("admin.statistics.history.list");
    }


    public function visit(Request $request)
    {

        $now = date('Y-m-d H:i:s');

        $day = [
            StatisticsLog::where(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), date('Y-m-d', strtotime('-6 day')))->count(),
            StatisticsLog::where(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), date('Y-m-d', strtotime('-5 day')))->count(),
            StatisticsLog::where(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), date('Y-m-d', strtotime('-4 day')))->count(),
            StatisticsLog::where(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), date('Y-m-d', strtotime('-3 day')))->count(),
            StatisticsLog::where(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), date('Y-m-d', strtotime('-2 day')))->count(),
            StatisticsLog::where(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), date('Y-m-d', strtotime('+-1 day')))->count(),
            StatisticsLog::where(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), date('Y-m-d'))->count(),
        ];


        $week = [
            StatisticsLog::whereBetween(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'),
                [date('Y-m-d', strtotime('-7 week')), date('Y-m-d', strtotime('-6 week'))])->count(),
            StatisticsLog::whereBetween(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'),
                [date('Y-m-d', strtotime('-6 week')), date('Y-m-d', strtotime('-5 week'))])->count(),
            StatisticsLog::whereBetween(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'),
                [date('Y-m-d', strtotime('54 week')), date('Y-m-d', strtotime('-4 week'))])->count(),
            StatisticsLog::whereBetween(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'),
                [date('Y-m-d', strtotime('-4 week')), date('Y-m-d', strtotime('-3 week'))])->count(),
            StatisticsLog::whereBetween(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'),
                [date('Y-m-d', strtotime('-3 week')), date('Y-m-d', strtotime('-2 week'))])->count(),
            StatisticsLog::whereBetween(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'),
                [date('Y-m-d', strtotime('-2 week')), date('Y-m-d', strtotime('-1 week'))])->count(),
            StatisticsLog::where(DB::raw('YEARWEEK(DATE_FORMAT(created_at, "%Y-%m-%d"))'), date('oW'))->count(),
        ];


        $month = [
            StatisticsLog::where(DB::raw('YEAR(DATE_FORMAT(created_at, "%Y-%m-%d"))'), date('Y', strtotime($now . "-6 month")))
                ->where(DB::raw('MONTH(DATE_FORMAT(created_at, "%Y-%m-%d"))'), date('m', strtotime($now . "-6 month")))->count(),
            StatisticsLog::where(DB::raw('YEAR(DATE_FORMAT(created_at, "%Y-%m-%d"))'), date('Y', strtotime($now . "-5 month")))
                ->where(DB::raw('MONTH(DATE_FORMAT(created_at, "%Y-%m-%d"))'), date('m', strtotime($now . "-5 month")))->count(),
            StatisticsLog::where(DB::raw('YEAR(DATE_FORMAT(created_at, "%Y-%m-%d"))'), date('Y', strtotime($now . "-4 month")))
                ->where(DB::raw('MONTH(DATE_FORMAT(created_at, "%Y-%m-%d"))'), date('m', strtotime($now . "-4 month")))->count(),
            StatisticsLog::where(DB::raw('YEAR(DATE_FORMAT(created_at, "%Y-%m-%d"))'), date('Y', strtotime($now . "-3 month")))
                ->where(DB::raw('MONTH(DATE_FORMAT(created_at, "%Y-%m-%d"))'), date('m', strtotime($now . "-3 month")))->count(),
            StatisticsLog::where(DB::raw('YEAR(DATE_FORMAT(created_at, "%Y-%m-%d"))'), date('Y', strtotime($now . "-2 month")))
                ->where(DB::raw('MONTH(DATE_FORMAT(created_at, "%Y-%m-%d"))'), date('m', strtotime($now . "-2 month")))->count(),
            StatisticsLog::where(DB::raw('YEAR(DATE_FORMAT(created_at, "%Y-%m-%d"))'), date('Y', strtotime($now . "-1 month")))
                ->where(DB::raw('MONTH(DATE_FORMAT(created_at, "%Y-%m-%d"))'), date('m', strtotime($now . "-1 month")))->count(),
            StatisticsLog::where(DB::raw('YEAR(DATE_FORMAT(created_at, "%Y-%m-%d"))'), date('Y'))
                ->where(DB::raw('MONTH(DATE_FORMAT(created_at, "%Y-%m-%d"))'), date('m'))->count(),
        ];


        return response()->json([
            'day' => $day,
            'week' => $week,
            'month' => $month
        ]);
    }

    public function board(Request $request)
    {
        $now = date('Y-m-d H:i:s');


        $tables = [
            'board_review_befores',
            'board_review_latests',
            'board_review_participates'
        ];


        $day = [];
        $week = [];
        $month = [];

        for ($i = 0, $iMax = count($tables); $i < $iMax; $i++) {

            $day[$i] = [
                DB::table($tables[$i])->where(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), date('Y-m-d', strtotime('-6 day')))->count(),
                DB::table($tables[$i])->where(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), date('Y-m-d', strtotime('-5 day')))->count(),
                DB::table($tables[$i])->where(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), date('Y-m-d', strtotime('-4 day')))->count(),
                DB::table($tables[$i])->where(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), date('Y-m-d', strtotime('-3 day')))->count(),
                DB::table($tables[$i])->where(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), date('Y-m-d', strtotime('-2 day')))->count(),
                DB::table($tables[$i])->where(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), date('Y-m-d', strtotime('+-1 day')))->count(),
                DB::table($tables[$i])->where(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), date('Y-m-d'))->count(),
            ];


            $week[$i] = [
                DB::table($tables[$i])->whereBetween(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [date('Y-m-d', strtotime('-7 week')), date('Y-m-d', strtotime('-6 week'))])->count(),
                DB::table($tables[$i])->whereBetween(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [date('Y-m-d', strtotime('-6 week')), date('Y-m-d', strtotime('-5 week'))])->count(),
                DB::table($tables[$i])->whereBetween(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [date('Y-m-d', strtotime('54 week')), date('Y-m-d', strtotime('-4 week'))])->count(),
                DB::table($tables[$i])->whereBetween(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [date('Y-m-d', strtotime('-4 week')), date('Y-m-d', strtotime('-3 week'))])->count(),
                DB::table($tables[$i])->whereBetween(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [date('Y-m-d', strtotime('-3 week')), date('Y-m-d', strtotime('-2 week'))])->count(),
                DB::table($tables[$i])->whereBetween(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [date('Y-m-d', strtotime('-2 week')), date('Y-m-d', strtotime('-1 week'))])->count(),
                DB::table($tables[$i])->where(DB::raw('YEARWEEK(DATE_FORMAT(created_at, "%Y-%m-%d"))'), date('oW'))->count(),
            ];


            $month[$i] = [
                DB::table($tables[$i])->where(DB::raw('YEAR(DATE_FORMAT(created_at, "%Y-%m-%d"))'), date('Y', strtotime($now . "-6 month")))->where(DB::raw('MONTH(DATE_FORMAT(created_at, "%Y-%m-%d"))'), date('m', strtotime($now . "-6 month")))->count(),
                DB::table($tables[$i])->where(DB::raw('YEAR(DATE_FORMAT(created_at, "%Y-%m-%d"))'), date('Y', strtotime($now . "-5 month")))->where(DB::raw('MONTH(DATE_FORMAT(created_at, "%Y-%m-%d"))'), date('m', strtotime($now . "-5 month")))->count(),
                DB::table($tables[$i])->where(DB::raw('YEAR(DATE_FORMAT(created_at, "%Y-%m-%d"))'), date('Y', strtotime($now . "-4 month")))->where(DB::raw('MONTH(DATE_FORMAT(created_at, "%Y-%m-%d"))'), date('m', strtotime($now . "-4 month")))->count(),
                DB::table($tables[$i])->where(DB::raw('YEAR(DATE_FORMAT(created_at, "%Y-%m-%d"))'), date('Y', strtotime($now . "-3 month")))->where(DB::raw('MONTH(DATE_FORMAT(created_at, "%Y-%m-%d"))'), date('m', strtotime($now . "-3 month")))->count(),
                DB::table($tables[$i])->where(DB::raw('YEAR(DATE_FORMAT(created_at, "%Y-%m-%d"))'), date('Y', strtotime($now . "-2 month")))->where(DB::raw('MONTH(DATE_FORMAT(created_at, "%Y-%m-%d"))'), date('m', strtotime($now . "-2 month")))->count(),
                DB::table($tables[$i])->where(DB::raw('YEAR(DATE_FORMAT(created_at, "%Y-%m-%d"))'), date('Y', strtotime($now . "-1 month")))->where(DB::raw('MONTH(DATE_FORMAT(created_at, "%Y-%m-%d"))'), date('m', strtotime($now . "-1 month")))->count(),
                DB::table($tables[$i])->where(DB::raw('YEAR(DATE_FORMAT(created_at, "%Y-%m-%d"))'), date('Y'))->where(DB::raw('MONTH(DATE_FORMAT(created_at, "%Y-%m-%d"))'), date('m'))->count(),
            ];
        }

        return response()->json([
            'day' => $day,
            'week' => $week,
            'month' => $month
        ]);


    }


}
