<?php

/**
 * Classe negocial das funcionalidades do site Argent Global Network
 *
 * @author Gustavo Nobrega <gustavonobrega.efti@gmail.com>
 */
class Business_Agn {

    /**
     * Conexão criada no site através do curl
     */
    private $ch;

    /**
     * Url de validação dos links anunciados
     */
    private $urlAdValid = "https://www.argentglobalnetwork.com/backoffice/ad-confirm.html";
    
    /**
     *  Url de autenticação
     */
    private $urlLogin = 'https://www.argentglobalnetwork.com/handler.php?h=user_login';
    
    /**
     * Email/Usuário da AGN
     */
    private $email = 'gustavonobrega.efti@gmail.com';
    
    /**
     * Senha de autenticação na AGN
     */
    private $senha = '090288';
    
    /**
     * Redirecionamento após a autenticação
     */
    private $urlRdirect = 'https://www.argentglobalnetwork.com/backoffice/index.html';

    /**
     * Efetua o login na AGN através do curl
     */
    private function efetuarLogin() {

        // Inicia o cURL
        if (!$this->ch) {
            $this->ch = curl_init();
        }

        // Define a URL original (do formulário de login)
        curl_setopt($this->ch, CURLOPT_URL, $this->urlLogin);

        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        // Habilita o protocolo POST
        curl_setopt($this->ch, CURLOPT_POST, 1);

        // Define os parâmetros que serão enviados (usuário e senha por exemplo)
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, 'formloginemail=' . $this->email . '&formloginpassw= ' . $this->senha);

        // Imita o comportamento patrão dos navegadores: manipular cookies
        curl_setopt($this->ch, CURLOPT_COOKIEJAR, 'cookie.txt');

        // Define o tipo de transferência (Padrão: 1)
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);

        // Executa a requisição
        //HTML da página resultado (depois do submit do login)
        $store = curl_exec($this->ch);

        // Define uma nova URL para ser chamada (após o login)
        curl_setopt($this->ch, CURLOPT_URL, $this->urlRdirect);

        // Executa a segunda requisição
        //HTML da página chamada na segunda requisição
        $content = curl_exec($this->ch);
    }

    /**
     * Valida a url do anúncio
     * @param strin $urlAd Url gerada com a publicação
     * @param int $idUsuario Identificação do usuário
     */
    public function validarAnuncio($urlAd, $idUsuario) {
        //Constante
        $link2 = "http://www.ukadslist.com/";

        //Realiza a autenticação
        $this->efetuarLogin();
        
        //Envia os parâmetros para a validação
        // Define uma nova URL para ser chamada (após o login)
        curl_setopt($this->ch, CURLOPT_URL, $this->urlAdValid);

        // Habilita o protocolo POST
        curl_setopt($this->ch, CURLOPT_POST, 1);

        // Define os parâmetros que serão enviados (usuário e senha por exemplo)
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, 'link1=' . $urlAd . '&number= ' . $idUsuario . '&link2=' . $link2);

        // Executa a requisição
        echo $content = curl_exec($this->ch);
        
        // Encerra o cURL
        curl_close($this->ch);

    }

}

?>
