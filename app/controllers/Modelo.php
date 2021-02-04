<?php

// NameSpace
namespace Controller;

// Importações
use Helper\Apoio;
use Sistema\Controller;

// Inicia a Classe
class Modelo extends Controller
{
    // Objetos
    private $objModelModelo;
    private $objHelperApoio;

    // Método construtor
    public function __construct()
    {
        // Inicia o construtor pai
        parent::__construct();

        // Instancia os objetos
        $this->objModelModelo = new \Model\Modelo();
        $this->objHelperApoio = new Apoio();

    } // End >> fun::__construct()



    /**
     * Método responsável por responsável por carregar a página de
     * todas os modelos.
     * -------------------------------------------------------------------
     * @url modelos
     * @method GET
     */
    public function listar()
    {

        // Verifica se está logado
        $usuario = $this->objHelperApoio->seguranca();

        // Variaveis
        $dados = null;
        $modelos = null;

        // Busca os fornecedores
        $modelos = $this->objModelModelo
            ->get()->fetchAll(\PDO::FETCH_OBJ);

        // Verifica se tem modelo
        if (!empty($modelos))
        {
            // Percorre todos os modelos
            foreach ($modelos as $modelo)
            {
                // Calculando a idade
                $modelo->idade = date("Y") - date("Y",strtotime($modelo->dataNascimento));
            }
        }

        // Dados da view
        $dados = [
            "modelos" => $modelos
        ];

        // Carrega a view
        $this->view("painel/modelo/listar",$dados);
    }



} // End >> Class::Modelo