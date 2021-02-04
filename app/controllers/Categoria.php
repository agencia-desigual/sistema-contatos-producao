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



} // End >> Class::Categoria