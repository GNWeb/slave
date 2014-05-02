<?php

/**
 * Classe controle das funcionalidades do site Argent Global Network
 * 
 * @author Gustavo Nobrega <gustavonobrega.efti@gmail.com>
 */
class AgnController extends Zend_Controller_Action
{

    /**
     * Valida o link do anúncio
     */
    public function validarPublicacaoAction()
    {
        //Parâmetros
        $urlAd = "http://www.ukadslist.com/view/item-346626-Advertising-is-important-for-every-business.html";
        $idUsuario = 146792;
        
        //Executa a validação
        $bnsAgn = new Business_Agn();
        $bnsAgn->validarAnuncio($urlAd, $idUsuario);
        die;
    }

    /**
     * Publica um novo anúncio/ad
     */
    public function publicarAnuncioAction() {
        //Parâmetros
        $usuario = "terhacker";
        $senha = "090288";
        $codUsuario = 6523;
        $adTitle = "Leverage the online presence of your business with ArgentGlobalNetwork";
        $adDescription = "Leverage the online presence of your business with ArgentGlobalNetwork. Your online advertising partner. Become our partner todayhttp://www.argentglobalnetwork.com/?terhacker";
        
        //Realiza a publicação
        $bsnFreeAds = new Business_FreeAds();
        $bsnFreeAds->publicarAufreeads($usuario, $senha, $codUsuario);
    }
}

