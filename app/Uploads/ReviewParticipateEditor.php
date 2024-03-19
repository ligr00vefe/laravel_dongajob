<?php


namespace App\Uploads;


use Illuminate\Http\Request;

class ReviewParticipateEditor extends EDITOR
{
    protected $from = "동아 친화기업 300 에디터 사진 업로드";

    public function run(Request $request)
    {
        return $this->upload($request);
    }
}
