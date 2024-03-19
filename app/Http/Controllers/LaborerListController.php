<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Laborer;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;


class LaborerListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        $page = $request->input("page") ?? 1;
        $from_date = $request->input("from_date");
        $to_date = $request->input("to_date");
        $term = $request->input("term");

        $get = DB::table("laborers")
            ->when($from_date, function ($query, $from_date) {
                return $query->where("contract_start_date", ">=", $from_date);
            })
            ->when($to_date, function ($query, $to_date) {
                return $query->where("contract_end_date", "<=", $to_date);
            })
            ->when($term, function ($query, $term) {
                return $query->where("name", "like", $term);
            });

        $paging = $get->count();
        $lists = $get->paginate(15);

        return view("laborer.list", [ "page" => $page, "lists"=>$lists, "paging"=>$paging ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Laborer.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $add = Laborer::add($request);
        session()->flash("msg", "이용자를 추가하거나 수정했습니다.");
        return redirect("/Laborer/list");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        dd($request->input());
        $ids = $request->input("id");

        foreach ($ids as $i => $id) {

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function sort($type, $page = 1)
    {
        $type_arr = [
            "mng" => "mng",
            "mna" => "mna",
            "gna" => "gna",
            "lna" => "lna",
            "snt" => "snt",
        ];

        function show($msg)
        {
            echo "<pre>";
            print_r($msg);
            echo "</pre>";
        }

        $lists = Laborer::sort($type);
        $averageLists = Laborer::averageSort($type);


        if ($type == "mna") {
            // 연인원 데이터
            $averageTotalType1 = $lists['averageTotalType1'];
            $averageTotalType2 = $lists['averageTotalType2'];
            $averageLists = $lists['averageAges'];

            $totalType1 = $lists['totalType1'];
            $totalType2 = $lists['totalType2'];
            $lists = $lists['ages'];

        }

        if ($type == "gna" || $type == "lna") {
            $averageTotalType1 = $lists['averageTotalType1'];
            $averageLists = $lists['averageAges'];

            $totalType1 = $lists['totalType1'];
            $lists = $lists['ages'];
        }


        $columns = Laborer::$disables_key;


        return view("member.sort.{$type_arr[$type]}", [
            "page" => $page,
            "type" => $type,
            "lists" => $lists,
            "averageLists" => $averageLists ?? [],
            "columns" => $columns,
            "totalType1" => $totalType1 ?? [],
            "totalType2" => $totalType2 ?? [],
            "averageTotalType1" => $averageTotalType1 ?? [],
            "averageTotalType2" => $averageTotalType2 ?? [],
        ]);
    }

    public function service($page = 1, Request $request)
    {
        $get = Laborer::getAll($request);

        return view("member.serviceCheckList", ["page" => $page, "members" => $get['member']]);
    }

    public static function service_list(Request $request)
    {
        $get = Laborer::get_service_using($request);

        return view("member.serviceList", [
            "lists" => $get['lists'],
            "total" => $get['total'],
            "paging" => $get['paging'],
            "page" => $request->input("page") ?? 1
        ]);
    }



}
