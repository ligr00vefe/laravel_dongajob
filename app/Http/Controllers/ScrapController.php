<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ScrapController extends Controller
{
    public function scrap(Request $request)
    {

        //--- 로그인 되지 않았을 때
        if (!session()->get('login_check')) {
            return response()->json([
                'status' => 404,
                'msg' => msg_collection('failure_login')
            ]);
        }

        //--- url 이 들어오지 않았을 때
        if (!$request->board_id || !$request->board_title || !$request->subject) {
            return response()->json([
                'status' => 404,
                'msg' => msg_collection('error_enrollment')
            ]);
        }

        //--- 관리자는 안됨
        if (is_manager_check(session()->get('donga_type'))) {
            return response()->json([
                'status' => 404,
                'msg' => '관리자는 사용이 불가합니다. \n학생계정으로 이용바랍니다'
            ]);
        }


        $result = false;
        $account = session()->get('account');

        $kinds = 'insert';
        $msg = msg_collection('add_scrap');

        //--- 스크랩 데이터가 있으면 내역 삭제
        if ($delete = DB::table('scrap_lists')->where('account', $account)->where('board_id', $request->board_id)->where('board_title', $request->board_title)->first()) {



            $kinds = 'delete';
            if (DB::table('scrap_lists')->where('account', $account)->where('board_id', $request->board_id)->exists()) {
                $result = true;

                if($request->mode == 'delete') {
                    DB::table('scrap_lists')->where('account', $account)->where('board_id', $request->board_id)->delete();
                    $msg = msg_collection('remove_scrap');
                } else {
                    $msg = msg_collection('remove_scrap_confirm');
                    $kinds = 'confirm';
                }


            } else {
                $result = false;
                $msg = msg_collection('error_enrollment');
            }

            //--- 등록
        } else {

            $result = DB::table("scrap_lists")
                ->insertGetId([
                    "account" => $account,
                    "board_id" => $request->board_id,
                    "board_title" => $request->board_title,
                    'subject' => $request->subject,
                    "url" => $request->url,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]);


        }


        return response()->json([
            'status' => $result ? 200 : 404,
            'kinds' => $kinds,
            'msg' => $result ? $msg : '',
        ]);

    }
}
