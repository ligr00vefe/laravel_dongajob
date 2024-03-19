<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account',
        'name',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public static function getStudent($account, $student_name = null)
    {

        //--- 동아대 서버일경우 (학생정보를 가져옴)
        if (DONGA_NAME == $_SERVER['SERVER_NAME']) {
            $student_name = $student_name ? "AND NM = '{$student_name}'" : '';

            $student = DB::connection('oracle')
                ->select(sprintf("SELECT * FROM SHA.jobstudentvw WHERE STUDENTCD = '%s'", $account, $student_name));

            return $student ?
                (object)[
                    'account' => $student[0]->studentcd,
                    'name' => $student[0]->nm ?: '-',
                    'university' => '동아대학교',
                    'department' => $student[0]->dept ?: '-',
                    'grade' => $student[0]->studentyear ?: '-',
                    'academic' => $student[0]->sts ?: '-',
                    'phone_number' => $student[0]->hp,
                    'number' => '-',
                    'email' => $student[0]->email ?: '-',
                    'year' => $student[0]->birth ?: '-',
                    'gender' => $student[0]->sex == '남' ? 1 : 2,
                    'line' => $student[0]->college ?: '-',
                    'type' => $student[0]->div ?: '-',
                    'grade_score' => $student[0]->gpa ?: '-',
                ] : null;

        }

        //--- 테스트서버일경우
        return DB::table("students")
            ->where("account", $account)
            ->when($student_name, function ($query, $name) {
                return $query->where('name', $name);
            })->first();
    }


    public static function getInfoStudent($search = null, $term = null)
    {


        if (DONGA_NAME == $_SERVER['SERVER_NAME']) {

            $where = '';
            if ($search == 'name') {
                $where = "NM LIKE '%{$term}%'";
            }

            if ($search == 'major') {
                $where = "dept LIKE '%{$term}%'";
            }



            $student = DB::connection('oracle')
                ->select(sprintf("SELECT studentcd FROM SHA.jobstudentvw WHERE %s", $where));


            return $student;


        }

    }


    public static function isStudent($account)
    {
        if (DONGA_NAME == $_SERVER['SERVER_NAME']) {
            $user = DB::connection('oracle')->select(sprintf("SELECT count(*) as cnt FROM SHA.jobstudentvw WHERE STUDENTCD = '%s'", $account));
            return $user[0]->cnt;
        }

        return DB::table("students")->where("account", $account)->exists();
    }


    public static function isStudentApi($account, $student_name)
    {

        $where = "'{$account}' AND NM = '{$student_name}'";

        if (DONGA_NAME == $_SERVER['SERVER_NAME']) {
            $user = DB::connection('oracle')->select(sprintf("SELECT count(*) as cnt FROM SHA.jobstudentvw WHERE STUDENTCD = %s", $where));

            return $user[0]->cnt ? 'yes' : 'no';
        }

        return 'no';
    }
}
