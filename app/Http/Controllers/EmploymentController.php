<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmploymentController extends Controller
{
    public function index(Request $request)
    {
        $view_cnt = $request->get('view_count') ?: 10;
        $page = $request->get('page') ?: 1;

        $occupation = '';
        if (isset($request->occupation)) {
            for ($i = 0; $i <= 2; $i++) {

                if (!$request->occupation[$i])
                    continue;

                $occupation .= '|' . $request->occupation[$i];
            }
        }

        $education = '';
        if (isset($request->education)) {
            for ($i = 0; $i < count($request->education); $i++) {

                if (!$request->education[$i])
                    continue;

                $occupation .= '|' . $request->education[$i];
            }
        }

        $pref = '';
        if (isset($request->pref)) {
            for ($i = 0; $i < count($request->pref); $i++) {

                if (!$request->pref[$i])
                    continue;

                $pref .= '|' . $request->pref[$i];
            }
        }

        $lists = '';
        $parameter = [
            'key' => 'employment',
            'params' => [
                'region' => $request->secondArea ?: '',
                'occupation' => $occupation,
                'salTp' => $request->salTp ?: '',
                'minPay' => $request->minPay ?: '',
                'maxPay' => $request->minpay ?: '',
                'education' => $education ?: '',
                'prefCd' => $request->prefCd ?: '',
                'pref' => $pref ?: '',
                'regDt' => $request->regDt ?: '',
                'career' => $request->career ?: '',
                'minCareerM' => $request->minCareerM ?: '',
                'maxCareerM' => $request->maxCareerM ?: '',
                'closeDt' => $request->closeDt ?: '',
                'regDate' => $request->regDate ?: '',
                'keyword' => $request->keyword ?: '',
                'display' => $view_cnt,
                'startPage' => $page
            ]
        ];

        if ($post = get_curl_worknet_data(get_worknet_url($parameter))) {
            $parameter['data'] = simplexml_load_string($post, 'SimpleXMLElement', LIBXML_NOCDATA);
            $lists = $parameter['data'];
        }

        return view('course.employment.list', [
            'lists' => $lists,
            'total' => $lists->total,
            'page' => $page,
            'view_count' => $view_cnt,
            'params' => [
                'firstArea' => $request->firstArea ?: '',
                'secondArea' => $request->secondArea ?: '',
                'firstJob' => $request->firstJob ?: '',
                'secondJob' => $request->secondJob ?: '',
                'thirdJob' => $request->thirdJob ?: '',
                'salTp' => $request->salTp ?: '',
                'minPay' => $request->minPay ?: '',
                'maxPay' => $request->minpay ?: '',
                'education' => $request->education ?: '',
                'prefCd' => $request->prefCd ?: '',
                'pref' => $request->pref ?: '',
                'career' => $request->career ?: '',
                'regDt' => $request->regDt ?: '',
                'minCareerM' => $request->minCareerM ?: '',
                'maxCareerM' => $request->maxCareerM ?: '',
                'closeDt' => $request->closeDt ?: '',
                'regDate' => $request->regDate ?: '',
                'keyword' => $request->keyword ?: '',
            ]
        ]);


    }

    public function getArea(Request $request)
    {

        $posts = get_worknet_second_area($request->key);
        $lists = get_worknet_second_html($posts);

        return response()->json([
            'status' => $lists ? 200 : 404,
            'lists' => $lists
        ]);

    }

    public function getJob(Request $request)
    {

        if ($request->level == 2) {
            $posts = get_workent_second_job_code($request->key);
        } else if ($request->level = 3) {
            $posts = get_workent_third_job_code($request->key);
        }


        $lists = get_worknet_second_html($posts);

        return response()->json([
            'status' => $lists ? 200 : 404,
            'lists' => $lists
        ]);

    }

    public function search(Request $request)
    {


    }

    public function view($id)
    {
        $list = '';
        if ($post = get_curl_worknet_data(get_worknet_detail_url($id))) {
            $list = simplexml_load_string($post, 'SimpleXMLElement', LIBXML_NOCDATA);
        }

        if($list->messageCd) {
            return back()->with("error", msg_collection('none_post'));
        }


        return view('course.employment.view', [
            'list' => $list
        ]);
    }
}
