<?php

// NameSpace
namespace Controller;

// Importações
use Helper\Apoio;
use Sistema\Controller;

// Inicia a Classe
class Usuario extends Controller
{
    // Objetos
    private $objModelUsuario;
    private $objHelperApoio;

    // Método construtor
    public function __construct()
    {
        // Inicia o construtor pai
        parent::__construct();

        // Instancia os objetos
        $this->objModelUsuario = new \Model\Usuario();
        $this->objHelperApoio = new Apoio();

    } // End >> fun::__construct()



    /**
     * Método responsável por responsável por carregar a página de
     * todas os usuarios do sistema.
     * -------------------------------------------------------------------
     * @url fornecedores
     * @method GET
     */
    public function listar()
    {

        // Verifica se está logado
        $usuarioLogado = $this->objHelperApoio->seguranca();

        // Variaveis
        $dados = null;
        $usuarios = null;

        // Busca os usuarios
        $usuarios = $this->objModelUsuario
            ->get()->fetchAll(\PDO::FETCH_OBJ);

        // Dados da view
        $dados = [
            "user" => $usuarioLogado,
            "usuarios" => $usuarios
        ];

        // Carrega a view
        $this->view("painel/usuario/listar",$dados);
    }



} // End >> Class::Usuario