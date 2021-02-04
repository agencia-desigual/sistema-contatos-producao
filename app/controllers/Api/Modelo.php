<?php

// NameSpace
namespace Controller\Api;

// Importações
use Model\Foto;
use Sistema\Controller;
use Sistema\Helper\File;
use Sistema\Helper\Input;
use Sistema\Helper\Seguranca;

// Inicia a Classe
class Modelo extends Controller
{
    // Objetos
    private $objModelModelo;
    private $objModelFoto;
    private $objSeguranca;

    // Método construtor
    public function __construct()
    {
        // Intancia o construtor da classe pai
        parent::__construct();

        // Instancia os objetos
        $this->objModelModelo = new \Model\Modelo();
        $this->objModelFoto = new Foto();
        $this->objSeguranca = new Seguranca();

    } // End >> fun::__construct()


    /**
     * Método responsável por retornar um modelo especifico e suas
     * FK, deve ser informado via paramento o ID do item.
     * -----------------------------------------------------------------
     * @param $id
     * -----------------------------------------------------------------
     * @author igorcacerez
     * @url api/modelo/get/[ID]
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
        $where = ["id_modelo" => $id];

        // Busca o objeto
        $objeto = $this->objModelModelo->get($where);

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
     * Método responsável por retornar todos os modelos cadastrados
     * no sistema, podendo informar a ordem, limit e where.
     * -----------------------------------------------------------------
     * @author igorcacerez
     * -----------------------------------------------------------------
     * @url api/modelo/get
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
        $objeto = $this->objModelModelo
            ->get($where, $ordem, ($inicio . "," . $limite))
            ->fetchAll(\PDO::FETCH_OBJ);

        // Total
        $total = $this->objModelModelo
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
     * Método responsável por inserir um determinado modelo
     * no sistema.
     * -----------------------------------------------------------------
     * @url api/modelo/insert
     * @method POST
     */
    public function insert()
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $obj = null;
        $post = null;
        $salvaFile = null;

        // Recupera os dados post
        $post = $_POST;

        // Verifica o tipo de inclusao
        if(!empty($post["canal"]) && $post["canal"] == "sistema")
        {
            // Verifica se está logado
            $usuario = $this->objSeguranca->security();
        }

        // Verifica se informou os dados obrigatórios
        if(!empty($post["nome"]) &&
            !empty($post["sexo"]) &&
            !empty($post["dataNascimento"]) &&
            !empty($post["cidade"]) &&
            !empty($post["estado"]))
        {
            // Verifica se inseriu uma imagem
            if(!empty($_FILES["arquivo"]) && $_FILES["arquivo"]["size"] > 0)
            {
                // Instancia o objeto
                $objFile = new File();

                // Caminho
                $caminho = "./storage/fotos/";

                // Verifica se o caminho informado não existe
                if(!is_dir($caminho))
                {
                    // Cria a pasta do caminho
                    mkdir($caminho, 0777, true);
                }

                // Seta as configurações
                $objFile->setStorange($caminho);
                $objFile->setMaxSize(5 * MB);
                $objFile->setFile($_FILES["arquivo"]);
                $objFile->setExtensaoValida(["jpg","png","jpeg","gif"]);

                // Verifica se o tamanho está dentro do limite
                if($objFile->validaSize())
                {
                    // Verifica se a extenção da imagem é correta
                    if($objFile->validaExtensao())
                    {
                        // Realiza o upload
                        $arquivo = $objFile->upload();

                        // Verifica se fez o uplaod
                        if(!empty($arquivo))
                        {
                            // Add a imagem
                            $salvaFile = ["imagem" => $arquivo];
                        }
                        else
                        {
                            // Msg
                            $this->api(["mensagem" => "Ocorreu um erro ao salvar a imagem"]);
                        } // Error >> Ocorreu um erro ao salvar a imagem
                    }
                    else
                    {
                        // Msg
                        $this->api(["mensagem" => "O arquivo enviado não é uma imagem."]);
                    } // Error >> O arquivo enviado não é uma imagem.
                }
                else
                {
                    // Msg
                    $this->api(["mensagem" => "Informe uma imagem de no máximo 5MB"]);
                } // Error >> Informe uma imagem de no máximo 5MB
            }
            else
            {
                // Verifica o canal
                if($post["canal"] == "site")
                {
                    // O arquivo é obrigatório
                    $this->api(["mensagem" => "Informe uma foto sua."]);
                }
            }


            // Insere o objeto
            $obj = $this->objModelModelo
                ->insert($post);

            // Verifica se inseriu
            if(!empty($obj))
            {
                // Busca o objeto inserido
                $obj = $this->objModelModelo
                    ->get(["id_modelo" => $obj])
                    ->fetch(\PDO::FETCH_OBJ);

                // Verifica se possui imagem
                if(!empty($salvaFile))
                {
                    // Adiciona o id da modelo
                    $salvaFile["id_modelo"] = $obj->id_modelo;

                    // Insere no banco
                    $this->objModelFoto
                        ->insert($salvaFile);
                }

                // Retorno
                $dados = [
                    "tipo" => true,
                    "code" => 200,
                    "mensagem" => "Modelo inserido com sucesso.",
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
     * modelo cadastrado no sistema.
     * -------------------------------------------------------------------
     * @param $id [Id do modelo a ser alterado]
     * -------------------------------------------------------------------
     * @url api/modelo/update/[ID]
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
        unset($put["id_modelo"]);

        // Busca o objeto atual
        $obj = $this->objModelModelo
            ->get(["id_modelo" => $id])
            ->fetch(\PDO::FETCH_OBJ);

        // Verifiva se encontrou
        if(!empty($obj))
        {
            // Verifica se está alterando alguma coisa
            if(!empty($put))
            {
                // Altera as informações
                if($this->objModelModelo->update($put, ["id_modelo" => $id]) != false)
                {
                    // Busca o objeto alterado
                    $objAlterado = $this->objModelModelo
                        ->get(["id_modelo" => $id])
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
     * Método responsável por deletar um determinado modelo cadastrado
     * no sistema, desde que não possua fks
     * -------------------------------------------------------------------
     * @param $id [Id do modelo a ser deletado]
     * -------------------------------------------------------------------
     * @url api/modelo/delete/[ID]
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
        $obj = $this->objModelModelo
            ->get(["id_modelo" => $id])
            ->fetch(\PDO::FETCH_OBJ);

        // Verifica se existe
        if(!empty($obj))
        {
            // Busca as imagens
            $fotos = $this->objModelFoto
                ->get(["id_modelo" => $id])
                ->fetchAll(\PDO::FETCH_OBJ);

            // Verifica se possui fotos
            if(!empty($fotos))
            {
                // Percorre as fotos salvas
                foreach ($fotos as $foto)
                {
                    // Deleta a foto
                    unlink("./storage/fotos/" . $foto->imagem);
                }

                // Deleta os registros
                $this->objModelFoto
                    ->delete(["id_modelo" => $id]);
            }

            // Deleta o usuário
            if($this->objModelModelo->delete(["id_modelo" => $id]) != false)
            {
                // Retorno
                $dados = [
                    "tipo" => true,
                    "code" => 200,
                    "mensagem" => "Deletado com sucesso.",
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
            $dados = ["mensagem" => "O item informado não existe ou já foi deletado."];
        } // Error >> O item informado não existe ou já foi deletado.

        // Api
        $this->api($dados);

    } // End >> fun::delete()

} // End >> Class::Modelo