<?php

use App\Http\Response;
use App\Controller\Login;

$obRouter->get('/login', [
    'middlewares' => [
        'required-logout'
    ],
    function ($request, $matricula) {
        return new Response(200, Login\LoginController::setLogin($request, $matricula));
    }
]);

$obRouter->post('/login', [
    'middlewares' => [
        'required-logout'
    ],
    function ($request, $matricula) {
        return new Response(200, Login\LoginController::setLogin($request, $matricula));
    }
]);

$obRouter->get('/logout', [
    'middlewares' => [
        'required-login'
    ],
    function ($request) {
        return new Response (200, Login\LoginController::setLogout($request));
    }
]);