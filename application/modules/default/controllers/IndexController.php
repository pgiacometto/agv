<?php

class Default_IndexController extends Zend_Controller_Action
{
    private $_infoUsuario;
    private $_baseUrl;

    public function init()
    {
        $this->_baseUrl = $this->getRequest()->getBaseUrl();
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $this->_infoUsuario = $auth->getIdentity();
        } else {
            $this->_redirect($this->_baseUrl."/autenticacion/login");
        }
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->view->headTitulo = "Inicio";
        $this->view->infoUsuario = $this->_infoUsuario;
        // action body
    }


}

