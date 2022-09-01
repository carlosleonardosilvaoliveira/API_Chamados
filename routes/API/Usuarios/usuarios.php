<?php

use App\Http\Response;
use App\Controller\Usuario;

$obRouter->get('/usuarios', [
    'middlewares' => [
        'required-logout'
    ],
    function () {
        return new Response(200, Usuario\UsuarioController::getUsuarios());
    }
]);

$obRouter->get('/usuarios/{id}', [
    'middlewares' => [
        'required-logout'
    ],
    function ($id) {
        return new Response(200, Usuario\UsuarioController::getUsuariosPorId($id));
    }
]);

$obRouter->post('/usuarios', [
    'middlewares' => [
        'required-logout'
    ],
    function () {
        return new Response(200, Usuario\UsuarioController::postUsuarios());
    }
]);

$obRouter->patch('/usuarios/{id}', [
    'middlewares' => [
        'required-logout'
    ],
    function ($id) {
        return new Response(200, Usuario\UsuarioController::patchUsuarios($id));
    }
]);

$obRouter->delete('/usuarios/{id}', [
    'middlewares' => [
        'required-logout'
    ],
    function ($id) {
        return new Response(200, Usuario\UsuarioController::deleteUsuarios($id));
    }
]);