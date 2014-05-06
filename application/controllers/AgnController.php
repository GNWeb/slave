<?php

/**
 * Classe controle das funcionalidades do site Argent Global Network
 * 
 * @author Gustavo Nobrega <gustavonobrega.efti@gmail.com>
 */
class AgnController extends Zend_Controller_Action
{
    
    /**
     * Publica a valida a publicidade da AGN
     */
    public function publicarAction() {
        //Exibe o formulário
        if( count($_POST) == 0 && count($_GET) == 0 ) {
            //Carrega a view
        } else { //Submete os dados
        
            //Evita o timeout
            set_time_limit(0);

            //Parametros
            $email = $_REQUEST['email'];
            $senha = $_REQUEST['senha'];

            //Efetua o login
            $bsnAgn = new Business_Agn();
            $bsnAgn->efetuarLogin($email, $senha);

            //Recupera o nome do usuário
            $usuario = $bsnAgn->obterLogin();

            //Realiza a publicação no FreeAds
            $bsnFreeAds = new Business_FreeAds();
            $linkPublicacao = $bsnFreeAds->publicarAufreeads($usuario, $senha);

            //Valida a url no site da AGN
            $rs = $bsnAgn->validarAnuncio($email, $senha, $linkPublicacao);
            $resp = array();
            if( $rs ) {
                $resp['sucesso'] = 1;
            } else {
                $resp['sucesso'] = 0;
            }
            echo json_encode($resp);
            die;
        }
    }

    /**
     * Valida o link do anúncio
     * ACTION DESATIVADA
     */
    public function validarPublicacao()
    {
        //Parâmetros
        $urlAd = "http://www.ukadslist.com/view/item-346626-Advertising-is-important-for-every-business.html";
        $email = "gustavonobrega.efti@gmail.com";
        $senha = "090288";
        
        //Executa a validação
        $bnsAgn = new Business_Agn();
        $bnsAgn->validarAnuncio($email, $senha, $urlAd);
        die;
    }

    /**
     * Publica um novo anúncio/ad
     * ACTION DESATIVADA
     */
    public function publicarAnuncio() {
        //Evita o timeout
        set_time_limit(0);
        
        //Parâmetros
        $usuario = "terhacker";
        $senha = "090288";
        $adTitle = "Leverage the online presence of your business with ArgentGlobalNetwork";
        $adDescription = "Leverage the online presence of your business with ArgentGlobalNetwork. Your online advertising partner. Become our partner todayhttp://www.argentglobalnetwork.com/?terhacker";
        
        //Realiza a publicação
        $bsnFreeAds = new Business_FreeAds();
        $bsnFreeAds->publicarAufreeads($usuario, $senha);
    }
}

