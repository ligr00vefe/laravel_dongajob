<?php
/**
 * Created by PhpStorm.
 * User: Baraem-Dev
 * Date: 2021-11-03
 * Time: 오후 2:36
 */

namespace App\Uploads;


class PickAttachment extends ATTACHMENT
{
    protected $filenames = [ "attachment1", "attachment2", "attachment3", "attachment4", "attachment5" ];
    protected $from = "일반 채용";
    protected $upload_path = "pick";
    protected $exts = [ "jpg", "png", "jpeg", "svg", "gif","pdf", "zip", "doc", "docx", "avi", "mp4", "mov", "wmv", "pptx", "hwp", "csv", "txt", "xls", "xlsx"];

    public function set($request)
    {
        if (!$request->file()) return false;

        $upload = $this->execute($request);
        if (!$upload) {
            return back()->with("error", "잘못된 접근입니다");
        }

        // 아래 부분 변경해주셔야 합니다. $filenames 에
        $attachment1 = $upload['success']['attachment1']['id'] ?? false;
        $attachment2 = $upload['success']['attachment2']['id'] ?? false;
        $attachment3 = $upload['success']['attachment3']['id'] ?? false;
        $attachment4 = $upload['success']['attachment4']['id'] ?? false;
        $attachment5 = $upload['success']['attachment5']['id'] ?? false;

        $return = [];
        if ($attachment1) {
            $return["attachment1"] = $attachment1;
        }
        if ($attachment2) {
            $return["attachment2"] = $attachment2;
        }
        if ($attachment3) {
            $return["attachment3"] = $attachment3;
        }
        if ($attachment4) {
            $return["attachment4"] = $attachment4;
        }
        if ($attachment5) {
            $return["attachment5"] = $attachment5;
        }

        return $return;
    }

    public function execute($request)
    {
        return $this->upload($request);
    }
}
