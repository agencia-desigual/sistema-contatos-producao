<?php

// NameSpace
namespace Controller\Api;

// Importações
use Sistema\Controller;
use Sistema\Helper\Input;
use Sistema\Helper\Seguranca;

// Inicia a Classe
class Fornecedor extends Controller
{
    // Objetos
    private $objModelFornecedor;
    private $objModelCategoria;
    private $objSeguranca;

    // Método construtor
    public function __construct()
    {
        // Instancia o construtor do pai
        parent::__construct();

        // Instancia os objetos
        $this->objModelFornecedor = new \Model\Fornecedor();
        $this->objModelCategoria = new \Model\Categoria();
        $this->objSeguranca = new Seguranca();

    } // End >> fun::__construct()


    /**
     * Método responsável por retornar um fornecedor especifico e suas
     * FK, deve ser informado via paramento o ID do item.
     * -----------------------------------------------------------------
     * @param $id
     * -----------------------------------------------------------------
     * @author igorcacerez
     * @url api/fornecedor/get/[ID]
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
        $where = ["id_fornecedor" => $id];

        // Busca o objeto
        $objeto = $this->objModelFornecedor->get($where);

        // Fetch
        $total = $objeto->rowCount();
        $objeto = $objeto->fetch(\PDO::FETCH_OBJ);

        // Verifica se retornou algo
        if(!empty($objeto))
        {
            // Busca a categoria
            $objeto->categoria = $this->objModelCategoria
                ->get(["id_categoria" => $objeto->id_categoria])
                ->fetch(\PDO::FETCH_OBJ);
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
     * Método responsável por retornar todos os fornecedores cadastrados
     * no sistema, podendo informar a ordem, limit e where.
     * -----------------------------------------------------------------
     * @author igorcacerez
     * -----------------------------------------------------------------
     * @url api/fornecedor/get
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
        $total = $this->objModelFornecedor
            ->get($where)
            ->rowCount();

        // Verifica se retornou algo
        if(!empty($objeto))
        {
            // Percorre os objetos retornados
            foreach ($objeto as $obj)
            {
                // Busca a categoria
                $obj->categoria = $this->objModelCategoria
                    ->get(["id_categoria" => $obj->id_categoria])
                    ->fetch(\PDO::FETCH_OBJ);
            }
        }

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
        if(!empty($post["nome"]) &&
            !empty($post["id_categoria"]) &&
            !empty($post["telefone"]) &&
            !empty($post["cidade"]))
        {
            // Busca a categoria
            $categoria = $this->objModelCategoria
                ->get(["id_categoria" => $post["id_categoria"]])
                ->fetch(\PDO::FETCH_OBJ);

            // Verifica se a categoria existe
            if(!empty($categoria))
            {
                // Insere o objeto
                $obj = $this->objModelFornecedor
                    ->insert($post);

                // Verifica se inseriu
                if(!empty($obj))
                {
                    // Busca o objeto inserido
                    $obj = $this->objModelFornecedor
                        ->get(["id_fornecedor" => $obj])
                        ->fetch(\PDO::FETCH_OBJ);

                    // Retorno
                    $dados = [
                        "tipo" => true,
                        "code" => 200,
                        "mensagem" => "Fornecedor inserido com sucesso.",
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
                $dados = ["mensagem" => "A categoria informada não existe ou foi deletada."];
            } // Error >> A categoria informada não existe ou foi deletada.
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

        // Remove os dados n alteraveis
        unset($put["id_fornecedor"]);

        // Busca o objeto atual
        $obj = $this->objModelFornecedor
            ->get(["id_fornecedor" => $id])
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
                    $objAlterado = $this->objModelFornecedor
                        ->get(["id_fornecedor" => $id])
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
        $usuario = null;

        // Seguranca
        $usuario = $this->objSeguranca->security();

        // Busca o objeto a ser deletado
        $obj = $this->objModelFornecedor
            ->get(["id_fornecedor" => $id])
            ->fetch(\PDO::FETCH_OBJ);

        // Verifica se existe
        if(!empty($obj))
        {
            // Deleta o usuário
            if($this->objModelFornecedor->delete(["id_fornecedor" => $id]) != false)
            {
                // Retorno
                $dados = [
                    "tipo" => true,
                    "code" => 200,
                    "mensagem" => "O fornecedor foi deletado com sucesso.",
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
            $dados = ["mensagem" => "O fornecedor informado não existe ou já foi deletado."];
        } // Error >> O fornecedor informado não existe ou já foi deletado.

        // Api
        $this->api($dados);

    } // End >> fun::delete()

} // End >> Class::Fornecedor