<?php


namespace App\Uploads;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ATTACHMENT extends Model
{
    protected $files;
    protected $filenames;
    protected $from;
    protected $exts = [];
    protected $upload_path;
    protected $storage_path = '/storage/';
    protected $category = "1"; // 첨부파일은 1번

    public function upload(Request $request)
    {

        $user_id = Auth::id() ?? 1;
        $files = $request->file();

        $data = [
            "success" => [],
            "fail" => [],
        ];

        if (!$this->upload_path)
            return false;


        foreach ($files as $key => $file) {

            if (!$request->hasFile($key)) {
                $data['fail'][] = [
                    "msg" => "파일이 없습니다",
                    "file" => $file
                ];
                continue;
            }

            $origin_name = $request->file($key)->getClientOriginalName();
            $file_name = pathinfo($origin_name, PATHINFO_FILENAME);
            $extension = $request->file($key)->getClientOriginalExtension();
            $this->exts = ["jpg", "png", "jpeg", "svg", "gif", "pdf", "zip", "doc", "docx", "avi", "mp4", "mov", "wmv", "pptx", "hwp", "csv", "txt", "xls", "xlsx"];

            if (!empty($this->exts) && !in_array(strtolower($extension), $this->exts)) {
                continue;
            }

            $encrypted_file_name = bin2hex(random_bytes(20)) . '_' . time() . '.' . $extension;
            $path = $request->file($key)->storeAs("/uploads/" . $this->upload_path ?? "default" . "/", $encrypted_file_name, "public");

            $attachment_id = DB::table("attachments")
                ->insertGetId([
                    "user_id" => $user_id,
                    "from" => $this->from . ' attach' ?? "",
                    "category" => $this->category,
                    "original_name" => $origin_name,
                    "path" => $path,
                ]);

            $url = asset('/storage/uploads/' . $this->upload_path ?? "default" . "/" . $encrypted_file_name);

            $data['success'][$key] = [
                "id" => $attachment_id,
                "url" => $url,
            ];


        }

        return $data;
    }


    public function file_delete($method, $id)
    {
        if (!$method == "PUT" && !$id)
            return false;

        $file_path = DB::table("attachments")->select('path')->where('id', $id)->first();

        return unlink(storage_path($this->storage_path . $file_path->path));

    }

}
