<?php

namespace App\Http\Controllers;

use App\Models\RecommendReservation;
use Illuminate\Http\Request;

class RecommendReservationController extends Controller
{
    protected RecommendReservation $board;

    public function __construct(Request $request)
    {
        $this->board = new RecommendReservation();
    }


    public function store(Reqeust $request)
    {
        $write = $this->board->write($request);

        if ($write) {
            return redirect("/jobinfo/recommend")->with("msg", msg_collection('success_enrollment'));
        } else {
            return back()->with("error", msg_collection('error_enrollment'));
        }
    }
}
