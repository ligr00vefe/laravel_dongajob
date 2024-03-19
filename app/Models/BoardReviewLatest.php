<?php

namespace App\Models;

use App\Uploads\ATTACHMENT;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BoardReviewLatest extends ATTACHMENT
{
    use HasFactory;

    protected $fillable = [
        "subject",
        "contents",
        "account",
        "user_type",
        "hit",
        "attachment1",
        "attachment2",
        "attachment3",
        "attachment4",
        "attachment5"
    ];

    protected $filenames = ["a", "thumbnail"];
    protected $from = "reviewLatest";
    protected $uploadPath = "reviewLatest";
    protected $exts = ["jpg", "png", "jpeg", "svg", "gif", "pdf", "zip", "docx", "avi", "mp4", "mov", "wmv", "pptx", "hwp", "csv", "txt", "xlsx"];
    protected $upload_path = "reviewLatest";

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

    public function execute($request)
    {
        return $this->upload($request);
    }

    public static function paging($request)
    {
        $view_count = $request->view_count ?: 10;
        $search = $request->search ?? '';
        $term = $request->term ?? '';



        return DB::table("board_review_latests")
            ->when($search, function ($query, $search) use ($term) {

                $col = '';
                $student_account = [];


                if ($search == 'name') $col = 'nm';
                else if ($search == 'major') $col = 'dept';

                if ($col) {
                    $search_students = DB::connection('oracle')
                        ->select("SELECT studentcd FROM SHA.jobstudentvw WHERE {$col} LIKE '%{$term}%'");



                    foreach ($search_students as $list) {
                        $student_account[] = $list->studentcd;
                    }
                    return $query->whereIn('account', $student_account);
                }

                return $query->where($search, "LIKE", "%{$term}%");


            })
            ->orderByDesc("id")
            ->paginate($view_count);
    }

    //--- 조회수 증가
    public function hitUp($id): void
    {
        DB::table($this->table)->where("id", $id)->increment('hit', 1);
    }

    public static function get_before_after_post($id)
    {


        $sql1 = DB::table("board_review_latests")->where(function ($query) use ($id) {
            $query->select('id')
                ->from('board_review_latests')
                ->where('id', '<', $id)
                ->orderByDesc('id')
                ->first();
        }, 'id')->toSql();


    }
}
