<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Masor;

class MajorSrchController extends Controller
{
    private Masor $major;

    public function __construct()
    {
        $this->major = new Masor();
    }

    public function index(Request $request)
    {
        $page = $request->page ?: 1;
        $keyword = $request->keyword ?: '';
        $lists = $this->major->getMajor($page, $keyword);

        return view('course.majorsrch.list', [
            'lists' => $lists,
            'major' => $this->major,
            'page' => $page,
            'keyword' => $keyword
        ]);
    }
}
