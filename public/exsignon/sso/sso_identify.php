<?php

include_once '../common/sso_common.php';
include_once '../common/sp_const.php';

session_start();

$token = null;
$status = null;
$relayState = null;

if(isset($_REQUEST[TOKEN_NAME]) && $_REQUEST[TOKEN_NAME] != null) {
    $token = $_REQUEST[TOKEN_NAME];
}

if(isset($_REQUEST[STATUS_NAME]) && $_REQUEST[STATUS_NAME] != null) {
    $status = $_REQUEST[STATUS_NAME];
}

if(isset($_REQUEST[RELAY_STATE_NAME]) && $_REQUEST[RELAY_STATE_NAME] != null) {
    $relayState = $_REQUEST[RELAY_STATE_NAME];
}

if($token == null && $status == null) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden', true, 403);
    return;
}

if($token != null) {
    $paramMap[ID_NAME] = SP_ID;
    $paramMap[SECRET_NAME] = SP_SECRET;
    $paramMap[TOKEN_NAME] = $token;

    $url = generateUrl(IDP_URL, AUTH_RESOLVE_URL);

    $resultData = httpRequest($url, $paramMap);

    $obj = json_decode($resultData);

    $success = $obj->{STATUS_NAME};

    if(strcmp(SUCCESS, $success)) {
        $id = null;

        if(isset($_SESSION[SSO_SESSION_NAME]) && $_SESSION[SSO_SESSION_NAME] != null) {
            $id = $_SESSION[SSO_SESSION_NAME];
        }

        if($id != null) {
            $errCode = null;

            $errCode = $obj->{FAILURE_CAUSE};

            if($errCode == null && $status != null) {
                $errCode =  $_REQUEST[FAILURE_CAUSE];
            }

            $param[RELAY_STATE_NAME] = $relayState;
            $param[FAILURE_CAUSE] = $errCode;

            header("Location:" . TOKEN_VERIFY_FAIL_URL . "?" . generateParam($param));

            return;
        } else {
            $_SESSION[SSO_SESSION_NAME] = SSO_SESSION_ANONYMOUSE_IDENTIFY;
        }
    } else {
        $data = $obj->{DATA_NAME};
        $_SESSION[SSO_SESSION_NAME] = $data;
    }
} else {
    $_SESSION[SSO_SESSION_NAME] = SSO_SESSION_ANONYMOUSE_IDENTIFY;
}

if($relayState != null) {
    header("Location:" . $relayState);
    return;
} else {
    header("Location:" . "/");
    return;
}

?>
