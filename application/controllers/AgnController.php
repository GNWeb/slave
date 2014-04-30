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

}

