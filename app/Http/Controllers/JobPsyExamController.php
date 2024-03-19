<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use WorknetMentality;

class JobPsyExamController extends Controller
{
    public $mentality;
    public function __construct()
    {
        $this->mentality = new WorknetMentality();
    }

    public function index(Request $request)
    {
        return view('course.jobpsyexam.list',[
            'mentality' => $this->mentality
        ]);
    }
}
