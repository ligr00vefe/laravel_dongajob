<?php

use App\Http\Controllers\EmploymentController;
use App\Http\Controllers\JobSrchController;
use App\Http\Controllers\MajorSrchController;
use App\Http\Controllers\JobPsyExamController;
use App\Http\Controllers\JobGuideController;

/*채용정보*/
Route::get('/course/employment', [EmploymentController::class, 'index']);
Route::post('/course/employment', [EmploymentController::class, 'index']);
Route::get('/course/employment/{id}/view', [EmploymentController::class, 'view']);

Route::get('/ajax/course/employment/area', [EmploymentController::class, 'getArea']);
Route::get('/ajax/course/employment/job', [EmploymentController::class, 'getJob']);



/*직업정보*/
Route::get('/course/jobsrch', [JobSrchController::class, 'index']);
Route::get('/course/jobsrch/{id}/view', [JobSrchController::class, 'view']);

Route::get('/ajax/course/jobsrch/category', [JobSrchController::class, 'getCategory']);



/*학과정보*/
Route::get('/course/majorsrch', [MajorSrchController::class, 'index']);


/*직무별 자소서 가이드*/
Route::get('/course/guide', [JobGuideController::class, 'index']);
/*링크연결*/


/*직업심리검사*/
Route::get('/course/jobpsyexam', [JobPsyExamController::class, 'index']);

