<?php

class IndexController extends Zend_Controller_Action
{
    private $_infoUsuario;

    public function init()
    {
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $this->_infoUsuario = $auth->getIdentity();
        } else {
            $this->_redirect('/acceso');
        }
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        echo 'login > '.$this->_infoUsuario->usuario;
        // action body
    }


}

