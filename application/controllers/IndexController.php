<?php

class IndexController extends Zend_Controller_Action
{

    /**
     * Imprime as vari�veis enviadas via REQUEST
     */
    public function debugRequestAction()
    {
        Zend_Debug::dump($_REQUEST);
        die;
    }
    
    public function indexAction() {
        
    }

}

