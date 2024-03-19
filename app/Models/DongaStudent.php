<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DongaStudent
{
    use HasFactory;

    protected $connection = 'oracle';
    protected $table = 'SHA.jobstudentvw';



}
