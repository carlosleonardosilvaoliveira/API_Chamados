<?php

namespace App\Model\Usuario;

use App\core\Database;

class Usuarios
{
    public $id;
    public $matricula;
    public $nome;
    public $data_criacao;
    public $grupo;

    public static function getUsuarios ($where = null, $order = null, $limit = null, $fields = '*')
    {
        return (new Database('Table_User'))->select($where, $order, $limit, $fields);
    }

    public static function getUsuariosById ($id)
    {
        return self::getUsuarios("id = '{$id}'")->fetchObject(self::class);
    }

    public function inserirUsuario ()
    {
        $this->id = (new Database('Table_User'))->insert([
            'matricula'     => $this->matricula,
            'nome'          => $this->nome,
            'data_criacao'  => $this->data_criacao,
            'grupo'         => $this->grupo
        ]);

        return true;
    }

    public function patchUsuario ()
    {
        return (new Database('Table_User'))->update("id = '{$this->id}'",[
            'matricula'     => $this->matricula,
            'nome'          => $this->nome,
            'data_criacao'  => $this->data_criacao,
            'grupo'         => $this->grupo
        ]);
    }

    public function deleteUsuario ()
    {
        return (new Database('Table_User'))->delete("id = '{$this->id}'");
    }
}