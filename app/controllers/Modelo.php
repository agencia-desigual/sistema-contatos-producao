<?php

// NameSpace
namespace Controller;

// Importações
use Dompdf\Dompdf;
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


    /**
     * Método responsável por recuperar o html de outra pagina e solicitar
     * que ela seja trasnformada em PDF
     * -------------------------------------------------------------------
     * @url modelo/relatorio
     * @method GET
     */
    public function relatorio()
    {
        // Recupera os filtros
        $filtro = $_GET;

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        // Pega o conteudo
        $html = file_get_contents(BASE_URL . "modelo/imprimir?" . http_build_query($filtro));

        $dompdf->loadHtml($html,'UTF-8');

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream("relatorio.pdf", array("Attachment" => 0));

    } // End >> fun::relatorio()


    /**
     * Método responsável por gerar a página que será
     * transformada em PDF.
     * -------------------------------------------------------------------
     * @url modelo/imprimir
     * @method GET
     */
    public function imprimir()
    {
        // Variaveis
        $filtro = null;
        $sql = "";

        // Recupera os filtros
        $filtro = $_GET;

        // Verifica se informou o sexo
        if (!empty($filtro['sexo']))
        {
            // Monta o where
            $sql .= "sexo = '{$filtro['sexo']}'";
        }

        // Verifica se informou a etnia
        if(!empty($filtro['etnia']))
        {
            // Verifica se havia informado outra coisa
            if(!empty($sql))
            {
                // Adiciona o and
                $sql .= " AND ";
            }

            // Monta o where
            $sql .= "etnia = '{$filtro['etnia']}'";
        }

        // Verifica se informou a manequim
        if(!empty($filtro['manequim']))
        {
            // Verifica se havia informado outra coisa
            if(!empty($sql))
            {
                // Adiciona o and
                $sql .= " AND ";
            }

            // Monta o where
            $sql .= "manequim = '{$filtro['manequim']}'";
        }

        // Verifica se informou a altura
        if(!empty($filtro['altura']))
        {
            // Verifica se havia informado outra coisa
            if(!empty($sql))
            {
                // Adiciona o and
                $sql .= " AND ";
            }

            // Monta o where
            $sql .= "altura = '{$filtro['altura']}'";
        }

        // Verifica se informou a calcado
        if (!empty($filtro["calcado"]))
        {
            // Verifica se havia informado outra coisa
            if(!empty($sql))
            {
                // Adiciona o and
                $sql .= " AND ";
            }

            // Monta o where
            $sql .= "calcado = '{$filtro['calcado']}'";
        }

        // Monta o sql inicial
        $sql = (!empty($sql) ? "SELECT * FROM modelo WHERE " . $sql : "SELECT * FROM modelo");

        // Busca os modelos
        $modelos = $this->objModelModelo
            ->query($sql)
            ->fetchAll(\PDO::FETCH_OBJ);

        // Percorre os modelos
        foreach ($modelos as $modelo)
        {
            // Calcula a idade
            $modelo->idade = $this->calcularIdade($modelo->dataNascimento);

            // Busca uma foto
            $foto = $this->objModelFoto
                ->get(["id_modelo" => $modelo->id_modelo], "id_foto DESC")
                ->fetch(\PDO::FETCH_OBJ);

            // Verifica se possui imagem
            if(!empty($foto))
            {
                // Recupera a imagem original
                $path = './storage/fotos/' . $foto->imagem;

                // Verifica se a imagem existe
                if(is_file($path))
                {
                    // Converte a imagem em base64
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $data = file_get_contents($path);
                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

                    // Adiciona a foto em base64
                    $modelo->foto = $base64;
                }
            }
        }

        $this->view("painel/modelo/relatorio", ["modelos" => $modelos]);
    } // End >> fun::imprimir()


    private function calcularIdade($date){
        $dataNascimento = $date;
        $date = new \DateTime($dataNascimento );
        $interval = $date->diff( new \DateTime( date('Y-m-d') ) );
        return $interval->format( '%Y' );
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