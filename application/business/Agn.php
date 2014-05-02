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
     * Redirecionamento após a autenticação
     */
    private $urlRdirect = 'https://www.argentglobalnetwork.com/backoffice/index.html';
    
    /**
     * Página utilizada para recuperar o login
     */
    private $urlGetLogin = 'https://www.argentglobalnetwork.com/backoffice/refferals.html';
    
    /**
     * Email/Usuário da AGN
     */
    private $email;
    
    /**
     * Senha de autenticação na AGN
     */
    private $senha;

    /**
     * Lista de anúncios disponíveis
     */
    private $listaAds = array(
        0 => array(
            "titulo" => "Over $500 Billion a year is spent globally on advertising",
            "descricao" => "Over $500 Billion a year is spent globally on advertising. Partner with ArgentGlobalNetwork to increase your companies bottom line. Join the fast growing online advertising company.
http://www.argentglobalnetwork.com/?terhacker1"
        ),
        1 => array(
            "titulo" => "Leverage the online presence of your business with ArgentGlobalNetwork",
            "descricao" => "Leverage the online presence of your business with ArgentGlobalNetwork. Your online advertising partner. Become our partner today
http://www.argentglobalnetwork.com/?terhacker1"
        ),
        2 => array(
            "titulo" => "Be one of thousands of entrepreneurs in partnering with ArgentGlobalNetwork",
            "descricao" => "Be one of thousands of entrepreneurs in partnering with ArgentGlobalNetwork. Advertising your business is our business. Join us today and start advertising.
http://www.argentglobalnetwork.com/?terhacker1"
        ),
        3 => array(
            "titulo" => "Got Business? Join the fast growing online advertising company",
            "descricao" => "Got Business? Join the fast growing online advertising company. ArgentGlobalNetwork helps you advertise globally.
http://www.argentglobalnetwork.com/?terhacker1"
        ),
        4 => array(
            "titulo" => "Experience the internet advertising revolution with ArgentGlobalNetwork",
            "descricao" => "Experience the internet advertising revolution with ArgentGlobalNetwork. Partner with us today
http://www.argentglobalnetwork.com/?terhacker1"
        ),
        5 => array(
            "titulo" => "Advertising works with ArgentGlobalNetwork",
            "descricao" => "Advertising works with ArgentGlobalNetwork. Boost your bottom line while reaching your customers online. Join Today:
http://www.argentglobalnetwork.com/?terhacker1"
        ),
        6 => array(
            "titulo" => "ArgentGlobalNetwork is your advertising partner",
            "descricao" => "ArgentGlobalNetwork is your advertising partner. helping you reach more customers in more places, online. Join Today:
http://www.argentglobalnetwork.com/?terhacker1"
        ),
        7 => array(
            "titulo" => "Join ArgentGlobalNetwork to successfully be apart of the online customer shift",
            "descricao" => "Join ArgentGlobalNetwork to successfully be apart of the online customer shift. Partner with us today:
http://www.argentglobalnetwork.com/?terhacker1"
        ),
        8 => array(
            "titulo" => "Advertising absolutely works!",
            "descricao" => "Advertising absolutely works! One of the largest online advertising markets in the world is the United States with internet ad spending surpassing $39.5 billion in 2012. Build your business, increase your fortune. Join ArgentGlobalNetwork today.
http://www.argentglobalnetwork.com/?terhacker1"
        ),
        9 => array(
            "titulo" => "Create the constant exposure effect for your customers by advertising with ArgentGlobalNetwork",
            "descricao" => "Create the constant exposure effect for your customers by advertising with ArgentGlobalNetwork. We are your online advertising partner. Join today .
http://www.argentglobalnetwork.com/?terhacker1"
        ),
    );
    
    /**
     * Construtor
     */
    public function Business_Agn() {
        //Importa a classe de seletores/dom
        require_once("phpQuery/phpQuery.php");
    }
    
    /**
     * Efetua o login na AGN através do curl
     * @param string $email
     * @param string $senha
     */
    public function efetuarLogin($email, $senha) {
        //Parametros
        $this->email = $email;
        $this->senha = $senha;
        
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
        curl_setopt($this->ch, CURLOPT_COOKIEJAR, 'tmp/cookie.txt');

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
     * @param string $email
     * @param string $senha
     * @param string $urlAd Url gerada com a publicação
     */
    public function validarAnuncio($email, $senha, $urlAd) {
        //Parâmetros
        $this->email = $email;
        $this->senha = $senha;
        //Constante
        $link2 = "http://www.ukadslist.com/";

        //Realiza a autenticação
        $this->efetuarLogin($email, $senha);
        
        //Obter código
        $codValid = $this->obterCodigoValidacao();
        
        //Envia os parâmetros para a validação
        // Define uma nova URL para ser chamada (após o login)
        curl_setopt($this->ch, CURLOPT_URL, $this->urlAdValid);

        // Habilita o protocolo POST
        curl_setopt($this->ch, CURLOPT_POST, 1);

        // Define os parâmetros que serão enviados (usuário e senha por exemplo)
        $dataPost ='link1=' . $urlAd . '&nm=' . $codValid . '&link2=' . $link2;
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $dataPost);

        // Executa a requisição
        $html = curl_exec($this->ch);
        
        // Encerra o cURL
        curl_close($this->ch);
        
        //Resposta
        if( $html == '' ) {
            return true;
        } else {
            echo $html;
            return false;
        }
    }
    
    /**
     * Retorna 1 anúncio da lista selecoinando de forma randômica
     */
    public function obterAnuncio() {
        $kMax = count($this->listaAds) - 1;
        $key = rand(0, $kMax);
        return $this->listaAds[$key];
    }
    
    /**
     * Recupera um código necessário para a validação do link
     * @return integer
     */
    private function obterCodigoValidacao() {
        // Define uma nova URL para ser chamada (após o login)
        curl_setopt($this->ch, CURLOPT_URL, $this->urlAdValid);
        
        // Desabilita o protocolo POST
        curl_setopt($this->ch, CURLOPT_POST, FALSE);
        
        //Executa a requisição
        $html = curl_exec($this->ch);
        
        //Inicia a manipulação do html
        $doc = phpQuery::newDocumentHTML($html);
        //Recupera o codigo
        $inputDom = pq("input[name=nm]", $doc);
        $codigo = pq($inputDom)->val();
        
        return $codigo;
    }
    
    /**
     * Recupera o login
     * @return string
     */
    public function obterLogin() {
        // Define uma nova URL para ser chamada (após o login)
        curl_setopt($this->ch, CURLOPT_URL, $this->urlGetLogin);
        
        //Executa a requisição
        $html = curl_exec($this->ch);
        
        //Inicia a manipulação do html
        $doc = phpQuery::newDocumentHTML($html);
        //Recupera o login
        $liDom = pq("div.content_pad ul.arrow li", $doc);
        $url = pq($liDom)->eq(0)->html();
        $pos = strpos($url, "?") + 1;
        $login = substr($url, $pos);
        return $login;
    }

}

?>
