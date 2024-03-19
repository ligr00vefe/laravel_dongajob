<?php

/*
통합 로그아웃 요청 이후 relayState 값이 존재한다면 해당 URL로,
존재하지 않는다면 context root로 리다이렉트한다.
*/

include_once '../common/sso_common.php';
include_once '../common/sp_const.php';

if (isset($_REQUEST[RELAY_STATE_NAME]) && $_REQUEST[RELAY_STATE_NAME] != null) {
    header("Location:" . $_REQUEST[RELAY_STATE_NAME]);
    return;
} else {
    header("Location:" . "/");
    return;
}

?>
