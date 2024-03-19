<?php


namespace App\Uploads;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EDITOR
{
    protected $from;
    protected $category = "2"; // 에디터 2번

    public function upload(Request $request)
    {
        if(isAdminCheck(session()->get('donga_type'))) {
            $user_id = session()->get('user_id') ?? 1;
        } else {
            $user_id = Auth::id() ?? 1;
        }



        if ($request->hasFile('upload') && $request->path) {

            $origin_name = $request->file('upload')->getClientOriginalName();
            $file_name = pathinfo($origin_name, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $encrypted_file_name = bin2hex(random_bytes(20)) . '_' . time() . '.' . $extension;
            $path = $request->file("upload")->storeAs('/editor/' . $request->path, $encrypted_file_name, "public");

            $attachment = DB::table("attachments")
                ->insertGetId([
                    "user_id" => $user_id,
                    "from" => $this->from ?? "",
                    "category" => $this->category,
                    "original_name" => $origin_name,
                    "path" => $path,
                ]);



            $url = asset('/storage/editor/' . $request->path . '/' . $encrypted_file_name);

            return response()->json([
                "url" => $url,
                "id" => $attachment
            ]);

        }
    }
}
