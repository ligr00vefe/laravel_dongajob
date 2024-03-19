<?php

define('AUTH_URL', '/svc/tk/Auth.eps');
define('AUTH_RESOLVE_URL', '/svc/tk/AuthResolve.eps');
define('AUTH_ASSERT_URL', '/svc/tk/AuthAssert.eps');
define('AUTH_FEDERATE_URL', '/svc/tk/AuthFederate.eps');
define('LOGIN_URL', '/svc/tk/Login.eps');
define('LOGOUT_URL', '/svc/tk/SLO.eps');

define('RELAY_STATE_NAME', 'RelayState');
define('ID_NAME', 'id');
define('SECRET_NAME', 'secret');
define('NAMEID_NAME', 'nameId');
define('STATUS_NAME', 'status');
define('TARGET_ID_NAME', 'targetId');
define('DATA_NAME', 'data');
define('AC_NAME', 'ac');
define('IFA_NAME', 'ifa');
define('TOKEN_NAME', 't');
define('SP_ID_NAME', 'spid');

define('SUCCESS', 'success');
define('FAILURE_CAUSE', 'failureCause');

define('SSO_SESSION_NAME', 'eXSignOn.session.userid');
define('SSO_SESSION_ANONYMOUSE', 'anonymous');
define('SSO_SESSION_ANONYMOUSE_IDENTIFY', 'anonymous_identify');

define('SSO_ASSERT_NAME', 'eXSignOn.assert.userid');
define('SSO_REMEMBERME', 'sso_remember_me');

?><?php

if(!function_exists('json_encode')) {
    function json_encode($content) {
        require_once '../lib/JSON.php';
        $json = new Services_JSON;
        return $json->encode($content);
    }
}

if (!function_exists('json_decode')) {
    function json_decode($content, $assoc=false) {
        require_once '../lib/JSON.php';
        if ($assoc) {
            $json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
        }
        else {
            $json = new Services_JSON;
        }
        return $json->decode($content);
    }
}

function encode($data) {
    if($data == null) {
        return "";
    }

    return rawurlencode($data);
}

function generateUrl($idpUrl, $subUrl) {
    if($idpUrl == null && $subUrl == null) {
        return null;
    }
    
    $url = $idpUrl . "/" . $subUrl;

    $url = preg_replace("/[\/]+/", "/", $url);
    
    if(strpos($url, "http:/") === 0) {
          $url = str_replace("http:/", "http://", $url);
    } else if(strpos($url, "https:/") === 0) {
          $url = str_replace("https:/", "https://", $url);
    }
    
    return $url;
}

function generateParam($param) {
    $keys = array_keys($param);
    
    $paramStr = "";
    
    foreach($keys as $key) {
        $val = $param[$key];
        
        $paramStr = $paramStr . encode($key) . "=" . encode($val) . "&";
    }
      
    return $paramStr;
}

function generateUrlWithParam($idpUrl, $subUrl, $param) {
    $url = generateUrl($idpUrl, $subUrl);

    if($url == null) {
        return null;
    }

    $paramStr = generateParam($param);

    return $url . "?" . $paramStr;
}

function httpRequest($url, $paramMap) {
    $conn = curl_init();

    curl_setopt($conn, CURLOPT_URL, $url);
    curl_setopt($conn, CURLOPT_POST, true);

    $param = generateParam($paramMap);

    curl_setopt($conn, CURLOPT_POSTFIELDS, $param);
    curl_setopt($conn, CURLOPT_RETURNTRANSFER, true);
    // CURLOPT_SSL_VERIFYPEER를 FALSE 를 설정하면, cURL은 서버 증명서의 검증을 실시하지 않습니다.
    // 다른 증명서를CURLOPT_CAINFO 옵션으로 지정하거나CURLOPT_CAPATH 옵션으로 증명 디렉토리를 지정합니다.
    curl_setopt($conn, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($conn, CURLOPT_SSL_VERIFYHOST, false);

    $result = curl_exec($conn);
    curl_close($conn);
    
    return $result;
}

?>