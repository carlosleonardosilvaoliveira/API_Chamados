<?php

namespace App\Controller\Usuario;

use App\Model\Usuario\Usuarios as ListaUsuarios;

class UsuarioController
{

    /**
     * Método responsável por retornar os dados dos usuários no banco de dados
     * 
     * Return json
     */
    public static function getUsuarios ()
    {
        $usuariosArray              = array();
        $usuariosArray["contas"]    = array();

        $results = ListaUsuarios::getUsuarios(null, null, null);

        while ($row = $results->fetchObject(ListaUsuarios::class)) {

            $e = array(
                'id'            => $row->id,
                'matricula'     => $row->matricula,
                'nome'          => $row->nome,
                'data_criacao'  => $row->data_criacao,
                'grupo'         => $row->grupo
            );

            array_push($usuariosArray["contas"], $e);
        }

        return json_encode($usuariosArray);
    }

    /**
     * Método responsável por retornar apenas um valor de usuário do banco de dados pesquisando pela ID
     * 
     * Return json
     */
    public static function getUsuariosPorId ($id)
    {
        $usuariosArray              = array();
        $usuariosArray["contas"]    = array();

        $results = ListaUsuarios::getUsuariosById($id);

        if(!$results instanceof ListaUsuarios) {
            $e = array(
                'message'   => "Conta de usuário não encontrada!"
            );

            array_push($usuariosArray["contas"], $e);

            return json_encode($usuariosArray);

        } else {
            $results->deleteUsuario();

            $e = array(
                'id'            => $results->id,
                'matricula'     => $results->matricula,
                'nome'          => $results->nome,
                'data_criacao'  => $results->data_criacao,
                'grupo'         => $results->grupo
            );

            array_push($usuariosArray["contas"], $e);

            return json_encode($usuariosArray);
        }
    }

    /**
     * Método responsável por registrar usuário no banco de dados
     * 
     * Return json
     */
    public function postUsuarios ()
    {
        $usuariosArray              = array();
        $usuariosArray["contas"]    = array();

        $results = new ListaUsuarios();

        $input = json_decode(file_get_contents('php://input'), TRUE);

        $results->matricula     = $input['matricula'] ?? '';
        $results->nome          = $input['nome'] ?? '';
        $results->data_criacao  = $input['data_criacao'] ?? '';
        $results->grupo         = $input['grupo'] ?? '';
        $results->inserirUsuario();

        $e = array(
            'matricula'     => $results->matricula,
            'nome'          => $results->nome,
            'data_criacao'  => $results->data_criacao,
            'grupo'         => $results->grupo
        );

        array_push($usuariosArray["contas"], $e);

        return json_encode($usuariosArray);
    }

    /**
     * Método responsável por atualizar usuário do banco de dados
     * 
     * Return json
     */
    public function patchUsuarios ($id)
    {
        $usuariosArray              = array();
        $usuariosArray["contas"]    = array();

        $results = ListaUsuarios::getUsuariosById($id);

        $input = json_decode(file_get_contents('php://input'), TRUE);

        $results->matricula     = $input['matricula'] ?? $results->matricula;
        $results->nome          = $input['nome'] ?? $results->nome;
        $results->data_criacao  = $input['data_criacao'] ?? $results->data_criacao;
        $results->grupo         = $input['grupo'] ?? $results->grupo;
        $results->patchUsuario();

        $e = array(
            'matricula'     => $results->matricula,
            'nome'          => $results->nome,
            'data_criacao'  => $results->data_criacao,
            'grupo'         => $results->grupo
        );

        array_push($usuariosArray["contas"], $e);

        return json_encode($usuariosArray);
    }

    /**
     * Método responsável por deletar um usuário do banco de dados
     * 
     * Return json
     */
    public function deleteUsuarios ($id)
    {
        $usuariosArray              = array();
        $usuariosArray["contas"]    = array();

        $results = ListaUsuarios::getUsuariosById($id);

        if(!$results instanceof ListaUsuarios) {
            $e = array(
                'message'   => "Conta de usuário não encontrada!"
            );

            array_push($usuariosArray["contas"], $e);

            return json_encode($usuariosArray);

        } else {
            $results->deleteUsuario();

            $e = array(
                'message'   => "Conta de usuário deletada"
            );

            array_push($usuariosArray["contas"], $e);

            return json_encode($usuariosArray);
        }
    }
}