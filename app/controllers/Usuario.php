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
     * @url usuarios
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
            "usuarios" => $usuarios,
            "js" => [
                "modulos" => ["Usuario"]
            ]
        ];

        // Carrega a view
        $this->view("painel/usuario/listar",$dados);
    }



    /**
     * Método responsável por responsável por carregar a página de
     * adicionar usuario.
     * -------------------------------------------------------------------
     * @url usuario/adicionar
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
                "modulos" => ["Usuario"]
            ]
        ];

        // Carrega a view
        $this->view("painel/usuario/adicionar",$dados);
    }



    /**
     * Método responsável por responsável por carregar a página de
     * editar um usuario.
     * -------------------------------------------------------------------
     * @url usuario/editar/{id}
     * @method GET
     */
    public function editar($id)
    {

        // Verifica se está logado
        $user = $this->objHelperApoio->seguranca();

        // Busca a categoria selecionada
        $usuario = $this->objModelUsuario
            ->get(["id_usuario" => $id])
            ->fetch(\PDO::FETCH_OBJ);

        // Variaveis
        $dados = null;

        // Dados da view
        $dados = [
            "usuario" => $usuario,
            "js" => [
                "modulos" => ["Usuario"]
            ]
        ];

        // Carrega a view
        $this->view("painel/usuario/editar",$dados);
    }



} // End >> Class::Usuario