<?php
/**
 * Created by PhpStorm.
 * User: Baraem-Dev
 * Date: 2021-11-02
 * Time: 오후 2:16
 */

//게시판 뷰페이지 첨부파일 크기 변환
function formatSize($bytes, $decimals = 2) {
    $size = array(' B', ' KB', ' MB', ' GB', ' TB', ' PB', ' EB', ' ZB', ' YB');
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
}

?>
