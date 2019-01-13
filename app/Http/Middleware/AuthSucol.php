<?php

namespace App\Http\Middleware;

use Closure;

class AuthSucol
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $SUCOL_ID = config('sucol.id');
        $SUCOL_PW = config('sucol.pw');

        $input_id = $_SERVER['PHP_AUTH_USER'] ?? '';
        $input_pw = $_SERVER['PHP_AUTH_PW'] ?? '';

        if ($SUCOL_ID != $input_id || $SUCOL_PW != $input_pw) {
            header('WWW-Authenticate: Basic realm="Access denied"');
            exit;
        }

        return $next($request);
    }
}
