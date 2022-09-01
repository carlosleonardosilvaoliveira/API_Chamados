## Features
- Integrado com LDAP server - para a autenticação de usuários
- Namespace para evitar conflitos de nomes
- Utilizando Composer para o Autoload de classes

## Quem vai utilizar o sistema
Técnico de campo que vai solicitar ajuda ao setor responsável para realização do seu atendimento.

## Para os desenvolvedores:
Caso você esteja na dúvida de como criar uma página nova para novas funções segue um exemplo simples onde primeiro iremos criar o arquivo PHP dentro da pasta Model

Deves criar um .htaccess ou web.config dependendo de onde for usa-lo

## Model:
```php
<?php
//namespace para o Composer efetuar o Autoload e caso tenha mais subpastas adicione na linha
namespace PastaRaiz\subpasta;

//Importe o banco de dados, nesse projeto ele está nesse caminho
use App\core\Database;

//inicie a classe a ser utilizada
class NomedaClasseModel
{
    //Crie as variáveis no escopo da classe
    public $exemplo;

    //Crie as funções da classe
    public function nomeDaFuncao ()
    {
        //Exemplo de return para o select:
        /*
        Antes você deve adicionar essas variáveis e os valores delas como parâmetro: 
        $where = null, $order = null, $limit = null, $fields = '*'
        */

        //Exemplo de return para o insert:
        /*
        $this->id = (new Database('NOME DA TABELA'))->insert([
            'NOME DA COLUNA DO BANCO' => $this->NOME DA VARIAVEL NO ESCOPO
        ]);

        //E sempre retornando um boleano
        return true;
        */ 

        //Exemplo de return para o update:
        /*
        return (new Database('NOME DA TABELA'))->update("id = '{$this->id}'",[
            'NOME DA COLUNA DO BANCO' => $this->NOME DA VARIAVEL NO ESCOPO
        ]);
        */
    }

}

```

