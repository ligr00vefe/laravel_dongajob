<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use WorknetMentality;

class JobGuideController extends Controller
{
    public function index(Request $request)
    {
        return view('course.guide.list');
    }
}
