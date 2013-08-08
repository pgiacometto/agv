<?php

class AccesoController extends Zend_Controller_Action
{
    private $_formAcceso;

    public function init()
    {
        $this->_formAcceso = new Application_Form_Acceso();
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->view->form = $this->_formAcceso;
        // action body
    }


}

