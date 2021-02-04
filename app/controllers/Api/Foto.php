<?php

// NameSpace
namespace Controller\Api;

// Importações
use Sistema\Controller;
use Sistema\Helper\File;
use Sistema\Helper\Seguranca;

// Inicia a Classe
class Foto extends Controller
{
    // Objetos
    private $objModelFoto;
    private $objModelModelo;
    private $objSeguranca;

    // Método contrutor
    public function __construct()
    {
        // Chama o pai
        parent::__construct();

        // Instancia o objeto
        $this->objModelFoto = new \Model\Foto();
        $this->objModelModelo = new \Model\Modelo();
        $this->objSeguranca = new Seguranca();

    } // End >> fun::__construct()


    /**
     * Método responsável por inserir uma determinada imagem
     * no servidor e no banco de dados.
     * ---------------------------------------------------------
     * @param $idModelo [Id do modelo]
     * ---------------------------------------------------------
     * @url api/foto/insert/[ID]
     * @method POST
     */
    public function insert($idModelo)
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $modelo = null;

        // Recupera o usuário logado
        $usuario = $this->objSeguranca->security();

        // Busca o modelo
        $modelo = $this->objModelModelo
            ->get(["id_modelo" => $idModelo])
            ->fetch(\PDO::FETCH_OBJ);

        // Verifica se o modelo existe
        if(!empty($modelo))
        {
            // Verifica se informou o arquivo
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
                            // Monta o array de inserção
                            $salva = [
                                "id_modelo" => $idModelo,
                                "imagem" => $arquivo
                            ];

                            // Insere o objeto
                            $obj = $this->objModelFoto
                                ->insert($salva);

                            // Verifica se inseriu
                            if(!empty($obj))
                            {
                                // Retorno
                                $dados = [
                                    "tipo" => true,
                                    "code" => 200,
                                    "mensagem" => "Imagem inserida com sucesso."
                                ];
                            }
                            else
                            {
                                // Msg
                                $dados = ["mensagem" => "Ocorreu um erro ao inserir a imagem."];
                            } // Error >> Ocorreu um erro ao inserir a imagem.
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
                // Msg
                $dados = ["mensagem" => "Imagem não informada."];
            } // Error >> Imagem não informada.
        }
        else
        {
            // Msg
            $dados = ["mensagem" => "Modelo informado não existente."];
        } // Error >> Modelo informado não existente.

        // Retorno
        $this->api($dados);

    } // End >> fun::insert()


    /**
     * Método responsável por deletar uma foto armazenada no
     * servidor eo seu registro no banco de dados.
     * ---------------------------------------------------------
     * @param $idFoto
     * ---------------------------------------------------------
     * @url api/foto/delete/[ID]
     * @method DELETE
     */
    public function delete($idFoto)
    {
        // Variaveis
        $dados = null;
        $obj = null;
        $usuario = null;

        // Seguranca
        $usuario = $this->objSeguranca->security();

        // Busca o objeto a ser deletado
        $obj = $this->objModelFoto
            ->get(["id_foto" => $idFoto])
            ->fetch(\PDO::FETCH_OBJ);

        // Verifica se o objeto existe
        if(!empty($obj))
        {
            // Deleta a imagem
            if($this->objModelFoto->delete(["id_foto" => $idFoto]) != false)
            {
                // Deleta a imagem do servidor
                unlink("./storage/fotos/" . $obj->imagem);

                // Retorno de sucesso.
                $dados = [
                    "tipo" => true,
                    "code" => 200,
                    "mensagem" => "Foto deletada com sucesso."
                ];
            }
            else
            {
                // Msg
                $dados = ["mensagem" => "Ocorreu um erro ao deletar a foto."];
            } // Error >> Ocorreu um erro ao deletar a foto.
        }
        else
        {
            // Msg
            $dados = ["mensagem" => "A imagem informada não existe ou já foi deletada."];
        } // Error >> A imagem informada não existe ou já foi deletada.

        // retorno
        $this->api($dados);

    } // End >> fun::delete()

} // End >> Class::Foto