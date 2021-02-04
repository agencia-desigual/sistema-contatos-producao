<?php

// NameSpace
namespace Controller;

// Importações
use Helper\Apoio;
use Sistema\Controller;

// Inicia a Classe
class Fornecedor extends Controller
{
    // Objetos
    private $objModelFornecedor;
    private $objHelperApoio;

    // Método construtor
    public function __construct()
    {
        // Inicia o construtor pai
        parent::__construct();

        // Instancia os objetos
        $this->objModelFornecedor = new \Model\Fornecedor();
        $this->objHelperApoio = new Apoio();

    } // End >> fun::__construct()



    /**
     * Método responsável por responsável por carregar a página de
     * todas os fornecedores.
     * -------------------------------------------------------------------
     * @url fornecedores
     * @method GET
     */
    public function listar()
    {

        // Verifica se está logado
        $usuario = $this->objHelperApoio->seguranca();

        // Variaveis
        $dados = null;
        $fornecedores = null;

        // Busca os fornecedores
        $fornecedores = $this->objModelFornecedor
            ->get()->fetchAll(\PDO::FETCH_OBJ);

        // Dados da view
        $dados = [
            "fornecedores" => $fornecedores
        ];

        // Carrega a view
        $this->view("painel/fornecedor/listar",$dados);
    }



} // End >> Class::Fornecedor