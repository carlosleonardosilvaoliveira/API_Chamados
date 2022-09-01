<?php

namespace App\Controller\Login;

use App\Model\Authentication\Usuario;
use App\Model\Usuario\Usuarios as ListaUsuarios;
use App\Session\Session as SessionLogin;

class LoginController
{

    /**
     * Método responsável por receber os valores dos inputs e verificar no LDAP e autenticar, caso o usuário não esteja no banco de dados
     * então será criado um usuário no banco e registrado no grupo como 'Campo'
     * 
     * Return json
     */
    public static function setLogin ($request, $matricula)
    {
        $usuariosArray              = array();
        $usuariosArray["usuarios"]  = array();

        $input = json_decode(file_get_contents('php://input'), TRUE);

        $matricula          = $input['matricula'] ?? '';
        $senha              = $input['senha'] ?? '';

        $ldap = Usuario::postLdap($matricula, $senha);

        if($ldap) {

            $results = Usuario::getUserByMatricula($matricula);

            if(!$results instanceof Usuario) {

                date_default_timezone_set('America/Sao_Paulo');
                $diaAtual = date('d/m/Y');

                $usuariosArray              = array();
                $usuariosArray["usuarios"]    = array();

                $results = new ListaUsuarios();

                $results->matricula     = ucfirst($input['matricula']);
                $results->nome          = $_SESSION['nome'];
                $results->data_criacao  = $diaAtual;
                $results->grupo         = "Campo";
                $results->inserirUsuario();

                $e = array(
                    'status'        => true,
                    'matricula'     => $results->matricula,
                    'nome'          => $results->nome,
                    'data_criacao'  => $results->data_criacao,
                    'grupo'         => $results->grupo,
                    'message'       => "Usuário de campo cadastrado"
                );

                array_push($usuariosArray["usuarios"], $e);

                return json_encode($usuariosArray);
            }

            $results->matricula = $matricula;

            SessionLogin::login($results);

            $e = array(
                'status'        => true,
                'matricula'     => $results->matricula,
                'nome'          => $results->nome,
                'data_criacao'  => $results->data_criacao,
                'grupo'         => $results->grupo
            );

            array_push($usuariosArray["usuarios"], $e);

            return json_encode($usuariosArray);

        } else {

            $e = array(
                'status'    => false,
                'message'   => "Usuario e/ou senha incorretos!"
            );

            array_push($usuariosArray["usuarios"], $e);

            return json_encode($usuariosArray);
        }
    }

    /**
     * Método responsável por fazer logout limpando a sessão atual
     * 
     * Return json  
     */
    public static function setLogout ($request)
    {
        /*echo "<pre>";
        print_r($_SESSION);
        echo "</pre>"; exit;*/

        SessionLogin::logout();

        $usuariosArray              = array();
        $usuariosArray["usuarios"]  = array();

        $e = array(
            'status'    => false,
            'message'   => "Usuario deslogado."
        );

        array_push($usuariosArray["usuarios"], $e);

        return json_encode($usuariosArray);
    }
}