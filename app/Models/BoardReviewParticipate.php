<?php

namespace App\Models;

use App\Uploads\ATTACHMENT;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BoardReviewParticipate extends ATTACHMENT
{
    use HasFactory;

    protected $fillable = [
        'status_id',
        "subject",
        "contents",
        "account",
        "user_type",
        "hit",
        "attachment1",
        "attachment2"
    ];

    protected $filenames = ["a", "thumbnail"];
    protected $from = "reviewparticipate";
    protected $uploadPath = "reviewparticipate";
    protected $exts = [ "jpg", "png", "jpeg", "svg", "gif","pdf", "zip", "docx", "avi", "mp4", "mov", "wmv", "pptx", "hwp", "csv", "txt", "xlsx"];
    protected $upload_path = "reviewparticipate";

    public function set($request)
    {

        if (!$request->file())
            return false;

        if (!$upload = $this->execute($request)) {
            return back()->with("error", msg_collection('access_impossible'));
        }

        $return = [];
        for ($i = 1; $i <= 2; $i++) {
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


        return DB::table("board_review_participates")
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
            ->orderByDesc("status_id")
            ->orderByDesc("id")
            ->paginate($view_count);
    }


    public static function get_before_after_post($id)
    {
        $sql1 = DB::table("board_review_participate")->where(function ($query) use ($id) {
            $query->select('id')
                ->from('board_review_participate')
                ->where('id', '<', $id)
                ->orderByDesc('id')
                ->first();
        }, 'id')->toSql();

        dd($sql1);

    }
}
