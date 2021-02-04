<?php

/**
 * Classe responsável por conter métodos que auxiliam no desenvolvimento
 * de softwares.
 */

// NameSpace
namespace Helper;

// Inicia a classe
class Apoio
{



    /**
     * Método responsável por realizar uma verificação se o usuário
     * acessante está logado ou não. Caso não esteja redireciona para
     * a página de login. Se estiver, retorna os dados do usuário.
     * -------------------------------------------------------------------
     * @return mixed|null
     */
    public function seguranca()
    {
        // Recupera os dados da sessao
        $user = (!empty($_SESSION["usuario"]) ? $_SESSION["usuario"] : null);
        $token = (!empty($_SESSION["token"]) ? $_SESSION["token"] : null);

        // Verifica se possui algo
        if(!empty($user->id_usuario))
        {
            // Verifica se o token está valido
            if($token->data_expira > date("Y-m-d H:i:s"))
            {
                // Add o token ao usuario
                $user->token = $token;

                // Retorna o usuario
                return $user;
            }
            else
            {
                // Deleta a session
                session_destroy();

                // Redireciona para a tela de logof
                header( "Location: " . BASE_URL . "login");

            } // Error - Token Expirado
        }
        else
        {
            // Redireciona para a tela de login
            header( "Location: " . BASE_URL . "login");

        } // Error - usuario não logado

    } // End >> fun::seguranca()



    /**
     * Método responsável por formatar um numero na casa do milhar, deixando
     * em siglas K,M,B,T,Q
     * ---------------------------------------------------------------------
     * @param null|int $numero
     * @return string
     */
    public function formatNumero($numero = null)
    {
        // Variaveis
        $cont = 0;
        $array  = ["","K","M","B","T","Q"];

        // Divide o numero por mil
        while ($numero >= 1000)
        {
            $numero = $numero / 1000;
            $cont++;
        }


        // Verifica se o numero não é inteiro
        if(is_int($numero) == false)
        {
            // Deixa com duas casas decimais
            $numero = number_format($numero,2,".");
        }

        // Retorna o numero com a letra
        return $numero . $array[$cont];
    }

} // End >> Class::Apoio()