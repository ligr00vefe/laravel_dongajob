<?php

namespace App\Http\Controllers\Admin;


use App\Boards\Recommend;
use App\Http\Controllers\Controller;
use App\Models\BoardCategory;
use App\Models\RecommendReservation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use StudentAlimi;

class AdminBoardRecommendController extends Controller
{
    protected Recommend $board;
    protected BoardCategory $boardCategory;
    protected $menu_id;

    public function __construct(Request $request)
    {
        $this->board = new Recommend();
        $this->boardCategory = new BoardCategory();
        $this->menu_id = array_search('채용정보', get_admin_menu_list(), true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 게시글 가져오기
        $lists = $this->board->normalGet($request);

        $search = [
            'keyword' => $request->keyword,
            'term' => $request->term
        ];

        return View('admin.jobinfo.recommend.list', [
            "lists" => $lists,
            'search' => $search
        ]);
    }

    public function view($id)
    {
        $list = DB::table('board_recommends')
            ->where("id", "=", $id)
            ->first();

        $result = DB::table('board_recommends')->where("id", $id)
            ->increment('hit', 1);

        return View('admin.jobinfo.recommend.view', ['list' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('admin.jobinfo.recommend.create');
    }


    public function store(Request $request)
    {
        $categories = $request->alimi_category;


        if (!$request->contents)
            return back()->with("error", msg_collection('empty_content'));

        $request->contents = addslashes($request->contents);
        $write = $this->board->write($request);


        if ($write) {

            if ($categories) {
                foreach ($categories as $category) {
                    $this->boardCategory->setData($this->menu_id, $write, $category);
                }
            }

            return redirect()->route("admin.jobinfo.recommend.index")->with("success", msg_collection('success_enrollment'));
        }

        return back()->with("error", msg_collection('error_enrollment'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->boardCategory->arrConverter($this->menu_id, $id);
        $list = $this->board->find($id);

        $original_names = [];
        for ($i = 1; $i <= 5; $i++) {
            $property = 'attachment' . $i;
            if (!$list->$property)
                continue;

            $original_names[$i] = DB::table("attachments")->where("id", $list->$property)->first()->original_name;
        }

        return view("admin.jobinfo.recommend.create", [
            "list" => $list,
            "original_names" => $original_names,
            "category" => $category
        ]);
    }


    public function update(Request $request)
    {
        $id = $request->id;
        $request->contentts = addslashes($request->contents);
        $update = $this->board->update($request);

        if ($update) {

            //--- 카테고리 저장 (모두 삭제하고 다시 insert 한다.)
            $categories = $request->alimi_category;
            $this->boardCategory->deleteData($this->menu_id, $id);

            if ($categories) {
                foreach ($categories as $category) {
                    $this->boardCategory->setData($this->menu_id, $id, $category);
                }
            }

            return redirect()->route("admin.jobinfo.recommend.index")->with("success", msg_collection('success_correction'));
        }

        return back()->with("error", msg_collection('error_enrollment'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    // 개별 삭제
    public function destroy(Request $request)
    {
        $id = $request->id;


        if (isset($id)) {

            //--- 지원자가 있다면 삭제 방지
            if (DB::table('recommend_reservations')->where('recommend_id', $id)->exists()) {
                return back()->with('error', msg_collection('failure_already_recommend'));
            }



            $delete = $this->board->delete($id);

            if ($delete) {
                return redirect()->route("admin.jobinfo.recommend.index")->with("success", msg_collection('success_remove'));
            } else {
                return back()->with("error", msg_collection('failure_remove'));
            }
        }

        return back()->with("error", msg_collection('none_post'));
    }

    // 선택 삭제
    public function destroyAll(Request $request)
    {
        $chk = false;
        foreach ($request->chk as $id) {

            //--- 지원자가 있다면 삭제 방지
            if (DB::table('recommend_reservations')->where('recommend_id', $id)->exists()) {
                $post = DB::table('board_recommends')->select('company_name')->find($id);
                return back()->with('error', $post->company_name . ' ' . msg_collection('failure_already_recommend'));
            }

            $delete = $this->board->delete($id);

            if ($delete)
                $chk = true;
            else {
                $chk = false;
                break;
            }
        }

        if ($chk)
            return redirect()->route("admin.jobinfo.recommend.index")->with("success", "정상적으로 삭제되었습니다.");

        return back()->with("error", "삭제하는데 실패하였습니다. 다시 시도해 주세요.");
    }

}
