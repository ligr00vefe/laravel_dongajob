<?php
function KISA_SET_DATA($data)
{

    $val = '';

    if ($data) {
        $fp = fopen("../include/key.txt", "r");
        $encryption = new Encryption();


        while (!feof($fp)) {
            $key[] = fgets($fp);
        }
        fclose($fp);

        $g_bszUser_key = null;

        if ($key) {
            $g_bszUser_key = $key[0];
            $g_bszIV = $key[1];
        }

        // 2. 헥사값
        $str = $encryption->strToHex($data);
        $str = substr($str, 1, strlen($str));

        //			echo "3. 헥사값을 암호화:";
        $return = $encryption->encrypt($g_bszIV, $g_bszUser_key, $str);

        // 			echo "4. 암호화를 다시 스트링 : ";
        $return = str_replace(",", "", $return);
        $return = $encryption->hexToStr($return);

        //			echo "5. 암호화를 base64_encode : ";
        $val = base64_encode($return);


        //echo "6get. 암호화를 base64_decode : ";
        //$return = base64_decode($return);

        //echo "7. 디코드를 헥사 : ";
        //$return = $encryption->strToHex($return);
        //$return = substr( $return , 1, strlen($return));

        //echo "8. 암호화를 복호화:";
        //$return = $encryption->decrypt($g_bszIV, $g_bszUser_key, $return);

        //echo "9. 복호화를 스트링 : ";
        //$return = str_replace(",","", $return);
        //$return = $encryption->hexToStr($return);

    }


    return $val;
}
