<?php

/*
IDP_URL : 인증서버 URL ex) https://idp.net
SP_ID : 인증서버에서 발급받은 SP ID ex) php-sp
SP_SECRET : 인증서버에서 발급받은 비밀키
TOKEN_VERIFY_FAIL_URL : 토큰 검증이 실패했을 때 이동할 URL
LOGINUSER_REDIRECT_URL : SSO 로그인 여부를 체크했을 때에 인증된 사용자가 이동할 URL
ANONYMOUS_REDIRECT_URL : SSO 로그인 여부를 체크했을 때에 인증되지 않은 사용자가 이동할 URL
*/

define('IDP_URL', 'https://sso.donga.ac.kr');
define('SP_ID', 'newJob');
define('SP_SECRET', 'WjHeiWEx+bA8+xEEgH0qug==');
define('TOKEN_VERIFY_FAIL_URL', '/exsignon/sso/token_verify_fail.php');
define('LOGINUSER_REDIRECT_URL', '/exsignon/sso/sso_loginuser.php');
define('ANONYMOUS_REDIRECT_URL', '/exsignon/sso/sso_idp_login.php');

?>
