<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use StudentAlimi;

class BoardCategory extends Model
{
    use HasFactory;

    public $table = 'board_categories';

    public function setData($menu_id, $write_id, $category_id): bool
    {
        return DB::table($this->table)->insert([
            'menu_id' => $menu_id,
            'write_id' => $write_id,
            'category_id' => $category_id
        ]);
    }


    public function getData($menu_id, $table, $categories, $page)
    {
        $alimi = new Alimi();
        $self_table = $this->table;
        $alimi_table = $alimi->table;
        $limit = !$page ? 1 * 10 : $page * 10;
        $account = session()->get('account');


        switch ($menu_id) {
            case  array_search('채용정보', get_admin_menu_list(), true):

                $column = " $table.id, $table.company_name, $table.recruitment_field, $table.category, $table.company_name, $table.company_name, $table.screening_method,
                        $table.work_area, $table.hit, $table.updated_at, $this->table.menu_id, $this->table.created_at, $alimi_table.menu_id";

                $where = "`board_categories`.`menu_id` = {$menu_id} and `board_recommends`.`id` is not null AND ";
                $detail_where = '(';


                foreach ($categories['category_id'] as $key => $val) {
                    $detail_where .= "( {$self_table}.category_id = {$val} AND {$this->table}.created_at > '{$categories['date'][$val]}' ) OR ";
                }
                $detail_where = substr($detail_where, 0, -3);
                $detail_where .= ')';


                $sub_query = " AND {$table}.id NOT IN (SELECT post_id FROM alimi_delete_histories WHERE student_id = '{$account}' AND menu_id = '{$menu_id}')";


                return DB::connection('mysql')
                    ->select(sprintf(
                        "SELECT distinct %s FROM `board_categories` left join `board_recommends` on `board_categories`.`write_id` = `board_recommends`.`id` left join `alimi_histories` on `board_categories`.`menu_id` = `alimi_histories`.`menu_id` WHERE %s %s %s ORDER BY created_at DESC LIMIT %s, %s "
                        , $column
                        , $where
                        , $detail_where
                        , $sub_query
                        , $page - 1
                        , $limit
                    ));


            /*
            return DB::table($this->table)
                ->distinct($table . '.id')
                ->select($table . '.id', $table . '.company_name', $table . '.recruitment_field', $table . '.category', $table . '.company_name', $table . '.company_name', $table . '.screening_method',
                    $table . '.work_area', $table . '.hit', $table . '.created_at', $table . '.updated_at', $this->table . '.menu_id', $this->table . '.updated_at')
                ->leftJoin($table, $self_table . '.write_id', '=', $table . '.id')
                ->leftJoin($alimi_table, $this->table . '.menu_id', '=', $alimi_table . '.menu_id')
                ->where($this->table . '.menu_id', $menu_id)
                ->where($table . '.id', '!=', null)
                ->where(function ($query) use ($categories, $table, $alimi_table) {

                    foreach ($categories as $value) {
                        $query->where($alimi_table . '.category_id', '=', $value)->whereColumn($alimi_table . '.updated_at', '<', $table . '.updated_at');
                    }

                })
                ->orderByDesc('created_at')
                ->paginate(10);
            */

            case  array_search('공지사항', get_admin_menu_list(), true):

                $column = "$table.id, $table.subject, $table.category_id, $table.hit, {$table}.created_at";
                $where = "`board_categories`.`menu_id` = {$menu_id} and `board_notices`.`id` is not null AND ";
                $detail_where = '(';


                foreach ($categories['category_id'] as $key => $val) {
                    $detail_where .= "( {$self_table}.category_id = {$val} AND {$this->table}.created_at > '{$categories['date'][$val]}' ) OR ";

                }
                $detail_where = substr($detail_where, 0, -3);
                $detail_where .= ')';
                $sub_query = " AND {$table}.id NOT IN (SELECT post_id FROM alimi_delete_histories WHERE student_id = '{$account}' AND menu_id = '{$menu_id}')";



                return DB::connection('mysql')
                    ->select(sprintf(
                        "SELECT distinct %s FROM `board_categories` left join `board_notices` on `board_categories`.`write_id` = `board_notices`.`id` left join `alimi_histories` on `board_categories`.`menu_id` = `alimi_histories`.`menu_id` WHERE %s %s %s ORDER BY id DESC LIMIT %s, %s "
                        , $column
                        , $where
                        , $detail_where
                        , $sub_query
                        , $page - 1
                        , $limit
                    ));


                /*return DB::table($this->table)
                    ->distinct($table . '.id')
                    ->select($table . '.id', $table . '.subject', $table . '.category_id', $table . '.hit', $table . '.created_at', $table . '.updated_at', $this->table . '.menu_id', $alimi_table . '.updated_at')
                    ->leftJoin($table, $self_table . '.write_id', '=', $table . '.id')
                    ->leftJoin($alimi_table, $this->table . '.menu_id', '=', $alimi_table . '.menu_id')
                    ->where($this->table . '.menu_id', $menu_id)
                    ->where($table . '.id', '!=', null)
                    ->where(function ($query) use ($categories, $table, $alimi_table) {
                        foreach ($categories as $value) {
                            $query->where($alimi_table . '.category_id', '=', $value)
                                ->whereColumn($alimi_table . '.updated_at', '<', $table . '.updated_at');
                        }
                    })
                    ->orderByDesc('created_at')
                    ->paginate(10);*/

        }

    }


