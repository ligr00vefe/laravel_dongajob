<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use WorknetJobInfo;

class JobSrchController extends Controller
{
    protected WorknetJobInfo $worknetJobInfo;

    public function __construct()
    {
        $this->worknetJobInfo = new WorknetJobInfo();
    }

    public function index(Request $request)
    {
        $page = $request->page ?: 1;
        $keyword = $request->keyword ?: '';
        $first_category = $request->firstCategory ?: 0;
        $second_category = $request->secondCategory ?: 0;

        $list = $this->worknetJobInfo->getList($page, $keyword, $second_category);



        return view('course.jobsrch.list', [
            'post' => $list,
            'page' => $page,
            'keyword' => $keyword,
            'first_category_list' => $this->worknetJobInfo->firstCategoryList(),
            'second_category_list' => $this->worknetJobInfo->secondCategoryList($first_category),
            'first_category' => $first_category,
            'second_category' => $second_category,
        ]);
    }

    public function view(Request $request)
    {
        $id = $request->id;
        $page = $request->page ?: 1;

        if (!$post = $this->worknetJobInfo->getDetailList($id)) {
            return back()->with("error", msg_collection('none_post'));
        }



        return view('course.jobsrch.view', [
            'post' => $post,
            'page' => $page
        ]);
    }

    public function getCategory(Request $request)
    {
        return response()->json([
            'lists' => $this->worknetJobInfo->secondCategoryList($request->id)
        ]);
    }

}
