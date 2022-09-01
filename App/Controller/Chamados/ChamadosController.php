<?php

namespace App\Controller\Chamados;

use App\Model\Entity\Chamados as EntityChamados;

class ChamadosController
{

    /**
     * Método responsavel por retornar todos os chamados do banco de dados
     * 
     * Return json
     */
    public static function getChamados ()
    {
        $chamadosArray              = array();
        $chamadosArray["chamados"]  = array();
    
        $results = EntityChamados::getChamados(null, null, null);
    
        while ($row = $results->fetchObject(EntityChamados::class)) {
    
            $e = array(
                'id'                        => $row->id,
                'nome_solicitante'          => $row->nome_solicitante,
                'matricula_solicitante'     => $row->matricula_solicitante,
                'telefone_solicitante'      => $row->telefone_solicitante,
                'motivo_solicitacao'        => $row->motivo_solicitacao,
                'data_solicitacao'          => $row->data_solicitacao,
                'hora_solicitacao'          => $row->hora_solicitacao,
                'grupo_inicial'             => $row->grupo_inicial,
                'status_chamado'            => $row->status_chamado,
                'motivo_transferencia'      => $row->motivo_transferencia,
                'data_transferencia'        => $row->data_transferencia,
                'hora_transferencia'        => $row->hora_transferencia,
                'tecnico_aceite'            => $row->tecnico_aceite,
                'nome_tecnico_aceite'       => $row->nome_tecnico_aceite,
                'nome_tecnico_transferencia'=> $row->nome_tecnico_transferencia,
                'data_aceite'               => $row->data_aceite,
                'hora_aceite'               => $row->hora_aceite,
                'tecnico_transferencia'     => $row->tecnico_transferencia,
                'data_aceite_transferencia' => $row->data_aceite_transferencia,
                'hora_aceite_transferencia' => $row->hora_aceite_transferencia,
                'grupo_final'               => $row->grupo_final,
                'data_encerramento'         => $row->data_encerramento,
                'hora_encerramento'         => $row->hora_encerramento,
                'observacao_encerramento'   => $row->observacao_encerramento,
                'data_confirma_encerramento'=> $row->data_confirma_encerramento,
                'hora_confirma_encerramento'=> $row->hora_confirma_encerramento,
                'n_chamado'                 => $row->n_chamado
            );
    
            array_push($chamadosArray["chamados"], $e);
        }
    
        return json_encode($chamadosArray);
    }

    /**
     * Método responsável por enviar os dados dos inputs para o banco de dados
     * 
     * Return json
     */
    public function postInsert ()
    {
        $chamadosArray              = array();
        $chamadosArray["chamados"]  = array();

        $results = new EntityChamados();

        $input = json_decode(file_get_contents('php://input'), TRUE);

        $results->nome_solicitante      = $input['nome_solicitante'] ?? '';
        $results->matricula_solicitante = $input['matricula_solicitante'] ?? '';
        $results->telefone_solicitante  = $input['telefone_solicitante'] ?? '';
        $results->motivo_solicitacao    = $input['motivo_solicitacao'] ?? '';
        $results->data_solicitacao      = $input['data_solicitacao'] ?? '';
        $results->hora_solicitacao      = $input['hora_solicitacao'] ?? '';
        $results->n_chamado             = $input['n_chamado'] ?? '';
        $results->grupo_inicial         = $input['grupo_inicial'] ?? '';
        $results->status_chamado        = $input['status_chamado'] ?? '';
        $results->postInsert();

        $e = array(
            'nome_solicitante'      => $results->nome_solicitante,
            'matricula_solicitante' => $results->matricula_solicitante,
            'telefone_solicitante'  => $results->telefone_solicitante,
            'motivo_solicitacao'    => $results->motivo_solicitacao,
            'data_solicitacao'      => $results->data_solicitacao,
            'hora_solicitacao'      => $results->hora_solicitacao,
            'n_chamado'             => $results->n_chamado,
            'grupo_inicial'         => $results->grupo_inicial,
            'status_chamado'        => $results->status_chamado
        );
        
        array_push($chamadosArray["chamados"], $e);

        return json_encode($chamadosArray);
    }

