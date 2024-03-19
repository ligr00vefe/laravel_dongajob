<?php

include_once '../common/sso_common.php';
include_once '../common/sp_const.php';

$eXSignOnUserId = null;

session_start();

$_SESSION['TEST'] ='123';

$fp = fopen($_SERVER['DOCUMENT_ROOT'] . "/log/sdata_".date("Ymd").".log", "a+");
fputs($fp, "\r\n[".date("Y-m-d H:i:s")."]\n");
fputs($fp, "session_entry_start , eXSignOnUserId : " . $eXSignOnUserId.", SSO_SESSION_NAME : ".SSO_SESSION_NAME.", _SESSION[SSO_SESSION_NAME] : ".$_SESSION[SSO_SESSION_NAME].", session : " . session_id()." / ".$_COOKIE["PHPSESSID"].", _session : " . json_encode($_SESSION).", ipp :".$ipp."\n");
fclose($fp);

//var_dump($_SESSION);
if(isset($_SESSION[SSO_SESSION_NAME]) && $_SESSION[SSO_SESSION_NAME] != null) {
  $eXSignOnUserId = $_SESSION[SSO_SESSION_NAME];
}

$_SESSION['TEST'] ='123';

var_dump(session_id());


$fp = fopen($_SERVER['DOCUMENT_ROOT'] . "/log/sdata_".date("Ymd").".log", "a+");
fputs($fp, "\r\n[".date("Y-m-d H:i:s")."]\n");
fputs($fp, "session_entry , status : " . $status.", ".$eXSignOnUserId.", session : " . var_dump(session_id()) ."\n");
fclose($fp);

if($eXSignOnUserId == null || (strcmp(SSO_SESSION_ANONYMOUSE, $eXSignOnUserId) == 0)) {
  if(strcmp(SSO_SESSION_ANONYMOUSE, $eXSignOnUserId) == 0) {
    unset($_SESSION[SSO_SESSION_NAME]);
  }

  $paramMap[ID_NAME] = SP_ID;
  $paramMap[AC_NAME] = "N";
  $paramMap[IFA_NAME] = "N";
  $paramMap[RELAY_STATE_NAME] = $_SERVER['REQUEST_URI'];

  $redirectUrl = generateUrlWithParam(IDP_URL, AUTH_URL, $paramMap);

  header("Location:" . $redirectUrl);

  return;
} else if(strcmp(SSO_SESSION_ANONYMOUSE_IDENTIFY, $eXSignOnUserId) == 0) {
  $_SESSION[SSO_SESSION_NAME] = SSO_SESSION_ANONYMOUSE;
  $eXSignOnUserId = $_SESSION[SSO_SESSION_NAME];
}

?>
