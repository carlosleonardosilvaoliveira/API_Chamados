<?php

namespace App\Model\Authentication;

use App\core\Database;

class Usuario
{
    public $id;
    public $matricula;
    public $nome;
    public $data_criacao;
    public $grupo;

    /**
     * Método responsável por pesquisar no banco um usuário pela matricula
     * 
     * Return String
     */
    public static function getUserByMatricula ($matricula)
    {
        return (new Database("Table_User"))->select("matricula = '{$matricula}'")->fetchObject(self::class);
    }

    /**
     * Método responsável para a autenticação LDAP
     * 
     * Return boolean
     */
    public static function postLdap ($matricula, $senha)
    {
        try {

            $ldapuri = "LDAP://df0000sr759.corp.caixa.gov.br";
            $ldapconn = ldap_connect($ldapuri) or die("Não conectado no LDAP.");

            ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
            ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);

            $dominio = "CORPCAIXA\\";

            $bind = @ldap_bind($ldapconn, $dominio.$matricula, $senha);
            if($bind) {

                $filter = "(samaccountname={$matricula})";
                $attr = array("cn");
                $result = ldap_search($ldapconn, "OU=Usuarios,OU=CAIXA,DC=corp,DC=caixa,DC=gov,DC=br", $filter, $attr) or exit("Erro no search!");
                $entries = ldap_get_entries($ldapconn, $result);

                foreach($entries as $value) {
                    $_SESSION['nome'] = $value['cn'][0];
                }

                return true;
            }

            return false;

        } catch (Exception $e) {
            throw new Exception ("Ocorreu um erro: " .$e->getMessage(), 1);
        }
    }
}