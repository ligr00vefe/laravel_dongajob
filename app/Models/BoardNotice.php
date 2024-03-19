<?php

namespace App\Models;

use App\Uploads\ATTACHMENT;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class BoardNotice extends ATTACHMENT
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status_id',
        'category_id',
        'subject',
        'schedule_date',
        'url',
        'hit',
        'contents',
        'attachment1',
        'attachment2',
        'attachment3',
        'attachment4',
        'attachment5'
    ];

    protected $filenames = ["a", "thumbnail"];
    protected $from = "공지사항";
    protected $uploadPath = "notice";
    protected $exts = [ "jpg", "png", "jpeg", "svg", "gif","pdf", "zip", "docx", "avi", "mp4", "mov", "wmv", "pptx", "hwp", "csv", "txt", "xlsx"];
    protected $upload_path = "notice";

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

    public static function paging($request, $category)
    {
        $view_count = $request->view_count ?: 20;
        $search = $request->search ?? '';
        $term = $request->term ?? '';
        $category = $category != "100" ? $category : ''; //카테고리가 전체이면 모든 데이터를 다불러와야하기때문에 $category 값을 없앤다.
        $from = $request->input('from') ?? '2010-01-01';
        $to = $request->input('to') ?? '';

        return DB::table("board_notices")
            ->when($category, function ($query, $category) {
                return $query->where('category_id', $category);
            })
            ->when($search, function ($query, $search) use ($term) {
                return $query->where($search, "LIKE", "%{$term}%");
            })
            ->when($to, function ($query, $to) use ($from) {
                return $query->whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to);
            })
            ->orderByDesc("status_id")
            ->orderByDesc("id")
            ->paginate($view_count);
    }


    public static function ajxaxPaginate($request, $category)
    {
        $view_count = $request->view_count ?: 20;
        $search = $request->search ?? '';
        $term = $request->term ?? '';
        $category = $category != "100" ? $category : ''; //카테고리가 전체이면 모든 데이터를 다불러와야하기때문에 $category 값을 없앤다.
        $from = $request->input('from') ?? '2010-01-01';
        $to = $request->input('to') ?? '';

        return DB::table("board_notices")
            ->when($category, function ($query, $category) {
                return $query->where('category_id', $category);
            })
            ->when($search, function ($query, $search) use ($term) {
                return $query->where($search, "LIKE", "%{$term}%");
            })
            ->when($to, function ($query, $to) use ($from) {
                return $query->whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to);
            })
            ->orderByDesc("id")
            ->paginate($view_count);
    }


    public static function full($request)
    {
        $view_count = $request->view_count;

        return DB::table("board_notices")
            ->orderByDesc("id")
            ->paginate($view_count);
    }


    public static function get_before_after_post($id)
    {
        $sql1 = DB::table("board_notices")->where(function ($query) use ($id) {
            $query->select('id')
                ->from('board_notices')
                ->where('id', '<', $id)
                ->orderByDesc('id')
                ->first();
        }, 'id')->toSql();


    }
}
