<?php
/**
 * Created by PhpStorm.
 * User: Baraem-Dev
 * Date: 2021-11-02
 * Time: 오후 8:43
 */

namespace App\Boards;

use App\Uploads\ATTACHMENT;
use App\Uploads\ReviewBeforeAttachment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class ReviewBefore extends Boards
{
    // 테이블명, 필수
    protected string $table = "board_review_befores";

    // 프론트->백으로 넘어올 input name값. 반드시 디비의 컬럼명과 동일해야함, 필수
    // 여기에 정의 안되면 디비에 안들어감
    protected array $columns = [
        "subject",
        "content",
        "account",
        "user_type",
        "attachment1",
        "attachment2",
        "attachment3",
        "attachment4",
        "attachment5"
    ];

    // updateOrInsert 사용시 찾기 컬럼 정의하는 부분. 발전기금에선 사용안함
    protected array $where = [];

    // 한 페이지에 게시글 몇개가져올지 정의하기. 디폴트 15개
    protected int $paging = 15;

    // 첨부파일이 있을 시 첨부파일 컬럼의 이름 (반드시 input의 name과 동일해야함)
    protected array $attachments = [ "attachment1", "attachment2", "attachment3", "attachment4", "attachment5" ];

    // 리턴 받을 때 사용하는 값
    protected bool $result;

    // 관리자 글 삭제시 회원의 필요 레벨
    protected int $adminDeleteLevel = 10;
    // 페이징
    public static function paging($request)
    {

        $search = $request->search ?? '';
        $term = $request->term ?? '';

        return DB::table("board_review_befores")
            ->when($search, function ($query, $search) use ($term) {
                return $query->where($search, "LIKE", "%{$term}%");
            })
            ->orderByDesc("id")
            ->paginate(10);
    }
    public function set($request)
    {
        if (!$request->file())
            return false;

        if (!$upload = $this->execute($request)) {
            return back()->with("error", msg_collection('access_impossible'));
        }

        $return = [];
        for ($i = 1; $i <= 5; $i++) {
            $attachment = $upload['success']['attachment' . $i]['id'] ?? false;

            if ($attachment) {
                $return['attachment' . $i] = $attachment;
            }
        }

        return $return;
    }

    public function get($request) : object
    {
        return $this->paginate($request);
    }


    // 관리자 글 삭제
    public function adminDelete($id) : bool
    {
        return parent::adminDelete($id);
    }

    public static function get_before_after_post($id)
    {
        $sql1 = DB::table("board_review_befores")->where(function ($query) use ($id) {
            $query->select('id')
                ->from('board_review_befores')
                ->where('id', '<', $id)
                ->orderByDesc('id')
                ->first();
        }, 'id')->toSql();

        dd($sql1);

    }
}
