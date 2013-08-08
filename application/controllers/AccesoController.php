<?php

class AccesoController extends Zend_Controller_Action
{
    private $_formAcceso;

    public function init()
    {
        $this->_formAcceso = new Application_Form_Acceso();
      // print $this->_formAcceso->getAction();exit;
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $formLogin = $this->_formAcceso->getLogin();
        $formLoginAction = $formLogin->getAction();
        
        $this->view->formAction =  $formLoginAction;
        $this->view->form = $formLogin;
       
    }


}

