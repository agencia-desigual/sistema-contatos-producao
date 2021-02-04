<?php

// NameSpace
namespace Controller;

// Importações
use Helper\Apoio;
use Sistema\Controller;

// Inicia a Classe
class Categoria extends Controller
{
    // Objetos
    private $objModelCategoria;
    private $objHelperApoio;

    // Método construtor
    public function __construct()
    {
        // Inicia o construtor pai
        parent::__construct();

        // Instancia os objetos
        $this->objModelCategoria = new \Model\Categoria();
        $this->objHelperApoio = new Apoio();

    } // End >> fun::__construct()



    /**
     * Método responsável por responsável por carregar a página de
     * todas as categorias.
     * -------------------------------------------------------------------
     * @url categorias
     * @method GET
     */
    public function listar()
    {

        // Verifica se está logado
        $usuario = $this->objHelperApoio->seguranca();

        // Variaveis
        $dados = null;
        $categorias = null;

        // Busca as categorias
        $categorias = $this->objModelCategoria
            ->get()->fetchAll(\PDO::FETCH_OBJ);

        // Dados da view
        $dados = [
            "categorias" => $categorias
        ];

        // Carrega a view
        $this->view("painel/categoria/listar",$dados);
    }



    /**
     * Método responsável por responsável por carregar a página de
     * adicionar categoria.
     * -------------------------------------------------------------------
     * @url categoria/adicionar
     * @method GET
     */
    public function adicionar()
    {

        // Verifica se está logado
        $usuario = $this->objHelperApoio->seguranca();

        // Variaveis
        $dados = null;

        // Dados da view
        $dados = [
            "js" => [
                "modulos" => ["Categoria"]
            ]
        ];

        // Carrega a view
        $this->view("painel/categoria/adicionar",$dados);
    }



    /**
     * Método responsável por responsável por carregar a página de
     * editar categoria.
     * -------------------------------------------------------------------
     * @url categoria/editar/{id}
     * @method GET
     */
    public function editar($id)
    {

        // Verifica se está logado
        $usuario = $this->objHelperApoio->seguranca();

        // Busca a categoria selecionada
        $categoria = $this->objModelCategoria
            ->get(["id_categoria" => $id])
            ->fetchAll(\PDO::FETCH_OBJ);

        // Variaveis
        $dados = null;

        // Dados da view
        $dados = [
            "categoria" => $categoria,
            "js" => [
                "modulos" => ["Categoria"]
            ]
        ];

        // Carrega a view
        $this->view("painel/categoria/adicionar",$dados);
    }



} // End >> Class::Categoria