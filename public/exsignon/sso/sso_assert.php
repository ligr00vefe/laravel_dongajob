<?php 

include_once '../common/sso_common.php';
include_once '../common/sp_const.php';

/*
이 파일을 호출하며 사용자의 인증정보(ID) 를 파라미터로 보낼 경우 인증서버에 강제 로그인이 가능하다.
즉, 연계서버에서 ID만을 가지고 인증서버에 로그인 시켜야 할 때에 사용된다.
*/

//올바른 인증요청인지 검증하기 위한 세션값
$nameId = null;
//인증 후 리턴 될 URL (파라미터키 : RelayState)
$relayState = null;
//인증 시킬 연계서버 ID (파라미터키 : targetId)
$targetSp = null;
//rememberMe
$rememberMe = null;

session_start();
if(isset($_SESSION[SSO_ASSERT_NAME])){
	$nameId = $_SESSION[SSO_ASSERT_NAME];
}

if(isset($_REQUEST[RELAY_STATE_NAME]) && $_REQUEST[RELAY_STATE_NAME] != null) {
  $relayState = $_REQUEST[RELAY_STATE_NAME];
}

if(isset($_REQUEST[TARGET_ID_NAME]) && $_REQUEST[TARGET_ID_NAME] != null) {
  $targetSp = $_REQUEST[TARGET_ID_NAME];
}


if(isset($_REQUEST[SSO_REMEMBERME]) && $_REQUEST[SSO_REMEMBERME] != null) {
  $targetSp = $_REQUEST[SSO_REMEMBERME];
}

if($nameId == null) {
  header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad Request : user id not found', true, 400);
  return;
}

if($targetSp == null) {
  header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden', true, 403);
  return;
}

//전달 받은 파라미터를 기반으로 토큰 생성
$paramMap[ID_NAME] = SP_ID;
$paramMap[SECRET_NAME] = SP_SECRET;
$paramMap[NAMEID_NAME] = $nameId;

$assertUrl = generateUrl(IDP_URL, AUTH_ASSERT_URL);
$resultData = httpRequest($assertUrl, $paramMap);

$obj = json_decode($resultData);

$success = $obj->{STATUS_NAME};

if(strcmp(SUCCESS, $success)) {
  $errCode = $obj->{FAILURE_CAUSE};
  
  $param[RELAY_STATE_NAME] = $relayState;
  $param[FAILURE_CAUSE] = $errCode;
  
  header("Location:" . TOKEN_VERIFY_FAIL_URL . "?" . generateParam($param));
    
  return;
} else {
  $data = $obj->{DATA_NAME};
  
  $fedParam[TOKEN_NAME] = $data;
  $fedParam[ID_NAME] = SP_ID;
  $fedParam[TARGET_ID_NAME] = $targetSp;
  $fedParam[RELAY_STATE_NAME] = $relayState;
  $fedParam[SSO_REMEMBERME] = $rememberMe;
  
  $federateUrl = generateUrlWithParam(IDP_URL, AUTH_FEDERATE_URL, $fedParam);
  
  //인증서버로부터 전달 받은 토큰을 포함하여 인증 시킬 연계서버로 Federate (인증서버 인증 및 연계서버 이동)
  header("Location:" . $federateUrl);
  
  return;
}

?>