    public function getCnt($menu_id, $table, $categories, $page)
    {
        $alimi = new Alimi();
        $self_table = $this->table;
        $alimi_table = $alimi->table;
        $limit = !$page ? 1 * 10 : $page * 10;
        $account = session()->get('account');


        switch ($menu_id) {
            case  array_search('채용정보', get_admin_menu_list(), true):

                $column = "distinct $table.id, $table.company_name, $table.recruitment_field, $table.category, $table.company_name, $table.company_name, $table.screening_method,
                        $table.work_area, $table.hit, $table.updated_at, $this->table.menu_id, $this->table.created_at, $alimi_table.menu_id";

                $where = "`board_categories`.`menu_id` = {$menu_id} and `board_recommends`.`id` is not null AND ";
                $detail_where = '(';


                foreach ($categories['category_id'] as $key => $val) {
                    $detail_where .= "( {$self_table}.category_id = {$val} AND {$this->table}.created_at > '{$categories['date'][$val]}' ) OR ";

                }
                $detail_where = substr($detail_where, 0, -3);
                $detail_where .= ')';

                $sub_query = " AND {$table}.id NOT IN (SELECT post_id FROM alimi_delete_histories WHERE student_id = '{$account}' AND menu_id = '{$menu_id}')";


                return DB::connection('mysql')
                    ->select(sprintf(
                        "SELECT distinct %s FROM `board_categories` left join `board_recommends` on `board_categories`.`write_id` = `board_recommends`.`id` left join `alimi_histories` on `board_categories`.`menu_id` = `alimi_histories`.`menu_id` WHERE %s %s %s ORDER BY created_at DESC"
                        , $column
                        , $where
                        , $detail_where
                        , $sub_query
                    ));


            case  array_search('공지사항', get_admin_menu_list(), true):

                $column = "$table.id, $table.subject, $table.category_id, $table.hit, {$table}.created_at";
                $where = "`board_categories`.`menu_id` = {$menu_id} and `board_notices`.`id` is not null AND ";
                $detail_where = '(';


                foreach ($categories['category_id'] as $key => $val) {
                    $detail_where .= "( {$self_table}.category_id = {$val} AND {$this->table}.created_at > '{$categories['date'][$val]}' ) OR ";

                }
                $detail_where = substr($detail_where, 0, -3);
                $detail_where .= ')';

                $sub_query = " AND {$table}.id NOT IN (SELECT post_id FROM alimi_delete_histories WHERE student_id = '{$account}' AND menu_id = '{$menu_id}')";

                return DB::connection('mysql')
                    ->select(sprintf(
                        "SELECT distinct %s FROM `board_categories` left join `board_notices` on `board_categories`.`write_id` = `board_notices`.`id` left join `alimi_histories` on `board_categories`.`menu_id` = `alimi_histories`.`menu_id` WHERE %s %s %s ORDER BY id DESC"
                        , $column
                        , $where
                        , $detail_where
                        , $sub_query
                    ));

        }

    }

    public function getCategory($menu_id, $write_id)
    {

        return DB::table($this->table)
            ->where($this->table . '.menu_id', $menu_id)
            ->where($this->table . '.write_id', $write_id)
            ->get();
    }


    public function isData($menu_id, $category_id = null): bool
    {
        return DB::table($this->table)
            ->where('menu_id', $menu_id)
            ->when($category_id, function ($query, $category_id) {
                return $query->where('category_id', $category_id);
            })->exists();
    }

    public function deleteData($menu_id, $id): int
    {
        return DB::table($this->table)
            ->where('menu_id', $menu_id)
            ->where('write_id', $id)
            ->delete();
    }

    public function arrConverter($menu_id, $write_id): array
    {
        $data = [];
        $lists = $this->getCategory($menu_id, $write_id);

        foreach ($lists as $list) {
            $data[] = $list->category_id;
        }

        return $data;
    }

}
