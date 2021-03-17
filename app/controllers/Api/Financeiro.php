<?php

// NameSpace
namespace Controller\Api;

// Importações
use Sistema\Controller;
use Sistema\Helper\File;
use Sistema\Helper\Seguranca;

// Inicia a Classe
class Financeiro extends Controller
{
    // Objetos
    private $objModelFinanceiro;
    private $objModelEmpresa;
    private $objSeguranca;

    // Método contrutor
    public function __construct()
    {
        // Chama o pai
        parent::__construct();

        // Instancia o objeto
        $this->objModelFinanceiro = new \Model\Financeiro();
        $this->objModelEmpresa = new \Model\Empresa();
        $this->objSeguranca = new Seguranca();

    } // End >> fun::__construct()


    /**
     * Método responsável por inserir uma determinada nota
     *  financeira no banco de dados.
     * ---------------------------------------------------------
     * @url api/financeiro/insert
     * @method POST
     */
    public function insert()
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $empresa = null;
        $post = $_POST;
        $salva = null;

        // Recupera o usuário logado
        $usuario = $this->objSeguranca->security();

        // Busca a empresa
        $empresa = $this->objModelEmpresa
            ->get(["id_cliente" => $post['id_cliente']])
            ->fetch(\PDO::FETCH_OBJ);

        // Verifica se a empresa existe
        if(!empty($empresa))
        {

            // Limpa o valor
            $post["valor"] = str_replace(".","", $post["valor"]);
            $post["valor"] = str_replace(",",".", $post["valor"]);

            // Monta a array de insert
            $salva = [
                "id_cliente" => $post['id_cliente'],
                "valor" => $post['valor'],
                "data" => $post['data']
            ];

            // Verifica se informou o arquivo
            if(!empty($_FILES["arquivo"]) && $_FILES["arquivo"]["size"] > 0)
            {
                // Instancia o objeto
                $objFile = new File();

                // Caminho
                $caminho = "./storage/financeiro/";

                // Verifica se o caminho informado não existe
                if(!is_dir($caminho))
                {
                    // Cria a pasta do caminho
                    mkdir($caminho, 0777, true);
                }

                // Seta as configurações
                $objFile->setStorange($caminho);
                $objFile->setMaxSize(10 * MB);
                $objFile->setFile($_FILES["arquivo"]);

                // Verifica se o tamanho está dentro do limite
                if($objFile->validaSize())
                {
                    // Realiza o upload
                    $arquivo = $objFile->upload();

                    // Verifica se fez o uplaod
                    if(!empty($arquivo))
                    {
                        // Monta o array de inserção
                        $salva["arquivo"] = $arquivo;
                    }
                    else
                    {
                        // Msg
                        $this->api(["mensagem" => "Ocorreu um erro ao salvar o arquivo"]);
                    } // Error >> Ocorreu um erro ao salvar o arquivo
                }
                else
                {
                    // Msg
                    $this->api(["mensagem" => "Informe um arquivo de no máximo 10MB"]);
                } // Error >> Informe um arquivo de no máximo 10MB
            }

            // Salva no banco
            if ($this->objModelFinanceiro->insert($salva))
            {
                // Retorno de sucesso.
                $dados = [
                    "tipo" => true,
                    "code" => 200,
                    "mensagem" => "Nota financeira cadastrada com sucesso!."
                ];
            }
            else
            {
                // Msg
                $dados = ["mensagem" => "Erro ao inserir nota financeira."];
            } // Error >> Erro ao inserir nota financeira.


        }
        else
        {
            // Msg
            $dados = ["mensagem" => "A empresa não existente."];
        } // Error >> Modelo informado não existente.

