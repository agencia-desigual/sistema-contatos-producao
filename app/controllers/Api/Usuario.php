<?php

// NameSpace
namespace Controller\Api;

// Importações
use Helper\Apoio;
use Sistema\Controller;
use Sistema\Helper\Input;
use Sistema\Helper\Seguranca;

// Inicia a Classe
class Usuario extends Controller
{
    // Objetos
    private $objModelUsuario;
    private $objHelperApoio;
    private $objSeguranca;


    // Inicia o contrutor
    public function __construct()
    {
        // Chama o pai
        parent::__construct();

        // Instancia os objetos
        $this->objModelUsuario = new \Model\Usuario();
        $this->objHelperApoio = new Apoio();
        $this->objSeguranca = new Seguranca();

    } // End >> fun::__construct()



    /**
     * Método responsável por realizar o login de um
     * determinado usuário.
     * ------------------------------------------------
     * @method POST
     * @url api/usuario/login
     */
    public function login()
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $token = null;
        $dadosLogin = null;

        // Recupera os dados de login
        $dadosLogin = $this->objSeguranca->getDadosLogin();

        // Criptografa a senha
        $dadosLogin["senha"] = md5($dadosLogin["senha"]);

        // Monta a query
        $where = [
            "email" => $dadosLogin["usuario"],
            "senha" => $dadosLogin["senha"]
        ];

        // Busca o usuário
        $usuario = $this->objModelUsuario
            ->get($where)
            ->fetch(\PDO::FETCH_OBJ);

        // Verifica se encontrou o usuário
        if(!empty($usuario))
        {
            // Verifica se o usuáiro está ativo
            if($usuario->status == true)
            {
                // Gera um token
                $token = $this->objSeguranca->getToken($usuario->id_usuario);

                // Verifica se gerou um token
                if($token != false)
                {
                    // Remove a senha
                    unset($usuario->senha);

                    // Array de retorno
                    $dados = [
                        "tipo" => true,
                        "code" => 200,
                        "mensagem" => "Sucesso! Aguarde...",
                        "objeto" => [
                            "usuario" => $usuario,
                            "token" => $token
                        ]
                    ];
                }
                else
                {
                    // Msg
                    $dados = ["mensagem" => "Ocorreu um erro ao gerar o token"];

                } // Error >> Erro ao gerar token
            }
            else
            {
                // Msg
                $dados = ["mensagem" => "Sua conta foi desativada. Entre em contato com o suporte para saber o motivo."];

            } // Error >> Usuário desativado
        }
        else
        {
            // Msg
            $dados = ["mensagem" => "E-mail ou senha informados estão incorretos."];
        } // Error - Dados incorretos

        // Retorno
        $this->api($dados);

    } // End >> fun::login()



    /**
     * Método responsável por retornar um usuario especifico e suas
     * FK, deve ser informado via paramento o ID do item.
     * -----------------------------------------------------------------
     * @param $id
     * -----------------------------------------------------------------
     * @author igorcacerez
     * @url api/usuario/get/[ID]
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
        $where = ["id_usuario" => $id];

        // Busca o objeto
        $objeto = $this->objModelUsuario->get($where);

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
     * Método responsável por retornar todos os usuários cadastrados
     * no sistema, podendo informar a ordem, limit e where.
     * -----------------------------------------------------------------
     * @author igorcacerez
     * -----------------------------------------------------------------
     * @url api/usuario/get
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
        $objeto = $this->objModelUsuario
            ->get($where, $ordem, ($inicio . "," . $limite))
            ->fetchAll(\PDO::FETCH_OBJ);

        // Total
        $total = $this->objModelUsuario
            ->get($where)
            ->rowCount();

        // Verifica se retornou algo
        if(!empty($objeto))
        {
            // Percorro os objetos
            foreach ($objeto as $obj)
            {
                // Remove informações
                unset($obj->senha);
                unset($obj->status);
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
     * Método responsável por inserir um determinado usuário
     * no sistema.
     * -----------------------------------------------------------------
     * @url api/usuario/insert
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
            !empty($post["email"]) &&
            !empty($post["senha"]))
        {
            // Criptografa a senha
            $post["senha"] = md5($post["senha"]);

            // Insere o objeto
            $obj = $this->objModelUsuario
                ->insert($post);

            // Verifica se inseriu
            if(!empty($obj))
            {
                // Busca o objeto inserido
                $obj = $this->objModelUsuario
                    ->get(["id_usuario" => $obj])
                    ->fetch(\PDO::FETCH_OBJ);

                // Retorno
                $dados = [
                    "tipo" => true,
                    "code" => 200,
                    "mensagem" => "Item inserido com sucesso.",
                    "objeto" => $obj
                ];
            }
            else
            {
                // Msg
                $dados = ["mensagem" => "Ocorreu um erro ao adicionar."];
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
     * usuário cadastrado no sistema.
     * -------------------------------------------------------------------
     * @param $id [Id do usuário a ser alterado]
     * -------------------------------------------------------------------
     * @url api/usuario/update/[ID]
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
        unset($put["id_usuario"]);

        // Busca o objeto atual
        $obj = $this->objModelUsuario
            ->get(["id_usuario" => $id])
            ->fetch(\PDO::FETCH_OBJ);

        // Verifiva se encontrou
        if(!empty($obj))
        {
            // Verifica se está alterando alguma coisa
            if(!empty($put))
            {
                // Verifica se informou uma senha
                if(!empty($put["senha"]))
                {
                    // Verifica se vai alterar a senha
                    if(md5($put["senha"]) != $obj->senha && !empty($put["re_senha"]))
                    {
                        // Verifica se a senhas conferem
                        if($put["senha"] == $put["re_senha"])
                        {
                            // Criptografa
                            $put["senha"] = md5($put["senha"]);
                        }
                        else
                        {
                            // Api
                            $this->api(["mensagem" => "Senhas informadas não conferem."]);
                        } // Error >> Senhas informadas não conferem.
                    }
                    else
                    {
                        // Remove a senha
                        unset($put["senha"]);
                    }
                }

                // Remove o repete senha
                unset($put["re_senha"]);

                // Altera as informações
                if($this->objModelUsuario->update($put, ["id_usuario" => $id]) != false)
                {
                    // Busca o objeto alterado
                    $objAlterado = $this->objModelUsuario
                        ->get(["id_usuario" => $id])
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
     * Método responsável por deletar um determinado usuário cadastrado
     * no sistema, desde que não seja ele mesmo.
     * -------------------------------------------------------------------
     * @param $id [Id do usuário a ser deletado]
     * -------------------------------------------------------------------
     * @url api/usuario/delete/[ID]
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

        // Verifica se o usuário não é o mesmo
        if($usuario->id_usuario != $id)
        {
            // Busca o objeto a ser deletado
            $obj = $this->objModelUsuario
                ->get(["id_usuario" => $id])
                ->fetch(\PDO::FETCH_OBJ);

            // Deleta o usuário
            if($this->objModelUsuario->delete(["id_usuario" => $id]) != false)
            {
                // Retorno
                $dados = [
                    "tipo" => true,
                    "code" => 200,
                    "mensagem" => "O usuário foi deletado.",
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
            $dados = ["mensagem" => "Você não pode se ato deletar."];
        } // Error >> Você não pode se ato deletar.

        // Api
        $this->api($dados);

    } // End >> fun::delete()

} // End >> Class::Usuario