    /**
     * Método responsável por atualizar o chamado
     * 
     * Return json
     */
    public function patchAceite ($id)
    {
        $chamadosArray              = array();
        $chamadosArray["chamados"]  = array();

        $results = EntityChamados::getChamadosById($id);

        $input = json_decode(file_get_contents('php://input'), TRUE);

        $results->status_chamado             = $input['status_chamado'] ?? $results->status_chamado;
        $results->nome_tecnico_aceite        = $input['nome_tecnico_aceite'] ?? $results->nome_tecnico_aceite;
        $results->tecnico_aceite             = $input['tecnico_aceite'] ?? $results->tecnico_aceite;
        $results->data_aceite                = $input['data_aceite'] ?? $results->data_aceite;
        $results->hora_aceite                = $input['hora_aceite'] ?? $results->hora_aceite;
        $results->motivo_transferencia       = $input['motivo_transferencia'] ?? $results->motivo_transferencia;
        $results->data_transferencia         = $input['data_transferencia'] ?? $results->data_transferencia;
        $results->hora_transferencia         = $input['hora_transferencia'] ?? $results->hora_transferencia;
        $results->tecnico_transferencia      = $input['tecnico_transferencia'] ?? $results->tecnico_transferencia;
        $results->nome_tecnico_transferencia = $input['nome_tecnico_transferencia'] ?? $results->nome_tecnico_transferencia;
        $results->data_aceite_transferencia  = $input['data_aceite_transferencia'] ?? $results->data_aceite_transferencia;
        $results->hora_aceite_transferencia  = $input['hora_aceite_transferencia'] ?? $results->hora_aceite_transferencia;
        $results->grupo_inicial              = $input['grupo_inicial'] ?? $results->grupo_inicial;
        $results->grupo_final                = $input['grupo_final'] ?? $results->grupo_final;
        $results->data_encerramento          = $input['data_encerramento'] ?? $results->data_encerramento;
        $results->hora_encerramento          = $input['hora_encerramento'] ?? $results->hora_encerramento;
        $results->observacao_encerramento    = $input['observacao_encerramento'] ?? $results->observacao_encerramento;
        $results->data_confirma_encerramento = $input['data_confirma_encerramento'] ?? $results->data_confirma_encerramento;
        $results->hora_confirma_encerramento = $input['hora_confirma_encerramento'] ?? $results->hora_confirma_encerramento;
        $results->patchAceite();

        $e = array(
            'status_chamado'            => $results->status_chamado,
            'tecnico_aceite'            => $results->tecnico_aceite,
            'nome_tecnico_aceite'       => $results->nome_tecnico_aceite,
            'data_aceite'               => $results->data_aceite,
            'hora_aceite'               => $results->hora_aceite,
            'motivo_transferencia'      => $results->motivo_transferencia,
            'data_transferencia'        => $results->data_transferencia,
            'hora_transferencia'        => $results->hora_transferencia,
            'nome_tecnico_transferencia'=> $results->nome_tecnico_transferencia,
            'tecnico_transferencia'     => $results->tecnico_transferencia,
            'data_aceite_transferencia' => $results->data_aceite_transferencia,
            'hora_aceite_transferencia' => $results->hora_aceite_transferencia,
            'grupo_inicial'             => $results->grupo_inicial,
            'grupo_final'               => $results->grupo_final,
            'data_encerramento'         => $results->data_encerramento,
            'hora_encerramento'         => $results->hora_encerramento,
            'observacao_encerramento'   => $results->observacao_encerramento,
            'data_confirma_encerramento'=> $results->data_confirma_encerramento,
            'hora_confirma_encerramento'=> $results->hora_confirma_encerramento
        );
        
        array_push($chamadosArray["chamados"], $e);

        return json_encode($chamadosArray);
    }

}