        // Retorno
        $this->api($dados);

    } // End >> fun::insert()


    /**
     * Método responsável por inserir uma determinada nota
     *  financeira no banco de dados.
     * ---------------------------------------------------------
     * @url api/financeiro/update/id
     * @method POST
     */
    public function update($idFinanceiro)
    {
        // Variaveis
        $dados = null;
        $post = $_POST;
        $update = null;

        // Recupera o usuário logado
        $usuario = $this->objSeguranca->security();

        // Busca a nota
        $nota = $this->objModelFinanceiro
            ->get(["id_financeiro" => $idFinanceiro])
            ->fetch(\PDO::FETCH_OBJ);


        if (!empty($nota))
        {

            // Limpa o valor
            $post["valor"] = str_replace(".","", $post["valor"]);
            $post["valor"] = str_replace(",",".", $post["valor"]);

            // Monta a array de insert
            $update = [
                "id_cliente" => (!empty($post['id_cliente']) ? $post['id_cliente'] : $nota->id_cliente),
                "valor" => (!empty($post['valor']) ? $post['valor'] : $nota->valor),
                "data" => (!empty($post['data']) ? $post['data'] : $nota->data),
            ];

            // Verifica se informou o arquivo
            if(!empty($_FILES["arquivo"]) && $_FILES["arquivo"]["size"] > 0)
            {
                // Instancia o objeto
                $objFile = new File();

                // Caminho
                $caminho = "./storage/financeiro/";

                // Verifica se o caminho informado não existe
                if(!is_dir($caminho))
                {
                    // Cria a pasta do caminho
                    mkdir($caminho, 0777, true);
                }

                // Seta as configurações
                $objFile->setStorange($caminho);
                $objFile->setMaxSize(10 * MB);
                $objFile->setFile($_FILES["arquivo"]);

                // Verifica se o tamanho está dentro do limite
                if($objFile->validaSize())
                {
                    // Realiza o upload
                    $arquivo = $objFile->upload();

                    // Verifica se fez o uplaod
                    if(!empty($arquivo))
                    {
                        // Monta o array de inserção
                        $update["arquivo"] = $arquivo;

                        if (!empty($nota->arquivo))
                        {
                            // Remove o arquivo antigo
                            unlink("./storage/financeiro/" . $nota->arquivo);
                        }

                    }
                    else
                    {
                        // Msg
                        $this->api(["mensagem" => "Ocorreu um erro ao salvar o arquivo"]);
                    } // Error >> Ocorreu um erro ao salvar o arquivo
                }
                else
                {
                    // Msg
                    $this->api(["mensagem" => "Informe um arquivo de no máximo 10MB"]);
                } // Error >> Informe um arquivo de no máximo 10MB
            }

            // Atualiza no banco
            if ($this->objModelFinanceiro->update($update,["id_financeiro" => $idFinanceiro]))
            {
                // Retorno de sucesso.
                $dados = [
                    "tipo" => true,
                    "code" => 200,
                    "mensagem" => "Nota financeira alterada com sucesso!."
                ];
            }
            else
            {
                // Msg
                $dados = ["mensagem" => "Erro ao alterar nota financeira."];
            } // Error >> Erro ao inserir nota financeira.
        }
        else
        {
            // Msg
            $dados = ["mensagem" => "Nota financeira não encontrada."];
        } // Error >> ota financeira não encontrada.

        // Retorno
        $this->api($dados);

    } // End >> fun::update()


    /**
     * Método responsável por deletar uma foto armazenada no
     * servidor eo seu registro no banco de dados.
     * ---------------------------------------------------------
     * @param $idFoto
     * ---------------------------------------------------------
     * @url api/financeiro/delete/[ID]
     * @method DELETE
     */
    public function delete($idFinanceiro)
    {
        // Variaveis
        $dados = null;
        $obj = null;
        $usuario = null;

        // Seguranca
        $usuario = $this->objSeguranca->security();

        // Busca o objeto a ser deletado
        $obj = $this->objModelFinanceiro
            ->get(["id_financeiro" => $idFinanceiro])
            ->fetch(\PDO::FETCH_OBJ);

        // Verifica se o objeto existe
        if(!empty($obj))
        {
            // Deleta a imagem
            if($this->objModelFinanceiro->delete(["id_financeiro" => $idFinanceiro]) != false)
            {

                // Deleta o arquivo do servidor
                if (!empty($obj->arquivo))
                {
                    // Remove o arquivo
                    unlink("./storage/financeiro/" . $obj->arquivo);
                }


                // Retorno de sucesso.
                $dados = [
                    "tipo" => true,
                    "code" => 200,
                    "mensagem" => "Nota financeira deletada com sucesso."
                ];
            }
            else
            {
                // Msg
                $dados = ["mensagem" => "Ocorreu um erro ao deletar a nota financeira."];
            } // Error >> Ocorreu um erro ao deletar a nota financeira.
        }
        else
        {
            // Msg
            $dados = ["mensagem" => "A nota financeira informada não existe ou já foi deletada."];
        } // Error >> A nota financeira informada não existe ou já foi deletada.

        // retorno
        $this->api($dados);

    } // End >> fun::delete()

} // End >> Class::Financeiro