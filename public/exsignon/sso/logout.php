<?php

/*
SSO 통합로그아웃을 요청하는 파일로, 이것이 호출되면 해당 사용자의 인증서버 세션을 만료시키기 위한 요청을 보낸다.
*/

include_once '../common/sso_common.php';
include_once '../common/sp_const.php';

$relayState = "";

if(isset($_REQUEST[RELAY_STATE_NAME]) && $_REQUEST[RELAY_STATE_NAME] != null) {
  $relayState = $_REQUEST[RELAY_STATE_NAME];
}

session_start();
session_destroy();



?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script type="text/javascript">
function logout() {
  document.logoutFrm.submit();
}
</script>
</head>
<body onload="logout()">
  <form id="logoutFrm" name="logoutFrm" action="<?= generateUrl(IDP_URL, LOGOUT_URL) ?>" method="post">
    <input type="hidden" name="<?= ID_NAME ?>" value="<?= SP_ID ?>" />
    <input type="hidden" name="<?= RELAY_STATE_NAME ?>" value="<?= $relayState ?>" />
  </form>
</body>
</html>
