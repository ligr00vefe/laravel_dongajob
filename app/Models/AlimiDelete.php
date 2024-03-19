<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AlimiDelete extends Model
{
    use HasFactory;

    public $table = 'alimi_delete_histories';

    public function setData($student_id, $menu_id, $post_id): bool
    {
        return DB::table($this->table)->insert([
            'student_id' => $student_id,
            'menu_id' => $menu_id,
            'post_id' => $post_id
        ]);
    }

    public function getData($student_id, $menu_id) {
        return DB::table($this->table)
            ->where('student_id', $student_id)
            ->where('menu_id', $menu_id)
            ->get();
    }
}
