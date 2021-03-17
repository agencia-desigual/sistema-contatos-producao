<?php

// NameSpace
namespace Controller;

// Importações
use Helper\Apoio;
use Sistema\Controller;

// Inicia a Classe
class Empresa extends Controller
{
    // Objetos
    private $objModelEmpresa;
    private $objHelperApoio;

    // Método construtor
    public function __construct()
    {
        // Inicia o construtor pai
        parent::__construct();

        // Instancia os objetos
        $this->objModelEmpresa = new \Model\Empresa();
        $this->objHelperApoio = new Apoio();

    } // End >> fun::__construct()



    /**
     * Método responsável por responsável por carregar a página de
     * todas as empresas.
     * -------------------------------------------------------------------
     * @url empresas
     * @method GET
     */
    public function listar()
    {

        // Verifica se está logado
        $usuario = $this->objHelperApoio->seguranca();

        // Variaveis
        $dados = null;
        $empresas = null;

        // Busca as empresas
        $empresas = $this->objModelEmpresa
            ->get()->fetchAll(\PDO::FETCH_OBJ);

        // Dados da view
        $dados = [
            "empresas" => $empresas,
            "js" => [
                "modulos" => ["Empresa"]
            ]
        ];

        // Carrega a view
        $this->view("painel/empresa/listar",$dados);

    } // End >> fun::listar()



    /**
     * Método responsável por gerar a página que exibe um formulário
     * para cadastro de uma nova empresa no sistema.
     * -------------------------------------------------------------------
     * @url empresa/adicionar
     * @method GET
     */
    public function adicionar()
    {
        // Seguranca
        $usuario = $this->objHelperApoio->seguranca();

        // Dados
        $dados = [
            "js" => [
                "modulos" => ["Empresa"]
            ]
        ];

        // Chama a view
        $this->view("painel/empresa/adicionar", $dados);

    } // End >> fun::adicionar()



    /**
     * Método responsável por gerar a página que exibe um formulário
     * para editar uma empresa no sistema.
     * -------------------------------------------------------------------
     * @param $id [Id da empresa]
     * -------------------------------------------------------------------
     * @url empresa/editar/[ID]
     * @method GET
     */
    public function editar($id)
    {
        // Seguranca
        $usuario = $this->objHelperApoio->seguranca();

        // Busca a empresa
        $empresa = $this->objModelEmpresa
            ->get(["id_cliente" => $id])
            ->fetch(\PDO::FETCH_OBJ);

        // Verifica se existe
        if(!empty($empresa))
        {
            // Dados
            $dados = [
                "empresa" => $empresa,
                "js" => [
                    "modulos" => ["Empresa"]
                ]
            ];

            // Chama a view
            $this->view("painel/empresa/editar", $dados);
        }
        else
        {
            // Chama o inserir
            $this->adicionar();
        }

    } // End >> fun::editar()

} // End >> Class::Empresa