## Controller:
```php
//Agora iremos criar outro arquivo para o controller por que trabalhamos com a arquitetura MVC

//namespace para o Composer efetuar o Autoload e caso tenha mais subpastas adicione na linha
namespace PastaRaiz\subpasta;

//Importe o Model e coloque o caminho que você declarou o namespace do Model
use App\Model\Subpasta\NomeDaClasse;

//Inicie a classe que será usada
class NomeDaClasseController
{
    //Como as variaveis que vão receber os valores já está no escopo do Model não é necessário ter variaveís no Controller

    //Vamos criar a função GET
    public static function getNOMEDAFUNCAO ()
    {
        //Como estamos trabalhando com JSON precisamos armazenar o JSON num array
        $NOMEDAVARIAVEL = array();
        $NOMEDAVARIAVEL["NOME DO CORPO DO ARRAY"] = array(); 

        //Para que funcione o GET devemos instanciar a classe do model que você importou no use, exemplo:
        $results = NomeDaClasse::getChamados(null, null, null);

        //Um laço de repetição para listar as informações do banco de dados
        while ($row = $results->fetchObject(NomeDaClasse::class)) {

            //Deves criar um variavel local para adicionar o array com as informações do banco de dados, exemplo:
            $e = array(
                'id'    => $row->id
            );

            //E utilizar o array_push para incorporar o array $e para a $NOMEDAVARIAVEL["NOME DO CORPO DO ARRAY"]
            array_push($NOMEDAVARIAVEL["NOME DO CORPO DO ARRAY"], $e);
        }

        //E por ultimo retornar em JSON o resultado dessa função
        return json_encode($NOMEDAVARIAVEL);
    }

    //Função POST
    public function postNOMEDAFUNCAO ()
    {
        //Como estamos trabalhando com JSON precisamos armazenar o JSON num array
        $NOMEDAVARIAVEL = array();
        $NOMEDAVARIAVEL["NOME DO CORPO DO ARRAY"] = array(); 

        //Para que funcione o POST devemos instanciar a classe do model que foi importada no use, exemplo:
        $results = new NomeDaClasse();

        //Para pegar os valores dos inputs que o front vai mandar deve usar:
        $NOMEDAVARIAVEL = json_decode(file_get_contents('php://input'), TRUE);

        //E agora tens que declarar as variáveis que vão receber os valores dos inputs
        $results->NOMEDACOLUNA = $NOMEDAVARIAVEL['NAMEQUEFICOUNOINPUT'];

        //É necessário colocar o nome da função que vai salvar no banco
        $results->postNOMEDAFUNCAO();

        //Deves criar um variavel local para adicionar o array com as informações do banco de dados, exemplo:
        $e = array(
            'id'    => $row->id
        );

        //E utilizar o array_push para incorporar o array $e para a $NOMEDAVARIAVEL["NOME DO CORPO DO ARRAY"]
        array_push($NOMEDAVARIAVEL["NOME DO CORPO DO ARRAY"], $e);

        //E por ultimo retornar em JSON o resultado dessa função
        return json_encode($NOMEDAVARIAVEL);
    }

    //Função PATCH
    public function patchNOMEDAFUNCAO ()
    {
        //Como estamos trabalhando com JSON precisamos armazenar o JSON num array
        $NOMEDAVARIAVEL = array();
        $NOMEDAVARIAVEL["NOME DO CORPO DO ARRAY"] = array(); 

        //Para que funcione o PATCH devemos instanciar a classe do model que foi importada no use, porem com a função que busque um identificador no banco pela item, irei usar o id nesse exemplo:
        $results = NomeDaClasse::getNOMEDACLASSE($id);

        //Para pegar os valores dos inputs que o front vai mandar deve usar:
        $NOMEDAVARIAVEL = json_decode(file_get_contents('php://input'), TRUE);

        //E agora tens que declarar as variáveis que vão receber os valores dos inputs
        $results->NOMEDACOLUNA = $NOMEDAVARIAVEL['NAMEQUEFICOUNOINPUT'];

        //É necessário colocar o nome da função que vai salvar no banco
        $results->patchNOMEDAFUNCAO();

        //Deves criar um variavel local para adicionar o array com as informações do banco de dados, exemplo:
        $e = array(
            'id'    => $row->id
        );

        //E utilizar o array_push para incorporar o array $e para a $NOMEDAVARIAVEL["NOME DO CORPO DO ARRAY"]
        array_push($NOMEDAVARIAVEL["NOME DO CORPO DO ARRAY"], $e);

        //E por ultimo retornar em JSON o resultado dessa função
        return json_encode($NOMEDAVARIAVEL);
    }

    //Função DELETE
    public function deleteNOMEDAFUNCAO ()
    {
        //Como estamos trabalhando com JSON precisamos armazenar o JSON num array
        $NOMEDAVARIAVEL = array();
        $NOMEDAVARIAVEL["NOME DO CORPO DO ARRAY"] = array(); 

        //Para que funcione o DELETE devemos instanciar a classe do model que foi importada no use, porem com a função que busque um identificador no banco pela item, irei usar o id nesse exemplo:
        $results = NomeDaClasse::getNOMEDACLASSE($id);

        //Verificaremos se existe algum item no banco de dados, dessa forma:
        if (!$results instanceof NomeDaClasse) {

            //Deves criar um variavel local para adicionar o array com as informações que iremos retornar para o front, exemplo:
            $e = array(
                'mensagem'    => "Não existe nenhum resultado no banco!"
            );

            //E utilizar o array_push para incorporar o array $e para a $NOMEDAVARIAVEL["NOME DO CORPO DO ARRAY"]
            array_push($NOMEDAVARIAVEL["NOME DO CORPO DO ARRAY"], $e);

            //E por ultimo retornar em JSON o resultado dessa função
            return json_encode($NOMEDAVARIAVEL);

        } else {

            //Senão devemos utilizar a função de DELETE do model
            $results->deleteNOMEDAFUNCAO();

            ///Deves criar um variavel local para adicionar o array com as informações que iremos retornar para o front, exemplo:
            $e = array(
                'mensagem'    => "Registro deletado do banco de dados!"
            );

            //E utilizar o array_push para incorporar o array $e para a $NOMEDAVARIAVEL["NOME DO CORPO DO ARRAY"]
            array_push($NOMEDAVARIAVEL["NOME DO CORPO DO ARRAY"], $e);

            //E por ultimo retornar em JSON o resultado dessa função
            return json_encode($NOMEDAVARIAVEL);
        }
    }
}

```
## Rotas: 

```php
//E por último devemos criar as rotas para que a mágica funcione

//Ideal seria criar arquivos de rotas para cada funcionalidade separadamente (Para a melhor organização), como por exemplo: Função de login iremos criar a rota de login apenas

//Primeiramente devemos importar o Response (para retornar código 200) e o controller que contem as funções
use App\Http\Response;
use App\Controller\NomeDaPasta;

//Primeiro iremos criar a rota de GET, depois as outras.
//As rotas sempre terão esse padrão:
$obRouter->get('/NomeDaRota', [
    function () {
        return new Response(200, NomeDaPasta\NomeDaClasseController::getNomeDaFuncao());
    }
]);

//Rotas de POST
$obRouter->post('/NomeDaRota', [
    function () {
        return new Response(200, NomeDaPasta\NomeDaClasseController::postNomeDaFuncao());
    }
]);

//Rotas de PATCH devem ter a informação do identificador eu irei utilizar o id como exemplo
$obRouter->patch('/NomeDaRota/{id}', [
    function () {
        return new Response(200, NomeDaPasta\NomeDaClasseController::patchNomeDaFuncao());
    }
]);

//Rotas de DELETE devem ter a informação do identificador eu irei utilizar o id como exemplo
$obRouter->delete('/NomeDaRota/{id}', [
    function () {
        return new Response(200, NomeDaPasta\NomeDaClasseController::deleteNomeDaFuncao());
    }
]);

?>
```