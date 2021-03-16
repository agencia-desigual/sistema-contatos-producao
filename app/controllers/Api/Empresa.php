<?php

// NameSpace
namespace Controller\Api;

// Importações
use Sistema\Controller;
use Sistema\Helper\Input;
use Sistema\Helper\Seguranca;

// Inicia a Classe
class Empresa extends Controller
{
    // Objetos
    private $objModelEmpresa;
    private $objSeguranca;

    // Método construtor
    public function __construct()
    {
        // Instancia o construtor do pai
        parent::__construct();

        // Instancia os objetos
        $this->objModelEmpresa = new \Model\Empresa();
        $this->objSeguranca = new Seguranca();

    } // End >> fun::__construct()


    /**
     * Método responsável por retornar uma empresa especifico e suas
     * FK, deve ser informado via paramento o ID do item.
     * -----------------------------------------------------------------
     * @param $id
     * -----------------------------------------------------------------
     * @author igorcacerez
     * @url api/empresa/get/[ID]
     * @method GET
     */
    public function get($id)
    {
        // Seguranca
        $this->objSeguranca->security();

        // Variaveis
        $dados = null;
        $objeto = null;
        $where = null;

        // where
        $where = ["id_empresa" => $id];

        // Busca o objeto
        $objeto = $this->objModelEmpresa->get($where);

        // Fetch
        $total = $objeto->rowCount();
        $objeto = $objeto->fetch(\PDO::FETCH_OBJ);

        // Monta o array de retorno
        $dados = [
            "tipo" => true,
            "code" => 200,
            "objeto" => [
                "total" => $total,
                "item" => $objeto,
            ]
        ];

        // Retorna
        $this->api($dados);

    } // End >> fun::get()


    /**
     * Método responsável por retornar todos as empresas cadastrados
     * no sistema, podendo informar a ordem, limit e where.
     * -----------------------------------------------------------------
     * @author igorcacerez
     * -----------------------------------------------------------------
     * @url api/empresa/get
     * @method GET
     */
    public function getAll()
    {
        // Seguranca
        $this->objSeguranca->security();

        // Variaveis
        $dados = null;
        $objeto = null;
        $ordem = null;
        $where = null;

        // Variaveis Paginação
        $pag = (isset($_GET["pag"])) ? $_GET["pag"] : 1;
        $limite = (isset($_GET["limit"])) ? $_GET["limit"] : NUM_PAG;

        // Variveis da busca
        $orderBy = (isset($_GET["order_by"])) ? $_GET["order_by"] : null;
        $orderTipo = (isset($_GET["order_by_type"])) ? $_GET["order_by_type"] : "ASC";

        // Verifica se retornou o where
        $where = (isset($_GET["where"])) ? $_GET["where"] : null;

        // Verifica se foi informado a ordem
        if($orderBy != null)
        {
            // cria a ordem
            $ordem = $orderBy . " " . $orderTipo;
        }

        // Atribui a variável inicio, o inicio de onde os registros vão ser mostrados
        // por página, exemplo 0 à 10, 11 à 20 e assim por diante
        $inicio = ($pag * $limite) - $limite;


        // Busca o Objeto com páginacao
        $objeto = $this->objModelFornecedor
            ->get($where, $ordem, ($inicio . "," . $limite))
            ->fetchAll(\PDO::FETCH_OBJ);

        // Total
        $total = $this->objModelEmpresa
            ->get($where)
            ->rowCount();

        // Monta o array de retorno
        $dados = [
            "tipo" => true,
            "code" => 200,
            "objeto" => [
                "itens" => $objeto,
                "total" => $total,
                "pagina" => $pag,
                "numPaginas" => ($total > 0) ? ceil($total / $pag) : 0
            ]
        ];

        // Retorna
        $this->api($dados);

    } // End >> fun::getAll()


