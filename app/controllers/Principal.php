<?php

// NameSpace
namespace Controller;

// Importações
use Helper\Apoio;
use Model\Categoria;
use Sistema\Controller;

// Inicia a Classe
class Principal extends Controller
{
    // Objetos
    private $objModelCategora;
    private $objHelperApoio;

    // Método construtor
    public function __construct()
    {
        // Inicia o construtor pai
        parent::__construct();

        // Instancia os objetos
        $this->objModelCategora = new Categoria();
        $this->objHelperApoio = new Apoio();

    } // End >> fun::__construct()



    public function index()
    {

    }




    /**
     * Método responsável por responsável por gerar uma página onde
     * o usuário poderar realizar o login no sistema. Caso o usuário
     * já esteja logado ele é redirecionado a página principal do painel
     * -------------------------------------------------------------------
     * @url login
     * @method GET
     */
    public function login()
    {
        // Variaveis
        $dados = null;

        // Verifica se não existe session ativa
        if(empty($_SESSION["usuario"]))
        {
            // Dados
            $dados = [
                "js" => [
                    "modulos" => ["Usuario"]
                ]
            ];

            // Chama a view
            $this->view("painel/acesso/login", $dados);
        }
        else
        {
            // Redireciona o usuário para a dashboard
            header("Location: " . BASE_URL . "painel");

        } // O usuário já está logado

    } // End >> fun::login()



    /**
     * Método responsável por destruir a sessão
     * de um usuário logado e mandar para a página inicial
     * do site.
     * ------------------------------------------------------
     * @url sair
     * @method GET
     */
    public function sair()
    {
        // Destroi a session
        session_destroy();

        // Chama a view
        $this->view("painel/acesso/sair");

    } // End >> fun::sair()



    /**
     * Método responsável por exibir uma página de erro
     * 404 quando o usuário acessar alguma url que não existe.
     * -----------------------------------------------------------
     * @url (Qualquer Url que não exista rota definida)
     * @method GET
     */
    public function error()
    {
        // Chama a view
        $this->view("error/404");

    } // End >> fun::error()

} // End >> Class::Principal