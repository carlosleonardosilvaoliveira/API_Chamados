<?php

namespace App\Model\Entity;

use App\core\Database;

class Chamados
{
    public $id;
    public $nome_solicitante;
    public $matricula_solicitante;
    public $motivo_solicitacao;
    public $data_solicitacao;
    public $grupo_inicial;
    public $telefone_solicitante;
    public $hora_solicitacao;
    public $n_chamado;
    public $status_chamado;
    public $tecnico_aceite;
    public $nome_tecnico_aceite;
    public $data_aceite;
    public $hora_aceite;
    public $motivo_transferencia;
    public $tecnico_transferencia;
    public $nome_tecnico_transferencia;
    public $data_transferencia;
    public $hora_transferencia;
    public $data_aceite_transferencia;
    public $hora_aceite_transferencia;
    public $grupo_final;
    public $data_encerramento;
    public $hora_encerramento;
    public $observacao_encerramento;
    public $data_confirma_encerramento;
    public $hora_confirma_encerramento;
    
    public static function getChamados ($where = null, $order = null, $limit = null, $fields = '*')
    {
        return (new Database('Table_Chamados'))->select($where, $order, $limit, $fields);
    }

    public static function getChamadosById ($id)
    {
        return self::getChamados("id = '{$id}'")->fetchObject(self::class);
    }
    
    public function postInsert ()
    {
        $this->id = (new Database('Table_Chamados'))->insert([
            'nome_solicitante'      => $this->nome_solicitante,
            'matricula_solicitante' => $this->matricula_solicitante,
            'telefone_solicitante'  => $this->telefone_solicitante,
            'motivo_solicitacao'    => $this->motivo_solicitacao,
            'data_solicitacao'      => $this->data_solicitacao,
            'hora_solicitacao'      => $this->hora_solicitacao,
            'n_chamado'             => $this->n_chamado,
            'grupo_inicial'         => $this->grupo_inicial,
            'status_chamado'        => $this->status_chamado
        ]);

        return true;
    }

    public function patchAceite ()
    {
        return (new Database('Table_Chamados'))->update("id = '{$this->id}'",[
            'status_chamado'            => $this->status_chamado,
            'tecnico_aceite'            => $this->tecnico_aceite,
            'nome_tecnico_aceite'       => $this->nome_tecnico_aceite,
            'data_aceite'               => $this->data_aceite,
            'hora_aceite'               => $this->hora_aceite,
            'motivo_transferencia'      => $this->motivo_transferencia,
            'data_transferencia'        => $this->data_transferencia,
            'hora_transferencia'        => $this->hora_transferencia,
            'tecnico_transferencia'     => $this->tecnico_transferencia,
            'nome_tecnico_transferencia'=> $this->nome_tecnico_transferencia,
            'data_aceite_transferencia' => $this->data_aceite_transferencia,
            'hora_aceite_transferencia' => $this->hora_aceite_transferencia,
            'grupo_inicial'             => $this->grupo_inicial,
            'grupo_final'               => $this->grupo_final,
            'data_encerramento'         => $this->data_encerramento,
            'hora_encerramento'         => $this->hora_encerramento,
            'observacao_encerramento'   => $this->observacao_encerramento,
            'data_confirma_encerramento'=> $this->data_confirma_encerramento,
            'hora_confirma_encerramento'=> $this->hora_confirma_encerramento
        ]);
    }

}