<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/*',
        'stripe/*',
        'https//'.DONGA_NAME.'/login',
        'https//'.DONGA_NAME.'/exsignon/sso/sso_loginuser.php',
        '/exsignon/sso/sso_loginuser.php',
        '/login/*'

    ];
}
