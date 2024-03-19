<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomPrevention extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'phrases',
        'day',
        'end_day'
    ];
}
