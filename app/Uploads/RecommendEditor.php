<?php


namespace App\Uploads;


use Illuminate\Http\Request;

class RecommendEditor extends EDITOR
{
    protected $from = "일반 채용 에디터 사진 업로드";

    public function run(Request $request)
    {
        return $this->upload($request);
    }
}
