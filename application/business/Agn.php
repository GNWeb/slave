<?php

/**
 * Classe negocial das funcionalidades do site Argent Global Network
 *
 * @author Gustavo Nobrega <gustavonobrega.efti@gmail.com>
 */
class Business_Agn {

    /**
     * Conex�o criada no site atrav�s do curl
     */
    private $ch;

    /**
     * Url de valida��o dos links anunciados
     */
    private $urlAdValid = "https://www.argentglobalnetwork.com/backoffice/ad-confirm.html";
    
    /**
     *  Url de autentica��o
     */
    private $urlLogin = 'https://www.argentglobalnetwork.com/handler.php?h=user_login';
    
    /**
     * Email/Usu�rio da AGN
     */
    private $email = 'gustavonobrega.efti@gmail.com';
    
    /**
     * Senha de autentica��o na AGN
     */
    private $senha = '090288';
    
    /**
     * Redirecionamento ap�s a autentica��o
     */
    private $urlRdirect = 'https://www.argentglobalnetwork.com/backoffice/index.html';

    /**
     * Efetua o login na AGN atrav�s do curl
     */
    private function efetuarLogin() {

        // Inicia o cURL
        if (!$this->ch) {
            $this->ch = curl_init();
        }

        // Define a URL original (do formul�rio de login)
        curl_setopt($this->ch, CURLOPT_URL, $this->urlLogin);

        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        // Habilita o protocolo POST
        curl_setopt($this->ch, CURLOPT_POST, 1);

        // Define os par�metros que ser�o enviados (usu�rio e senha por exemplo)
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, 'formloginemail=' . $this->email . '&formloginpassw= ' . $this->senha);

        // Imita o comportamento patr�o dos navegadores: manipular cookies
        curl_setopt($this->ch, CURLOPT_COOKIEJAR, 'cookie.txt');

        // Define o tipo de transfer�ncia (Padr�o: 1)
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);

        // Executa a requisi��o
        //HTML da p�gina resultado (depois do submit do login)
        $store = curl_exec($this->ch);

        // Define uma nova URL para ser chamada (ap�s o login)
        curl_setopt($this->ch, CURLOPT_URL, $this->urlRdirect);

        // Executa a segunda requisi��o
        //HTML da p�gina chamada na segunda requisi��o
        $content = curl_exec($this->ch);
    }

    /**
     * Valida a url do an�ncio
     * @param strin $urlAd Url gerada com a publica��o
     * @param int $idUsuario Identifica��o do usu�rio
     */
    public function validarAnuncio($urlAd, $idUsuario) {
        //Constante
        $link2 = "http://www.ukadslist.com/";

        //Realiza a autentica��o
        $this->efetuarLogin();
        
        //Envia os par�metros para a valida��o
        // Define uma nova URL para ser chamada (ap�s o login)
        curl_setopt($this->ch, CURLOPT_URL, $this->urlAdValid);

        // Habilita o protocolo POST
        curl_setopt($this->ch, CURLOPT_POST, 1);

        // Define os par�metros que ser�o enviados (usu�rio e senha por exemplo)
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, 'link1=' . $urlAd . '&number= ' . $idUsuario . '&link2=' . $link2);

        // Executa a requisi��o
        echo $content = curl_exec($this->ch);
        
        // Encerra o cURL
        curl_close($this->ch);

    }

}

?>
