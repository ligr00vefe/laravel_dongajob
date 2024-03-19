<?php 

/*
사용자 로그인이 되어 있지 않은 경우, 이 파일을 호출하면
연계시스템의 개별로그인 페이지가 아닌 인증서버에 설정된 통합로그인 페이지로 리다이렉트 시킨다.
*/

include_once '../common/sso_common.php';
include_once '../common/sp_const.php';

$paramMap[ID_NAME] = SP_ID;
$paramMap[AC_NAME] = "Y";
$paramMap[IFA_NAME] = "N";

$relayState = $_REQUEST[RELAY_STATE_NAME];
if($relayState != null) {
  $paramMap[RELAY_STATE_NAME] = $relayState;
}

$redirectUrl = generateUrlWithParam(IDP_URL, AUTH_URL, $paramMap);
header("Location:" . $redirectUrl);
return;

?>