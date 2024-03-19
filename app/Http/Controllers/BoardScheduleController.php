<?php

namespace App\Http\Controllers;

use App\Models\DongaStudent;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\DB;

class BoardScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $lists = [];
        return view('program.schedule.list', [
            'lists' => $lists
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function notice(Request $request)
    {

        if (!$request->date)
            return false;

        $lists = DB::table("board_notices")
            ->where('status_id', 2)
            ->whereBetween('schedule_date', [$request->date, date("Y-m-t", strtotime($request->date))])
            ->get();


        return response()->json([
            'status' => $lists ? 200 : 404,
            'lists' => $lists
        ]);

    }

    public function program(Request $request)
    {

        if (!$request->date)
            return false;


        $date = $request->date;
        $explode_date = explode('-', $date);
        $last_day = date("Y-m-t", strtotime($date));

        $posts = DB::table("board_programs")
            ->where('open', 1)
            ->whereBetween('start_reception_date', [$date, $last_day])
            ->orWhere(function ($query) use ($date, $last_day) {
                $query->whereBetween('end_reception_date', [$date, $last_day]);
            })
            ->get();

        //--- start end 날짜만큼 생성
        $lists = [];

        foreach ($posts as $post) {

            $explode_start = explode('-', $post->start_reception_date);
            $explode_end = explode('-', $post->end_reception_date);

            $year = $explode_start[0];
            $month = $explode_start[1];
            $day = $explode_start[2];


            //--- 넘어온월과 시작월이 다를경우
            if ($explode_date[1] != $month) {
                $year = $explode_date[0];
                $month = $explode_date[1];
            }

            //--- 넘어온월과 마감월이 다를경우
            if ($explode_date[1] != $explode_end[1]) {
                $explode_end[2] = date("t", strtotime($date));
            }

            for ($i = $day; $i <= $explode_end[2]; $i++) {
                $lists[] = [
                    'id' => $post->id,
                    'subject' => $post->subject,
                    'schedule_date' => $year . '-' . $month . '-' . sprintf('%02d', $i),
                    'status_id' => 1,
                ];
            }
        }


        return response()->json([
            'status' => 200,
            'lists' => $lists
        ]);

    }

}
