<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProgramReservation;
use Illuminate\Support\Facades\DB;

class AdminProgramReservationController extends Controller
{
    public function index(Request $request)
    {
        $lists = BoardProgram::paging($request);


        $search = [
            'search' => $request->search,
            'term' => $request->term
        ];

        return view('admin.support.program.list', [
            'lists' => $lists,
            'search' => $search,
        ]);
    }

    public function view($id)
    {
        if ($list = BoardProgram::find($id)) {

            //$applicant_lists = ProgramReservation::paging();


            return view('admin.support.program.view', [
                'list' => $list
            ]);
        }
        return back()->with("error", msg_collection('access_impossible'));
    }

    public function create(Request $request)
    {
        if (!$request->id && $request->status)
            return back()->with("error", msg_collection('access_impossible'));


        return view("admin.support.applicant.create", [
            'program_id' => $request->id,
            'status' => $request->status
        ]);
    }

    public function store(Request $request)
    {
        $params = $request->only(['program_id', 'account', 'status']);

        // 예약했는지 체크
        if (ProgramReservation::is_reservation_user($params['program_id'], $params['account'])) {
            return redirect()->back()->with("error", msg_collection('reservation_already'));

            // 정원초과 체크
        } else if (!ProgramReservation::is_reservation_full($params['program_id'], $params['status'])) {
            return redirect()->back()->with("error", msg_collection('reservation_full'));
        }


        if (ProgramReservation::create($params)) {
            return redirect($request->redirect)->with("success", msg_collection('success_enrollment'));
        }

        return redirect($request->redirect)->with("error", msg_collection('error_enrollment'));
    }

    public function edit($id)
    {
        if ($update = BoardProgram::find($id)) {
            return view('admin.support.program.create', [
                'list' => $update
            ]);
        }
        return back()->with("error", msg_collection('access_impossible'));
    }

    public function update(Request $request, BoardProgram $notice)
    {
        if (!$request->id)
            return back()->with("error", "수정하는데 실패 하였습니다. 다시 시도해 주세요.");

        $update = $notice::find($request->id);

        $update->subject = $request->subject;
        $update->is_notice = $request->is_notice;
        $update->category_id = $request->category_id;
        $update->schedule_date = $request->schedule_date;
        $update->content = addslashes($request->contents);


        if ($update->save()) {
            return back()->with("success", "정상적으로 수정되었습니다.");
        }

        return back()->with("error", "수정하는데 실패 하였습니다. 다시 시도해 주세요.");
    }


    // 개별 삭제
    public function destroy(Request $request)
    {
        if (isset($request->id)) {
            $delete = BoardProgram::find($request->id);

            if ($delete->delete()) {
                return redirect()->route("admin.notice.index")->with("success", "정상적으로 삭제되었습니다.");
            }
        }

        return back()->with("error", "삭제하는데 실패했습니다. 다시 시도해 주세요.");
    }

    // 선택 삭제
    public function destroyAll(Request $request)
    {

        $chk = false;
        foreach ($request->chk as $id) {
            $delete = ProgramReservation::find($id);

            if ($delete->delete())
                $chk = true;
            else {
                $chk = false;
                break;
            }
        }

        if ($chk)
            return back()->with("success", "정상적으로 삭제되었습니다.");

        return back()->with("error", "삭제하는데 실패하였습니다. 다시 시도해 주세요.");
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {

            $origin_name = $request->file('upload')->getClientOriginalName();
            $file_name = pathinfo($origin_name, PATHINFO_FILENAME);
            $extension_name = $request->file('upload')->getClientOriginalExtension();
            $encrypted_fileName = bin2hex(random_bytes(20)) . '_' . time() . '.' . $extension_name;

            $request->file('upload')->move(storage_path('/app/public/program/images'), $encrypted_fileName);


            return response()->json([
                'uploaded' => 1,
                'original_name' => $file_name,
                'url' => '/storage/program/images/' . $encrypted_fileName
            ]);
        }
    }
}
