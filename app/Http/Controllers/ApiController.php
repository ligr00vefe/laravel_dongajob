<?php

namespace App\Http\Controllers;


use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function search(Request $request)
    {
        return Student::isStudentApi($request->snumber, $request->kname);

    }

}
