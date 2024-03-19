<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Log;
use Illuminate\Http\Request;

class AdminLogController extends Controller
{

    public function index(Request $request)
    {
        $lists = Log::paging($request);

        return view("admin.log.auth.index", [
            "lists" => $lists ?? [],
            'category' => $request->category ?? '',
            'from' => $request->from ?? '',
            'to' => $request->to ?? ''
        ]);
    }
}
