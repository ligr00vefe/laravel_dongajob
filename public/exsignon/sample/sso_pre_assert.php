<?php 

include_once '../common/sso_common.php';

$userId = null;
$relayState = null;
$targetSp = null;
$rememberMe = null;

if(isset($_REQUEST[NAMEID_NAME]) && $_REQUEST[NAMEID_NAME] != null) {
  $userId = $_REQUEST[NAMEID_NAME];
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

session_start();
$_SESSION['eXSignOn.assert.userid'] = $userId;

?>
<!DOCTYPE html><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script>
	window.onload=function(){
		
		document.getElementById('assertLoginFrm').submit();
		
	}
</script>
</head>
<body>
<form id="assertLoginFrm" name="assertLoginFrm" method="post" action="../sso/sso_assert.php">
  <input type="hidden" name="<?= SSO_REMEMBERME ?>" value="<?= $rememberMe ?>" />
  <input type="hidden" name="<?= TARGET_ID_NAME ?>" value="<?= $targetSp ?>" />
  <input type="hidden" name="<?= RELAY_STATE_NAME ?>" value="<?= $relayState ?>" />
</form>
</body>
</html>