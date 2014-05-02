<?php

/**
 * Classe controle das funcionalidades do site Argent Global Network
 * 
 * @author Gustavo Nobrega <gustavonobrega.efti@gmail.com>
 */
class AgnController extends Zend_Controller_Action
{

    /**
     * Valida o link do an�ncio
     */
    public function validarPublicacaoAction()
    {
        //Par�metros
        $urlAd = "http://www.ukadslist.com/view/item-346626-Advertising-is-important-for-every-business.html";
        $idUsuario = 146792;
        
        //Executa a valida��o
        $bnsAgn = new Business_Agn();
        $bnsAgn->validarAnuncio($urlAd, $idUsuario);
        die;
    }

    /**
     * Publica um novo an�ncio/ad
     */
    public function publicarAnuncioAction() {
        //Par�metros
        $usuario = "terhacker";
        $senha = "090288";
        $codUsuario = 6523;
        $adTitle = "Leverage the online presence of your business with ArgentGlobalNetwork";
        $adDescription = "Leverage the online presence of your business with ArgentGlobalNetwork. Your online advertising partner. Become our partner todayhttp://www.argentglobalnetwork.com/?terhacker";
        
        //Realiza a publica��o
        $bsnFreeAds = new Business_FreeAds();
        $bsnFreeAds->publicarAufreeads($usuario, $senha, $codUsuario);
    }
}

