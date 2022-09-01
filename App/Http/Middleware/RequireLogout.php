<?php

namespace App\Http\Middleware;

use App\Session\Session as SessionLogin;

class RequireLogout
{
    public function handle ($request, $next)
    {
        if(SessionLogin::isLogged()) {
            //$request->getRouter()->redirect('/index');

            json_encode(array(
                'status'    => true,
                'message'   => "Usuario ja esta logado"
            ));
        }

        return $next($request);
    }
}