    /**
     * Método responsável por inserir uma determinado empresa
     * no sistema.
     * -----------------------------------------------------------------
     * @url api/empresa/insert
     * @method POST
     */
    public function insert()
    {
        // Variaveis
        $dados = null;
        $obj = null;
        $post = null;

        // Recupera o usuário
        $usuario = $this->objSeguranca->security();

        // Recupera os dados post
        $post = $_POST;

        // Verifica se informou os dados obrigatórios
        if(!empty($post["nome"]))
        {
            // Insere o objeto
            $obj = $this->objModelEmpresa
                ->insert($post);

            // Verifica se inseriu
            if(!empty($obj))
            {
                // Busca o objeto inserido
                $obj = $this->objModelEmpresa
                    ->get(["id_empresa" => $obj])
                    ->fetch(\PDO::FETCH_OBJ);

                // Retorno
                $dados = [
                    "tipo" => true,
                    "code" => 200,
                    "mensagem" => "Empresa cadastrada com sucesso.",
                    "objeto" => $obj
                ];
            }
            else
            {
                // Msg
                $dados = ["mensagem" => "Ocorreu um erro ao adicionar o fornecedor."];
            } // Error >> Ocorreu um erro ao adicionar.
        }
        else
        {
            // Msg
            $dados = ["mensagem" => "Dados obrigatórios não informados"];
        } // Error >> Dados obrigatórios não informados

        // Retorno
        $this->api($dados);

    } // End >> fun::insert()


    /**
     * Método responsável por alterar as informações de um determinado
     * fornecedor cadastrado no sistema.
     * -------------------------------------------------------------------
     * @param $id [Id do fornecedor a ser alterado]
     * -------------------------------------------------------------------
     * @url api/fornecedor/update/[ID]
     * @method PUT
     */
    public function update($id)
    {
        // Variaveis
        $dados = null;
        $put = null;
        $obj = null;
        $objAlterado = null;

        // Seguranca
        $this->objSeguranca->security();

        // Recupera os dados put
        $objInput = new Input();
        $put = $objInput->put();

        // Remove os dados não alteraveis
        unset($put["id_empresa"]);

        // Busca o objeto atual
        $obj = $this->objModelEmpresa
            ->get(["id_empresa" => $id])
            ->fetch(\PDO::FETCH_OBJ);

        // Verifiva se encontrou
        if(!empty($obj))
        {
            // Verifica se está alterando alguma coisa
            if(!empty($put))
            {
                // Altera as informações
                if($this->objModelEmpresa->update($put,["id_empresa " => $obj->id_empresa]))
                {
                    // Busca o objeto alterado
                    $objAlterado = $this->objModelEmpresa
                        ->get(["id_empresa" => $id])
                        ->fetch(\PDO::FETCH_OBJ);

                    // Retorno
                    $dados = [
                        "tipo" => true,
                        "code" => 200,
                        "mensagem" => "Empresa alterada com sucesso.",
                        "objeto" => [
                            "antes" => $obj,
                            "atual" => $objAlterado
                        ]
                    ];
                }
                else
                {
                    // Msg
                    $dados = ["mensagem" => "Ocorreu um erro ao alterar a empresa."];
                } // Error >> Ocorreu um erro ao alterar as informações.
            }
            else
            {
                // Msg
                $dados = ["mensagem" => "Nada está sendo alterado"];
            } // Error >> Nada está sendo alterado
        }
        else
        {
            // Msg
            $dados = ["mensagem" => "Empresa não foi encontrado."];
        } // Error >> Item informado não foi encontrado.

        // Retorno
        $this->api($dados);

    } // End >> fun::update()


    /**
     * Método responsável por deletar um determinado fornecedor cadastrado
     * no sistema.
     * -------------------------------------------------------------------
     * @param $id [Id do fornecedor a ser deletado]
     * -------------------------------------------------------------------
     * @url api/fornecedor/delete/[ID]
     * @method DELETE
     */
    public function delete($id)
    {
        // Variaveis
        $dados = null;
        $obj = null;

        // Seguranca
        $usuario = $this->objSeguranca->security();

        // Busca o objeto a ser deletado
        $obj = $this->objModelEmpresa
            ->get(["id_empresa" => $id])
            ->fetch(\PDO::FETCH_OBJ);

        // Verifica se existe
        if(!empty($obj))
        {
            // Deleta o usuário
            if($this->objModelEmpresa->delete(["id_empresa" => $id]))
            {
                // Retorno
                $dados = [
                    "tipo" => true,
                    "code" => 200,
                    "mensagem" => "A empresa foi deletado com sucesso.",
                    "objeto" => $obj
                ];
            }
            else
            {
                // Msg
                $dados = ["mensagem" => 'Ocorre um erro ao tentar deletar.'];
            } // Error >> Ocorre um erro ao tentar deletar.
        }
        else
        {
            // Msg
            $dados = ["mensagem" => "A empresa informada não existe ou já foi deletado."];
        } // Error >> A empresa informada não existe ou já foi deletado.

        // Api
        $this->api($dados);

    } // End >> fun::delete()

} // End >> Class::Fornecedor