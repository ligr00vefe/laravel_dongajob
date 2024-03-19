<?php

namespace App\Boards;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class Boards
{
    protected string $table;
    protected array $columns, $where, $attachments;
    protected bool $result;
    protected int $paging = 15;
    protected $attachmentTable;
    protected int $adminDeleteLevel = 10;
    protected int $offset;
    protected array $notIn = [];
    private int $id;


    // 대량할당 방지
    private array $continue = [
        "subject", "content", "hit"
    ];

    public function getId()
    {
        return $this->id;
    }

    public function paginate($request): object
    {
        $category = $request->input("category") ?? false;
        $keyword = $request->input("term") ?? false;
        $page = $request->input("page") ?? 1;
        $from = $request->input('from') ?? '2010-01-01';
        $to = $request->input('to') ?? '';
        $board = $request->input('board') ?? '';
        $offset = $this->offset ?? false;

        $query = DB::table($this->table)
            ->when($category, function ($query, $category) {
                return $query->where("category", "like", "%{$category}%");
            })
            ->when($keyword, function ($query, $keyword) {
                return $query->whereRaw("(title like ? or contents like ? or subtitle like ?)", ["%{$keyword}%", "%{$keyword}%", "%{$keyword}%"]);
            })
            ->when($to, function ($query, $to) use ($from, $board) {
                switch ($board) {
                    case 'normal': // 일반채용관리
                        return $query->whereDate('receipt_start_time', '>=', $from)->whereDate('receipt_start_time', '<=', $to);
                        break;
                    default:
                        return $query->whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to);
                }


            });

        $return = new \stdClass();

        $return->paging = $query->count();

        if (count($this->notIn) > 0) {
            $query->whereNotin("id", $this->notIn);
        }

        $return->lists = $query->orderByDesc("id")->paginate($this->paging) ?? false;

        return $return;
    }

    public function interviewInsert($request): int
    {
        $params = [];
        foreach ($this->columns as $column) {
            $params[$column] = $request->input($column) ?? null;
        }
        $params['created_at'] = Now();
        $params['updated_at'] = Now();

        $this->id = DB::table($this->table)
            ->insertGetId($params);

        return $this->id;
    }


    public function insert($request): int
    {
        $params = [];
        foreach ($this->columns as $column) {
            $params[$column] = $request->input($column) ?? null;
        }

        $attachment_id = $this->attachmentTable->set($request);

        $params["user_id"] = Auth::id() ?? 1;
        $params["attachment1"] = $attachment_id['attachment1'] ?? null;
        $params["attachment2"] = $attachment_id['attachment2'] ?? null;
        $params["attachment3"] = $attachment_id['attachment3'] ?? null;
        $params["attachment4"] = $attachment_id['attachment4'] ?? null;
        $params["attachment5"] = $attachment_id['attachment5'] ?? null;

        $params['contents'] = addslashes($params['contents']);
        $this->id = DB::table($this->table)
            ->insertGetId($params);

        return $this->id;
    }

    public function recommendInsert($request): int
    {
        $params = [];
        foreach ($this->columns as $column) {
            $params[$column] = $request->input($column) ?? null;
        }

        $attachment_id = $this->attachmentTable->set($request);

        $params["account"] = session()->get('account');
        $params["attachment1"] = $attachment_id['attachment1'] ?? null;
        $params["attachment2"] = $attachment_id['attachment2'] ?? null;
        $params["attachment3"] = $attachment_id['attachment3'] ?? null;
        $params["proof_photo"] = $attachment_id['proof_photo'] ?? null;


        $params['created_at'] = \Carbon\Carbon::now();
        $params['updated_at'] = \Carbon\Carbon::now();
        if (array_key_exists('contents', $params)) {
            $params['contents'] = addslashes($params['contents']);
        }
        $this->id = DB::table($this->table)
            ->insertGetId($params);

        return $this->id;
    }

    public function update($request): int
    {
        $this->id = (int)$request->input("id");
        $params = [];
        foreach ($this->columns as $column) {
            if (in_array($column, $this->continue)) continue;
            if (!$request->input($column)) continue;
            $params[$column] = $request->input($column);
        }

        $thumbnail_id = $this->attachmentTable->set($request);

        if ($thumbnail_id) {
            if (array_key_exists('attachment1', $thumbnail_id)) {
                $params['attachment1'] = $thumbnail_id['attachment1'];
            }
            if (array_key_exists('attachment2', $thumbnail_id)) {
                $params['attachment2'] = $thumbnail_id['attachment2'];
            }
            if (array_key_exists('attachment3', $thumbnail_id)) {
                $params['attachment3'] = $thumbnail_id['attachment3'];
            }
            if (array_key_exists('attachment4', $thumbnail_id)) {
                $params['attachment4'] = $thumbnail_id['attachment4'];
            }
            if (array_key_exists('attachment5', $thumbnail_id)) {
                $params['attachment5'] = $thumbnail_id['attachment5'];
            }
        }


        $this->result = DB::table($this->table)
            ->where("id", $this->id)
            ->update($params);

        return $this->result ? $this->id : 0;
    }


    public function recommendUpdate($request): int
    {
        $this->id = (int)$request->input("id");
        $params = [];
        foreach ($this->columns as $column) {
            if (in_array($column, $this->continue)) continue;
            if (!$request->input($column)) continue;
            $params[$column] = $request->input($column);
        }

        $thumbnail_id = $this->attachmentTable->set($request);

        if ($thumbnail_id) {
            if (array_key_exists('attachment1', $thumbnail_id)) {
                $params['attachment1'] = $thumbnail_id['attachment1'];
            }
            if (array_key_exists('attachment2', $thumbnail_id)) {
                $params['attachment2'] = $thumbnail_id['attachment2'];
            }
            if (array_key_exists('attachment3', $thumbnail_id)) {
                $params['attachment3'] = $thumbnail_id['attachment3'];
            }
            if (array_key_exists('proof_photo', $thumbnail_id)) {
                $params['proof_photo'] = $thumbnail_id['proof_photo'];
            }
        }


        $this->result = DB::table($this->table)
            ->where("id", $this->id)
            ->update($params);

        return $this->result ? $this->id : 0;
    }

    public function updateOrInsert(Request $request): bool
    {
        $where = [];
        $params = [];

        foreach ($this->where as $find) {
            if (!$request->input($find)) continue;
            $where[$find] = $request->input($find);
        }

        foreach ($this->columns as $column) {
            if (in_array($column, $this->continue)) continue;
            if (!$request->input($column)) continue;
            $params[$column] = $request->input($column);
        }

        $params['contents'] = addslashes($params['contents']);
        $this->result = DB::table($this->table)
            ->updateOrInsert(
                $where,
                $params
            );

        return $this->result;
    }

    public function delete($id)
    {
        $this->result = DB::table($this->table)
            ->where("id", $id)
            ->delete();

        return $this->result;
    }

    public function adminDelete($id): bool
    {
        $user_id = Auth::id() ?? 1;

        $level = DB::table("users")
                ->where("id", $user_id)
                ->first()->level ?? false;

        if (!$level) return false;
        if ($this->adminDeleteLevel > $level) return false;

        $this->result = DB::table($this->table)
            ->where("id", $id)
            ->delete();

        return $this->result;
    }


    //--- 조회수 증가
    public function hitUp($id): void
    {
        DB::table($this->table)->where("id", $id)->increment('hit', 1);
    }

    //--- 게시물 하나가져오기
    public function find($id)
    {
        return DB::table($this->table)->where("id", $id)->first();
    }
}
