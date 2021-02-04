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
    private $objModelCategoria;
    private $objHelperApoio;

    // Método construtor
    public function __construct()
    {
        // Inicia o construtor pai
        parent::__construct();

        // Instancia os objetos
        $this->objModelFornecedor = new \Model\Fornecedor();
        $this->objModelCategoria = new \Model\Categoria();
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
            "fornecedores" => $fornecedores,
            "js" => [
                "modulos" => ["Fornecedor"]
            ]
        ];

        // Carrega a view
        $this->view("painel/fornecedor/listar",$dados);
    } // End >> fun::listar()



    /**
     * Método responsável por gerar a página que exibe um formulário
     * para cadastro de um novo fornecedor no sistema.
     * -------------------------------------------------------------------
     * @url fornecedor/adicionar
     * @method GET
     */
    public function adicionar()
    {
        // Seguranca
        $usuario = $this->objHelperApoio->seguranca();

        // Busca a categoria
        $categoria = $this->objModelCategoria
            ->get()
            ->fetchAll(\PDO::FETCH_OBJ);

        // Dados
        $dados = [
            "usuario" => $usuario,
            "categorias" => $categoria,
            "js" => [
                "modulos" => ["Fornecedor"]
            ]
        ];

        // Chama a view
        $this->view("painel/fornecedor/adicionar", $dados);

    } // End >> fun::adicionar()



    /**
     * Método responsável por gerar a página que exibe um formulário
     * para cadastro de um novo fornecedor no sistema.
     * -------------------------------------------------------------------
     * @param $id [Id do fornecedor]
     * -------------------------------------------------------------------
     * @url fornecedor/editar/[ID]
     * @method GET
     */
    public function editar($id)
    {
        // Seguranca
        $usuario = $this->objHelperApoio->seguranca();

        // Busca o fornecedor
        $fornecedor = $this->objModelFornecedor
            ->get(["id_fornecedor" => $id])
            ->fetch(\PDO::FETCH_OBJ);

        // Verifica se existe
        if(!empty($fornecedor))
        {
            // Busca a categoria
            $categoria = $this->objModelCategoria
                ->get()
                ->fetchAll(\PDO::FETCH_OBJ);

            // Dados
            $dados = [
                "usuario" => $usuario,
                "fornecedor" => $fornecedor,
                "categorias" => $categoria,
                "js" => [
                    "modulos" => ["Fornecedor"]
                ]
            ];

            // Chama a view
            $this->view("painel/fornecedor/editar", $dados);
        }
        else
        {
            // Chama o inserir
            $this->adicionar();
        }

    } // End >> fun::editar()

} // End >> Class::Fornecedor