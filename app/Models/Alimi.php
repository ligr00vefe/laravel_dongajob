<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Alimi extends Model
{
    use HasFactory;

    public $table = 'alimi_histories';

    public function setData($student_id, $menu_id, $category_id): bool
    {
        return DB::table($this->table)->insert([
            'student_id' => $student_id,
            'menu_id' => $menu_id,
            'category_id' => $category_id
        ]);
    }

    public function getData($stdudent_id, $menu_id = null)
    {
        return DB::table($this->table)
            ->where('student_id', $stdudent_id)
            ->when($menu_id, function ($query, $menu_id) {
                return $query->where('menu_id', $menu_id);
            })->get();
    }


    public function isData($student_id, $menu_id, $category_id = null): bool
    {
        return DB::table($this->table)
            ->where('student_id', $student_id)
            ->where('menu_id', $menu_id)
            ->when($category_id, function ($query, $category_id) {
                return $query->where('category_id', $category_id);
            })->exists();
    }

    public function deleteData($student_id, $menu_id, $category_id): int
    {
        return DB::table($this->table)
            ->where('student_id', $student_id)
            ->where('menu_id', $menu_id)
            ->where('category_id', $category_id)
            ->delete();
    }


}
