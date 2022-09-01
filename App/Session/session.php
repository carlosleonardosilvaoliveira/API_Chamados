<?php

namespace App\Session;

class Session
{
    private static function init ()
    {
        if(session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public static function login ($obUser)
    {
        self::init();

        $_SESSION['usuario'] = [
            'id'            => $obUser->id,
            'matricula'     => $obUser->matricula,
            'nome'          => $obUser->nome,
            'data_criacao'  => $obUser->data_criacao,
            'grupo'         => $obUser->grupo
        ];

        return true;
    }

    public static function isLogged ()
    {
        self::init();

        return isset($_SESSION['usuario']['id']);
    }

    public static function logout ()
    {
        self::init();

        unset($_SESSION['usuario']);

        return true;
    }
}