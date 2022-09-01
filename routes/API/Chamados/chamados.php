<?php

use App\Http\Response;
use App\Controller\Chamados;

$obRouter->get('/chamados', [
    'middlewares' => [
        'required-logout'
    ],
    function () {
        return new Response(200, Chamados\ChamadosController::getChamados());
    }
]);

$obRouter->post('/chamados', [
    'middlewares' => [
        'required-logout'
    ],
    function () {
        return new Response(200, Chamados\ChamadosController::postInsert());
    }
]);

$obRouter->patch('/chamados/{id}', [
    'middlewares' => [
        'required-logout'
    ],
    function ($id) {
        return new Response(200, Chamados\ChamadosController::patchAceite($id));
    }
]);
