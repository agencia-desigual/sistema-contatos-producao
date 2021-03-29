<?php

// NameSpace
namespace Controller;

// Importações
use Helper\Apoio;
use Model\Foto;
use Sistema\Controller;

// Inicia a Classe
class Modelo extends Controller
{
    // Objetos
    private $objModelModelo;
    private $objHelperApoio;
    private $objModelFoto;

    // Método construtor
    public function __construct()
    {
        // Inicia o construtor pai
        parent::__construct();

        // Instancia os objetos
        $this->objModelModelo = new \Model\Modelo();
        $this->objHelperApoio = new Apoio();
        $this->objModelFoto = new Foto();

    } // End >> fun::__construct()


    public function relatorio()
    {
        $filtro = $_POST;
        $sql = "";
        $where = [];

        // Verifica se informou o sexo
        if ($filtro['sexo'] != "")
        {
            // Monta o where
            $where['sexo'] = "sexo = '" . $filtro['sexo']. "' AND ";
        }

        // Verifica se informou a etnia
        if ($filtro['etnia'] != "")
        {
            // Monta o where
            $where['etnia'] = "etnia = '" . $filtro['etnia']. "' AND ";
        }

        // Verifica se informou a manequim
        if ($filtro['manequim'] != 0)
        {
            // Monta o where
            $where['manequim'] = "manequim = '" . $filtro['manequim']. "' AND ";
        }

        // Verifica se informou a altura
        if ($filtro['altura'] != 0)
        {
            // Monta o where
            $where['altura'] = $filtro['altura'] .' AND ' ;
        }

        // Verifica se informou a calcado
        if ($filtro['calcado'] != 0)
        {
            // Monta o where
            $where['calcado'] = $filtro['calcado'] .' AND ' ;
        }


        $this->debug($where);
    }


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
            ->get("",'id_modelo DESC')->fetchAll(\PDO::FETCH_OBJ);

        // Verifica se tem modelo
        if (!empty($modelos))
        {
            // Percorre todos os modelos
            foreach ($modelos as $modelo)
            {
                // Busca as imagens
                $imagem = $this->objModelFoto
                    ->get(["id_modelo" => $modelo->id_modelo])
                    ->fetchAll(\PDO::FETCH_OBJ);

                // Vincula as imagens
                $modelo->imagem = $imagem;

                // Calculando a idade
                $modelo->idade = date("Y") - date("Y",strtotime($modelo->dataNascimento));
            }

            // Busca todas as etnia
            $sqlEtinias = "SELECT etnia FROM modelo GROUP BY etnia ORDER BY etnia ASC";
            $etinia = $this->objModelModelo
                ->query($sqlEtinias)
                ->fetchAll(\PDO::FETCH_OBJ);

            // Busca todas os manequim
            $sqlManequim = "SELECT manequim FROM modelo GROUP BY manequim ORDER BY manequim ASC";
            $manequim = $this->objModelModelo
                ->query($sqlManequim)
                ->fetchAll(\PDO::FETCH_OBJ);

            // Busca todas as alturas
            $sqlAltura = "SELECT altura FROM modelo GROUP BY altura ORDER BY altura ASC";
            $altura = $this->objModelModelo
                ->query($sqlAltura)
                ->fetchAll(\PDO::FETCH_OBJ);

            // Busca todos os calcados
            $sqlCalcado = "SELECT calcado FROM modelo GROUP BY calcado ORDER BY calcado ASC";
            $calcado = $this->objModelModelo
                ->query($sqlCalcado)
                ->fetchAll(\PDO::FETCH_OBJ);

        }

        // Dados da view
        $dados = [
            "modelos" => $modelos,
            "etnias" => $etinia,
            "manequins" => $manequim,
            "alturas" => $altura,
            "calcados" => $calcado,
            "js" => [
                "modulos" => ["Modelo"]
            ]
        ];

        // Carrega a view
        $this->view("painel/modelo/listar",$dados);
    }



    /**
     * Método responsável por responsável por carregar a página de
     * adicionar modelo.
     * -------------------------------------------------------------------
     * @url modelo/adicionar
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
                "modulos" => ["Modelo"]
            ]
        ];

        // Carrega a view
        $this->view("painel/modelo/adicionar",$dados);
    }



    /**
     * Método responsável por responsável por carregar a página de
     * editar um usuario.
     * -------------------------------------------------------------------
     * @url modelo/editar/{id}
     * @method GET
     */
    public function editar($id)
    {

        $dados = null;
        $modelo = null;
        $fotos = null;

        // Verifica se está logado
        $user = $this->objHelperApoio->seguranca();

        // Busca a categoria selecionada
        $modelo = $this->objModelModelo
            ->get(["id_modelo" => $id])
            ->fetch(\PDO::FETCH_OBJ);

        // Verifica se encontrou
        if (!empty($modelo))
        {
            // Busca as fotos desse modelo
            $fotos = $this->objModelFoto
                ->get(["id_modelo" => $id])
                ->fetchAll(\PDO::FETCH_OBJ);

            // Verificando se tem foto
            if (!empty($fotos))
            {
                // Percorrendo todas fotos
                foreach ($fotos as $foto)
                {
                    // Gerando o link
                    $foto->imagem = BASE_URL . 'storage/fotos/' . $foto->imagem;
                }
            }

        }

        // Variaveis
        $dados = null;

        // Dados da view
        $dados = [
            "modelo" => $modelo,
            "fotos" => $fotos,
            "js" => [
                "modulos" => ["Modelo"]
            ]
        ];

        // Carrega a view
        $this->view("painel/modelo/editar",$dados);
    }



} // End >> Class::Modelo