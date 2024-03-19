<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Popup extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'device', 'start_time', 'end_time', 'disable_hours', 'left', 'top', 'height', 'width', 'subject', 'contents'];
    protected $table = 'popups';

    public function getList()
    {
        $date = date('Y-m-d H:i:s');
        $mobilechk = '/(iPod|iPhone|Android|BlackBerry|SymbianOS|SCH-M\d+|Opera Mini|Windows CE|Nokia|SonyEricsson|webOS|PalmOS)/i';
        $device = preg_match($mobilechk, $_SERVER['HTTP_USER_AGENT']) ? 'mobile' : 'pc';


        return  DB::table($this->table)
            ->where('start_time', '<=', $date)->where('end_time', '>=', $date)
            ->where(function($query) use($device) {
                $query->where('device', $device)
                    ->orWhere('device', 'all');
            })
            ->orderBy('id')
            ->get();
    }
}
