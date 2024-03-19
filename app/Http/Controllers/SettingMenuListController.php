<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use RealRashid\SweetAlert\Facades\Alert;

class SettingMenuListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //--- Menu table에서 관리자 메뉴를 가져 옵니다.
        $first_menus = Menu::where('depth', 1)->paginate(2);
        $second_menus = Menu::where('depth', 2)->paginate(2);

        return view(
            'admin/setting/menu',
            [
                'type'             => 'setting',
                'first_menus'      => $first_menus,
                'second_menus'     => $second_menus
            ],
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params = $request->only(['depth', 'title', 'route', 'type', 'icon', 'order']);
        Menu::create($params);

        Alert::success('저장', '저장이 완료 되었습니다.');

        //return redirect('dashboard')->with('status', 'Profile updated!');
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
    public function update(Request $request, $id)
    {
        //
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
}
