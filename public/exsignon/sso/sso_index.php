<?php

include_once '../include/sso_entry.php';

/*
sso_entry.php 를 통해 SSO 로그인 여부를 확인한 후,
SSO 인증이 된 사용자의 경우 sp_const.php 에 정의된 LOGINUSER_REDIRECT_URL
그렇지 않은 사용자의 경우  ANONYMOUS_REDIRECT_URL 로 queryString 과 함께 리다이렉트시킨다.
*/

$query = $_SERVER['QUERY_STRING'];
$relayState = "";

if($eXSignOnUserId == null || (strcmp(SSO_SESSION_ANONYMOUSE, $eXSignOnUserId) == 0)) {
  $relayState = ANONYMOUS_REDIRECT_URL;
} else {
  $relayState = LOGINUSER_REDIRECT_URL;
}

if($query != null || (strcmp($query, "") != 0)) {
	$relayState += "?";
	$relayState += $query;
}

header("Location:" . $relayState);
return;

?>
