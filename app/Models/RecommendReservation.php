<?php

namespace App\Models;

use App\Boards\Boards;
use App\Uploads\RecommendReservationAttachment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RecommendReservation extends Boards
{
    protected string $table = "recommend_reservations";

    protected array $columns = [
        'recommend_id', 'account', 'question1', 'question2', 'question3', 'question4', 'question5', 'question6', 'question7', 'question8', 'question9',
        'attachment1', 'attachment2', 'attachment3', 'proof_photo'
    ];

    protected array $attachments = ["proof_photo", "attachment1", "attachment2", "attachment3"];

    // 페이징
    public function get($request): object
    {

        $term = $request->input('term') ?? '';
        $from = $request->input('from') ?? '2021-01-01';
        $to = $request->input('to') ?? '';
        $search = $request->input('search') ?? '';


        return DB::table($this->table)
            ->when($search, function ($query, $search) use ($term) {
                switch ($search) {
                    case 'name':
                        $student_account = []; // 학번이 들어갈 배열

                        // 학생 db에서 검색하려는 이름의 학번 모두 가져오기
                        $search_students = DB::connection('oracle')
                            ->select("SELECT studentcd FROM SHA.jobstudentvw WHERE nm LIKE '%{$term}%'");
                        foreach ($search_students as $list) {
                            $student_account[] = $list->studentcd;
                        }
                        return $query->whereIn('account', $student_account);


                    case 'company_name':
                        $company = [];
                        $posts = DB::table('board_recommends')->where($search, "LIKE", "%{$term}%")->get(); // 기업정보 가져오기


                        foreach ($posts as $list) {
                            $company[] = $list->id;  // 기업의 id값을 배열에 담는다.
                        }


                        return $query->whereIn('recommend_id', $company);  // 담은 id값을 불러온다.
                }


                return $query->where($search, "LIKE", "%{$term}%");
            })
            ->when($to, function ($query, $to) use ($from) {
                return $query->whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to);
            })
            ->paginate(15);
    }

    // 글 쓰기
    public function write($request): int
    {
        $this->attachmentTable = new RecommendReservationAttachment();
        $this->recommendInsert($request);
        return $this->getId();
    }

    // 글 수정
    public function update($request): int
    {
        $this->attachmentTable = new RecommendReservationAttachment();
        parent::recommendUpdate($request);
        return $this->getId();
    }

    public function bring($id = '', $account)
    {
        return DB::table($this->table)
            ->where('account', $account)
            ->when($id, function ($query, $id) {
                return $query->where("recommend_id", $id);
            })
            ->get();
    }


    public function getRecommendAll($request)
    {
        $search = $request->search ?? '';
        $term = $request->term ?? '';

        return DB::table('board_recommends')
            ->leftjoin($this->table, $this->table . '.recommend_id', '=', 'board_recommends.id')
            ->leftjoin('students', 'students.account', '=', $this->table . '.account')
            ->select('board_recommends.*', 'students.name', $this->table . '.account')
            ->when($search, function ($query, $search) use ($term) {
                if ($search == 'recruitment_field') {
                    return $query->where('board_recommends.recruitment_field', 'like', '%' . $term . '%');
                } else if ($search == 'name') {
                    return $query->where('students.name', 'like', '%' . $term . '%');
                } else if ($search == 'account') {
                    return $query->where($this->table . '.account', 'like', '%' . $term . '%');
                }
            })->get();
    }
}
