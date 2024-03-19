<?php
/**
 * Created by PhpStorm.
 * User: Baraem-Dev
 * Date: 2021-11-02
 * Time: 오후 8:43
 */

namespace App\Boards;

use App\Uploads\PickAttachment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class Pick extends Boards
{
    // 테이블명, 필수
    protected string $table = "board_picks";

    // 프론트->백으로 넘어올 input name값. 반드시 디비의 컬럼명과 동일해야함, 필수
    // 여기에 정의 안되면 디비에 안들어감
    protected array $columns = [
        "company_name", "recruitment_field", "work_area", "homepage", "contents",
        "receipt_end_date", "receipt_end_time", "user_id", "hit",
        "attachment1", "attachment2", "attachment3", "attachment4", "attachment5"
    ];

    // updateOrInsert 사용시 찾기 컬럼 정의하는 부분. 발전기금에선 사용안함
    protected array $where = [];

    // 한 페이지에 게시글 몇개가져올지 정의하기. 디폴트 15개
    protected int $paging = 15;

    // 첨부파일이 있을 시 첨부파일 컬럼의 이름 (반드시 input의 name과 동일해야함)
    protected array $attachment = [ "attachment1", "attachment2", "attachment3", "attachment4", "attachment5" ];

    // 리턴 받을 때 사용하는 값
    protected bool $result;

    // 관리자 글 삭제시 회원의 필요 레벨
    protected int $adminDeleteLevel = 10;

    // 페이징
    public function get($request) : object
    {
        return $this->paginate($request);
    }

    // 글 쓰기
    public function write($request) : int
    {
        $this->attachmentTable = new PickAttachment();
            $this->insert($request);
            return $this->getId();
    }

    // 글 수정
    public function update($request) : int
    {
        $this->attachmentTable = new PickAttachment();
            parent::update($request);
            return $this->getId();
    }


    // 관리자 글 삭제
    public function adminDelete($id) : bool
    {
        return parent::adminDelete($id);
    }

    public function normalGet($request)
    {
        $view_count = $request->view_count ?: 10;
        $keyword = $request->keyword ?: '';
        $term = $request->term ?: '';
        $from = $request->input('from') ?? '2010-01-01';
        $to = $request->input('to') ?? '';

        return DB::table($this->table)
            ->when($term, function ($query, $term) use ($keyword) {
                if ($keyword == 'company_name') {
                    return $query->where('company_name', 'like', '%' . $term . '%');
                } else if ($keyword == 'recruitment_field') {
                    return $query->where('recruitment_field', 'like', '%' . $term . '%');
                }
            })
            ->when($to, function ($query, $to) use ($from) {
                return $query->whereDate('receipt_end_date', '>=', $from)->whereDate('receipt_end_date', '<=', $to);
            })->orderByDesc('id')
            ->paginate($view_count);
    }
}
