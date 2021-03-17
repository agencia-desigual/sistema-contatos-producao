<?php

// NameSpace
namespace Controller;

// Importações
use Helper\Apoio;
use Model\Empresa;
use Sistema\Controller;

// Inicia a Classe
class Financeiro extends Controller
{
    // Objetos
    private $objModelFinanceiro;
    private $objHelperApoio;
    private $objModelEmpresa;

    // Método construtor
    public function __construct()
    {
        // Inicia o construtor pai
        parent::__construct();

        // Instancia os objetos
        $this->objModelFinanceiro= new \Model\Financeiro();
        $this->objHelperApoio = new Apoio();
        $this->objModelEmpresa = new Empresa();

    } // End >> fun::__construct()



    /**
     * Método responsável por responsável por carregar a página de
     * todas as notas financeiras.
     * -------------------------------------------------------------------
     * @url financeiros
     * @method GET
     */
    public function listar()
    {

        // Verifica se está logado
        $usuario = $this->objHelperApoio->seguranca();

        // Variaveis
        $dados = null;
        $notas = null;
        $empresas = null;

        // Busca as notas
        $notas = $this->objModelFinanceiro
            ->get()->fetchAll(\PDO::FETCH_OBJ);

        // Verifica se tem notas
        if (!empty($notas))
        {
            // Percorre todos as notas
            foreach ($notas as $nota)
            {
                // Busca a empresa
                $empresa = $this->objModelEmpresa
                    ->get(["id_cliente" => $nota->id_cliente])
                    ->fetch(\PDO::FETCH_OBJ);

                // Vincula a empresa
                $nota->empresa = $empresa->nome;

                // Formata o valor
                $nota->valor = number_format($nota->valor,2,",",".");

                if (!empty($nota->arquivo))
                {
                    $nota->arquivo = BASE_STORAGE . 'financeiro/' . $nota->arquivo;
                }
            }
        }

        // Dados da view
        $dados = [
            "notas" => $notas,
            "js" => [
                "modulos" => ["Nota"]
            ]
        ];

        // Carrega a view
        $this->view("painel/financeiro/listar",$dados);
    }



    /**
     * Método responsável por responsável por carregar a página de
     * adicionar uma nota financeira.
     * -------------------------------------------------------------------
     * @url financeiro/adicionar
     * @method GET
     */
    public function adicionar()
    {

        // Verifica se está logado
        $usuario = $this->objHelperApoio->seguranca();

        // Variaveis
        $dados = null;
        $empresas = null;

        // Busca todas as empresa
        $empresas = $this->objModelEmpresa
            ->get()
            ->fetchAll(\PDO::FETCH_OBJ);

        // Dados da view
        $dados = [
            "empresas" => $empresas,
            "js" => [
                "modulos" => ["Nota"]
            ]
        ];

        // Carrega a view
        $this->view("painel/financeiro/adicionar",$dados);
    }



    /**
     * Método responsável por responsável por carregar a página de
     * editar uma nota financeira.
     * -------------------------------------------------------------------
     * @url financeiro/editar/{id}
     * @method GET
     */
    public function editar($id)
    {

        $dados = null;
        $empresas = null;
        $nota = null;

        // Verifica se está logado
        $usuario = $this->objHelperApoio->seguranca();

        // Busca a nota selecionada
        $nota = $this->objModelFinanceiro
            ->get(["id_financeiro" => $id])
            ->fetch(\PDO::FETCH_OBJ);

        // Verifica se encontrou
        if (!empty($nota))
        {
            // Busca as empresas
            $empresas = $this->objModelEmpresa
                ->get()
                ->fetchAll(\PDO::FETCH_OBJ);

            // Formata o valor
            $nota->valor = number_format($nota->valor,2,",",".");

            // Formata a data
            $nota->data = date('Y-m-d', strtotime($nota->data));

            if (!empty($nota->arquivo))
            {
                $nota->arquivo = BASE_STORAGE . 'financeiro/' . $nota->arquivo;
            }

        }

        // Dados da view
        $dados = [
            "nota" => $nota,
            "empresas" => $empresas,
            "js" => [
                "modulos" => ["Nota"]
            ]
        ];

        // Carrega a view
        $this->view("painel/financeiro/editar",$dados);
    }



} // End >> Class::Financeiro