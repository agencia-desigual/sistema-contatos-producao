<?php

// NameSpace
namespace Controller\Api;

// Importações
use Model\Fornecedor;
use Sistema\Controller;
use Sistema\Helper\Input;
use Sistema\Helper\Seguranca;

// Inicia a classe
class Categoria extends Controller
{
    // Objetos
    private $objModelCategoria;
    private $objModelFornecedor;
    private $objSeguranca;

    // Método construtor
    public function __construct()
    {
        // Chama o pai
        parent::__construct();

        // Instancia os objetos
        $this->objModelCategoria = new \Model\Categoria();
        $this->objModelFornecedor = new Fornecedor();
        $this->objSeguranca = new Seguranca();

    } // End >> fun::__construct()


    /**
     * Método responsável por retornar um categoria especifico e suas
     * FK, deve ser informado via paramento o ID do item.
     * -----------------------------------------------------------------
     * @param $id
     * -----------------------------------------------------------------
     * @author igorcacerez
     * @url api/categoria/get/[ID]
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
        $where = ["id_categoria" => $id];

        // Busca o objeto
        $objeto = $this->objModelCategoria->get($where);

        // Fetch
        $total = $objeto->rowCount();
        $objeto = $objeto->fetch(\PDO::FETCH_OBJ);

        // Verifica se retornou algo
        if(!empty($objeto))
        {
            // Remove informações
            unset($objeto->senha);
            unset($objeto->status);
        }

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
     * Método responsável por retornar todos os categorias cadastrados
     * no sistema, podendo informar a ordem, limit e where.
     * -----------------------------------------------------------------
     * @author igorcacerez
     * -----------------------------------------------------------------
     * @url api/categoria/get
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
        $objeto = $this->objModelCategoria
            ->get($where, $ordem, ($inicio . "," . $limite))
            ->fetchAll(\PDO::FETCH_OBJ);

        // Total
        $total = $this->objModelCategoria
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
     * Método responsável por inserir um determinado categoria
     * no sistema.
     * -----------------------------------------------------------------
     * @url api/categoria/insert
     * @method POST
     */
    public function insert()
    {
        // Variaveis
        $dados = null;
        $usuario = null;
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
            $obj = $this->objModelCategoria
                ->insert($post);

            // Verifica se inseriu
            if(!empty($obj))
            {
                // Busca o objeto inserido
                $obj = $this->objModelCategoria
                    ->get(["id_categoria" => $obj])
                    ->fetch(\PDO::FETCH_OBJ);

                // Retorno
                $dados = [
                    "tipo" => true,
                    "code" => 200,
                    "mensagem" => "Categoria inserida com sucesso.",
                    "objeto" => $obj
                ];
            }
            else
            {
                // Msg
                $dados = ["mensagem" => "Ocorreu um erro ao adicionar a categoria."];
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
     * categoria cadastrado no sistema.
     * -------------------------------------------------------------------
     * @param $id [Id do categoria a ser alterado]
     * -------------------------------------------------------------------
     * @url api/categoria/update/[ID]
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

        // Remove os dados n alteraveis
        unset($put["id_categoria"]);

        // Busca o objeto atual
        $obj = $this->objModelCategoria
            ->get(["id_categoria" => $id])
            ->fetch(\PDO::FETCH_OBJ);

        // Verifiva se encontrou
        if(!empty($obj))
        {
            // Verifica se está alterando alguma coisa
            if(!empty($put))
            {
                // Altera as informações
                if($this->objModelCategoria->update($put, ["id_categoria" => $id]) != false)
                {
                    // Busca o objeto alterado
                    $objAlterado = $this->objModelCategoria
                        ->get(["id_categoria" => $id])
                        ->fetch(\PDO::FETCH_OBJ);

                    // Retorno
                    $dados = [
                        "tipo" => true,
                        "code" => 200,
                        "mensagem" => "Informações alteradas com sucesso.",
                        "objeto" => [
                            "antes" => $objAlterado,
                            "atual" => $obj
                        ]
                    ];
                }
                else
                {
                    // Msg
                    $dados = ["mensagem" => "Ocorreu um erro ao alterar as informações."];
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
            $dados = ["mensagem" => "Item informado não foi encontrado."];
        } // Error >> Item informado não foi encontrado.

        // Retorno
        $this->api($dados);

    } // End >> fun::update()


    /**
     * Método responsável por deletar um determinado categoria cadastrado
     * no sistema, desde que não possua fks
     * -------------------------------------------------------------------
     * @param $id [Id do categoria a ser deletado]
     * -------------------------------------------------------------------
     * @url api/categoria/delete/[ID]
     * @method DELETE
     */
    public function delete($id)
    {
        // Variaveis
        $dados = null;
        $obj = null;
        $usuario = null;

        // Seguranca
        $usuario = $this->objSeguranca->security();

        // Busca o objeto a ser deletado
        $obj = $this->objModelCategoria
            ->get(["id_categoria" => $id])
            ->fetch(\PDO::FETCH_OBJ);

        // Verifica se existe
        if(!empty($obj))
        {
            // Verifica se possui FKs
            if($this->objModelFornecedor->get(["id_categoria" => $id])->rowCount() == 0)
            {
                // Deleta o usuário
                if($this->objModelCategoria->delete(["id_categoria" => $id]) != false)
                {
                    // Retorno
                    $dados = [
                        "tipo" => true,
                        "code" => 200,
                        "mensagem" => "A categoria foi deletada.",
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
                $dados = ["mensagem" => "Impossível deletar, existem fornecedores cadastrados nesta categoria."];
            } // Error >> Impossível deletar, existem fornecedores cadastrados nesta categoria.
        }
        else
        {
            // Msg
            $dados = ["mensagem" => "A categoria informada não existe ou já foi deletada."];
        } // Error >> A categoria informada não existe ou já foi deletada.

        // Api
        $this->api($dados);

    } // End >> fun::delete()

} // End >> Class::Categoria