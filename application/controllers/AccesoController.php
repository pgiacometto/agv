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

        if ($this->getRequest()->isPost()) {

            if ($formLogin->isValid($this->getAllParams())) {

               echo 'Valido Send';exit;
            } else {
         
               // print_r($formLogin->getMessages());exit;
                $this->view->form = $formLogin;
                
            }
        } else {

            $this->view->formAction = $formLoginAction;
            $this->view->form = $formLogin;
        }
    }


}

