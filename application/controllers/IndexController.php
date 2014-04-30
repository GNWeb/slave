<?php

class IndexController extends Zend_Controller_Action
{

    /**
     * Imprime as variáveis enviadas via REQUEST
     * 
     * array(13) {
        ["adTitle"] => string(70) "Leverage the online presence of your business with ArgentGlobalNetwork"
        ["adDescription"] => string(174) "Leverage the online presence of your business with ArgentGlobalNetwork. Your online advertising partner. Become our partner todayhttp://www.argentglobalnetwork.com/?terhacker"
        ["MAX_FILE_SIZE"] => string(6) "204800"
        ["linkURL"] => string(0) ""
        ["category"] => string(4) "0903"
        ["targetCity"] => string(0) ""
        ["targetState"] => string(0) ""
        ["ownerName"] => string(9) "terhacker"
        ["contactPhone"] => string(0) ""
        ["contactEmail"] => string(0) ""
        ["adPasscode"] => string(6) "090288"
        ["vcid"] => string(4) "6523"
        ["validationCode"] => string(6) "963452"
      }
     */
    public function debugRequestAction()
    {
        Zend_Debug::dump($_REQUEST);
        die;
    }

}

