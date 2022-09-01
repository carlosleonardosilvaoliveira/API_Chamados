<?php

namespace App\Http\Middleware;

use App\Session\Session as SessionLogin;

class RequireLogin
{
    public function handle ($request, $next)
    {
        if(!SessionLogin::isLogged()) {
            //$request->getRouter()->redirect('/');

            json_encode(array(
                'status'    => false,
                'message'   => "Usuario nao esta logado"
            ));
        }

        return $next($request);
    }
}