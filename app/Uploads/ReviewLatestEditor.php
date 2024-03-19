<?php


namespace App\Uploads;


use Illuminate\Http\Request;

class ReviewLatestEditor extends EDITOR
{
    protected $from = "각종 활동 에디터 사진 업로드";

    public function run(Request $request)
    {
        return $this->upload($request);
    }
}
