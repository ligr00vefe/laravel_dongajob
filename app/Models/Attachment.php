<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{

    //--- 첨부파일 테이블의 정보를 반환한다.
    public static function getAll($list)
    {
        $files = [];

        for ($i = 1; $i <= 5; $i++) {
            $property = 'attachment' . $i;

            if (!$list->$property)
                continue;

            $files[] = self::find($list->$property);
        }

        return $files;
    }
}
