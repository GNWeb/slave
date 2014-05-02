<?php

/**
 * Classe negocial das funcionalidades dos sites de ADS gratuitos
 *
 * @author Gustavo Nobrega <gustavonobrega.efti@gmail.com>
 */
class Business_FreeAds {
    
    /**
     * Construtor
     */
    public function Business_FreeAds() {
        //Importa a classe de seletores/dom e de convers�o de imagem
        require_once("phpQuery/phpQuery.php");
        require_once("phpOCR-0.0.3/Ocr.php");
    }

    /**
     * Publica a propaganda no site Aufreeds
     * @param string $usuario
     * @param string $senha
     * @return string Url da publica��o
     */
    public function publicarAufreeads($usuario, $senha) {
        //Define os par�metros fixos
        $codSite = 6523;
        $adSite = "http://www.ukadslist.com";
        $adLink = $adSite . "/post/post-free-ads.php";
        $adLinkAct = $adSite . "/post/post-free-ads-op.php";
        $categoria = '0903';
        
        //Carrega uma op��o de an�ncio
        $mdlAgn = new Model_Agn();
        $anuncio = $mdlAgn->obterAnuncio();
        
        //Inicia a conex�o
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        // Define o tipo de transfer�ncia (Padr�o: 1)
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        //For�a a repeti��o do procedimento at� obter o sucesso
        $flgSucesso = false;
        
        do {
            //Recupera o captcha
            $captcha = $this->lerCaptchaAufreeads($ch, $adLink);
            //Espera enquanto o servidor adicionar o captcha � sess�o
            sleep(10);
            // Habilita o protocolo POST
            curl_setopt($ch, CURLOPT_POST, 1);
            // Imita o comportamento patr�o dos navegadores: manipular cookies
            curl_setopt($ch, CURLOPT_COOKIEJAR, 'tmp/cookie.txt');

            //Monta os par�metros para ser enviado via curl
            $post = "adTitle=" . $anuncio['titulo'];
            $post .= "&adDescription=" . $anuncio['descricao'];
            $post .= "&category=" . $categoria;
            $post .= "&ownerName=" . $usuario;
            $post .= "&adPasscode=" . $senha;
            $post .= "&validationCode=" . $captcha['codigo'];        
            $post .= "&vcid=" . $captcha['vcid'];        

            // Define a URL original (do formul�rio de login)
            curl_setopt($ch, CURLOPT_URL, $adLinkAct);
            // Define os par�metros que ser�o enviados
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

            //HTML da p�gina resultado (depois do submit do login)
            $result = curl_exec($ch);
            $flgSucesso = $this->tratarErros($result);
        } while( !$flgSucesso );
        
        // Encerra o cURL
        curl_close($ch);
        //Extrai o link de valida��o
        $linkPublic = $this->extrairLinkValidacao($result);

        $linkPublicacao = $adSite . $linkPublic;
        return $linkPublicacao;
    }

    /**
     * Interpreta o Captcha do site
     * @param Object $ch Curl
     * @param string $adLink
     * @return string C�digo da imagem
     */
    public function lerCaptchaAufreeads(&$ch, $adLink) {
        $serverImg = "http://www.ukadslist.com";
        $captcha = array();
        
        //Envia os par�metros para a valida��o
        curl_setopt($ch, CURLOPT_URL, $adLink);

        // Executa a requisi��o e recupera o html
        $content = curl_exec($ch);

        //Inicia a manipula��o do html
        $doc = phpQuery::newDocumentHTML($content);
        //Recupera a imagem
        $captchaDom = pq("form#fPostAd table tr img", $doc);
        $captchaSrc = $serverImg . $captchaDom->attr("src");
        $ocr = new Ocr($captchaSrc);

        //Recupera o vcid
        $inputVcidDom = pq("form#fPostAd input[name=vcid]", $doc);
        $captcha['vcid'] = $inputVcidDom->val();
        //echo "<img src='{$captchaSrc}'>";
        $captcha['codigo'] = $ocr->result;
        
        return $captcha;
    }
    
    /**
     * Extrai a url do link
     * @param string $html 
     * @return string
     */
    public function extrairLinkValidacao($html) {
        //Inicia a manipula��o do html
        $doc = phpQuery::newDocumentHTML($html);
        $linkDom = pq("div.ssPostResult a", $doc);
        return pq($linkDom)->attr('href');
    }

    /**
     * Trata os erros na resposta do site em html
     * @param string $html 
     * @return boolean
     */
    public function tratarErros($html) {
       
        //Inicia a manipula��o do html
        $doc = phpQuery::newDocumentHTML($html);
        $listaLiDom = pq("ul.ssListErrMsg li", $doc);
        $listaDivDom = pq("div.ssPostResult p", $doc);
        //Percorre as mensagens
        foreach( $listaLiDom as $liDom ) {
            $texto = pq($liDom)->text();
   
            //Erro na valida��o do captcha
            if( !(strpos($texto, "The validation code is incorrect") === FALSE) ) {
                return false;
            }
        }
        foreach( $listaDivDom as $divDom ) {
            $texto = pq($divDom)->text();
            
            //Publica��o repetida
            if( !(strpos($texto, "of an existing ad posted recently") === FALSE) ) {
                return false;
            }
        }
        
        //Sucesso
        //echo $html;
        return true;
    }
}

?>
