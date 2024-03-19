<?php

namespace App\Models;

use App\Uploads\ATTACHMENT;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{
    use HasFactory;


    public static function getAll($title, $board_id = null)
    {
        return DB::table('comments')
            ->where('board_title', $title)
            ->when($board_id, function ($query, $board_id) {
                return $query->where('board_id', $board_id);
            })
            ->orderBy('')
            ->get();
    }
}
