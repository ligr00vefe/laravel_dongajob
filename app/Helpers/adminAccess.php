<?php

class dongaAdminAccess
{

    /**
     * 입장가능한 아이피 체크
     * @return bool true : 입장가능, false : 입장불가
     */
    public function isAccess($ip): bool
    {
        return request()->ip() == $ip;
    }

}
