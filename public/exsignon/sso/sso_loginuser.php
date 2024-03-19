<!DOCTYPE>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <?php
    session_start();
    $eXSignOnUserId = json_decode($_SESSION['eXSignOn.session.userid']);


    include_once '../include/KISA_SEED_CBC.php';
    include_once '../include/KISA_FUNC.php';

    /*
    SSO 로그인이 되어 사용자 인증정보가 존재할 때에 이 화면으로 넘어온다.
    $_SESSION['eXSignOn.session.userid'] 에는 인증서버의 설정에 따라
    사용자의 인증정보가 단일 String 혹은 JSONString 형태로 들어오게 되는데, 넘어온 정보를 핸들링하여 연계시스템에 로그인시키면 된다.
    */

    // TO DO...


    ?>

</head>
<body>
<form action="/dongaLogin" method="post" name="forms">
    <input type="hidden" name="err_cd" value="<?php echo $_GET['err_cd']?>">
    <input type="hidden" name="msg" value="<?php echo $_GET['err_msg'] ?>">
    <input type="hidden" name="accounts" value="<?php echo $eXSignOnUserId->user_num ?>">
    <input type="hidden" name="account" value="<?php echo KISA_SET_DATA($eXSignOnUserId->user_num) ?>">
    <input type="hidden" name="name" value="<?php echo $eXSignOnUserId->user_nm ? KISA_SET_DATA($eXSignOnUserId->user_nm) : '-' ?>">
    <input type="hidden" name="university" value="<?php echo $eXSignOnUserId->up_dpt_nm ? KISA_SET_DATA($eXSignOnUserId->up_dpt_nm) : '-' ?>">
    <input type="hidden" name="department" value="<?php echo KISA_SET_DATA('-') ?>">
    <input type="hidden" name="grade" value="<?php echo KISA_SET_DATA('-') ?>">
    <input type="hidden" name="phone_number" value="<?php echo $eXSignOnUserId->hp_tel ? KISA_SET_DATA($eXSignOnUserId->hp_tel) : '-' ?>">
    <input type="hidden" name="number" value="<?php echo KISA_SET_DATA('-')?>">
    <input type="hidden" name="academic" value="<?php echo KISA_SET_DATA('-') ?>">
    <input type="hidden" name="email" value="<?php echo $eXSignOnUserId->email ? KISA_SET_DATA($eXSignOnUserId->email) : '-' ?>">
    <input type="hidden" name="year" value="<?php echo $eXSignOnUserId->birth ? KISA_SET_DATA($eXSignOnUserId->birth) : '-' ?>">
    <input type="hidden" name="line" value="<?php echo KISA_SET_DATA('-') ?>">
    <input type="hidden" name="grade_score" value="<?php echo KISA_SET_DATA('-') ?>">
    <input type="hidden" name="gender" value="<?php echo $eXSignOnUserId->sex ? KISA_SET_DATA($eXSignOnUserId->sex) : '-' ?>">
    <input type="hidden" name="type" value="<?php echo $eXSignOnUserId->user_div_nm ? KISA_SET_DATA($eXSignOnUserId->user_div_nm) : '-' ?>">
    <input type="hidden" name="token" value="<?php echo $eXSignOnUserId->dau_token?>">


    <script>
        document.forms.submit();
    </script>
</form>
</body>
</html>
