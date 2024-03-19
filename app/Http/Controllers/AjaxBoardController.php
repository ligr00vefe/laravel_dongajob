<?php

namespace App\Http\Controllers;

use App\Boards\Activity;
use App\Boards\Normal;
use App\Boards\Recommend;
use App\Models\BoardNotice;
use App\Models\BoardReviewBefore;
use App\Models\BoardReviewLatest;
use App\Models\BoardReviewParticipate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class AjaxBoardController extends Controller
{
    public function notice(Request $request): \Illuminate\Http\JsonResponse
    {
        //--- 카테고리 값 안들어오면 빠꾸
        if (!$request->category) {
            return response()->json(['status' => 404]);
        }

        // 게시글 가져오기
        $lists = '';
        $request->view_count = 4;
        $posts = $request->category == '10' ? BoardNotice::full($request) : BoardNotice::ajxaxPaginate($request, $request->category);
        if ($request->mode == 'main') {
            $lists = get_notice_html($posts);
        }


        return response()->json([
            'status' => $lists ? 200 : 406,
            'lists' => $lists
        ]);
    }

    public function review(Request $request): \Illuminate\Http\JsonResponse
    {
        //--- 카테고리 값 안들어오면 빠꾸
        if (!$request->category) {
            return response()->json(['status' => 404]);
        }

        // 게시글 가져오기
        $lists = '';
        $request->view_count = 4;
        if ($request->category == 'reviewlatest' && $posts = BoardReviewLatest::paging($request)) {
            $lists = get_review_html($posts, $request->category);
        } else if ($request->category == 'reviewparticipate' && $posts = BoardReviewParticipate::paging($request)) {
            $lists = get_review_html($posts, $request->category);
        }


        return response()->json([
            'status' => $lists ? 200 : 406,
            'lists' => $lists
        ]);
    }

    public function recommend(Request $request): \Illuminate\Http\JsonResponse
    {

        // 게시글 가져오기
        $posts = DB::table('board_recommends')->orderByDesc('id')->paginate(4);

        $lists = recommend_main_html($posts);


        return response()->json([
            'status' => $lists ? 200 : 406,
            'lists' => $lists
        ]);
    }

    public function jobs(Request $request): \Illuminate\Http\JsonResponse
    {

        $lists = '';

        /* 워크넷 안씀
        $parameter = ['key' => $request->key, 'cnt' => $request->cnt];
        if ($post = get_curl_worknet_data(get_worknet_url($parameter))) {
            $parameter['data'] = simplexml_load_string($post, 'SimpleXMLElement', LIBXML_NOCDATA);
            $lists = get_worknet_html($parameter);
        }*/

        $board = new Normal();
        $request->view_count = 4;
        $posts = $board->normalGet($request);
        $lists = get_normal_html($posts);

        return response()->json([
            'status' => $lists ? 200 : 406,
            'lists' => $lists
        ]);
    }

    public function activity(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->board = new Activity();
        // 게시글 가져오기
        $request->view_count = 4;
        $posts = $this->board->normalGet($request);
        $lists = get_activity_html($posts);


        return response()->json([
            'status' => $lists ? 200 : 406,
            'lists' => $lists
        ]);
    }

    public function setCookie(Request $request) {
        $key = $request->key;
        $time = $request->time;
        Cookie::queue($key, 1, $time);
    }
}
