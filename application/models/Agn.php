<?php

/**
 * Classe de modelo das funcionalidades do site Argent Global Network
 *
 * @author Gustavo Nobrega <gustavonobrega.efti@gmail.com>
 */
class Model_Agn {

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
     * Retorna 1 anúncio da lista selecoinando de forma randômica
     */
    public function obterAnuncio() {
        $kMax = count($this->listaAds) - 1;
        $key = rand(0, $kMax);
        return $this->listaAds[$key];
    }

}

?>
