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

}

