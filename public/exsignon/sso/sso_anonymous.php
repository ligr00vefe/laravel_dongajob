<?php 

/*
sp_const.php 에 ANONYMOUS_REDIRECT_URL 로 기본 설정되어 있는 파일이다. 
sp_const.php 에서 ANONYMOUS_REDIRECT_URL을 변경하지 않았을 경우 인증서버에 로그인 정보가 없을 때 이 파일이 호출된다.
설정이 변경되었다면 해당 URL이 호출된다.
*/

header("Location:" . "/");
return;

?>