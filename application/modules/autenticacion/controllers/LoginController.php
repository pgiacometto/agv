<?php

class Autenticacion_LoginController extends Zend_Controller_Action
{

    public $_request = null;

    private $_formAcceso = null;

    private $_auth = null;

    private $_baseUrl = null;

    public function init()
    {
        $this->_baseUrl = $this->getRequest()->getBaseUrl();
        $this->_helper->layout()->disableLayout();

        $this->_request = $this->getRequest();
        $this->_formAcceso = new Application_Form_Acceso();
        $this->_auth = Zend_Auth::getInstance();

        // print $this->_formAcceso->getAction();exit;
        /* Initialize action controller here */
    }

    private function getAuthAdapter($username, $password)
    {

        $authAdapter = new Zend_Auth_Adapter_DbTable(
                Zend_Db_Table::getDefaultAdapter()
        );
        $authAdapter->setTableName('usuarios') // the db table where users are stored
                ->setIdentityColumn('usuario')
                ->setCredentialColumn('clave')
                ->setIdentity($username)
                ->setCredential($password);
        //->setCredentialTreatment('SHA1(CONCAT(?,salt))')
        ;
        return $authAdapter;
    }

    public function indexAction()
    {
        if ($this->_auth->hasIdentity()) {
            $this->_infoUsuario = $this->_auth->getIdentity();
            $this->_redirect("$this->baseUrl/");
        }

        $formLogin = $this->_formAcceso->getLogin();
        $formLoginAction = $formLogin->getAction();


        if ($this->_request->isPost()) {

            if ($formLogin->isValid($this->getAllParams())) {

                $username = $this->_request->getPost('usuario');
                $password = $this->_request->getPost('clave');

                $authAdapter = $this->getAuthAdapter($username, $password);

                $authenticate = $this->_auth->authenticate($authAdapter);

                if ($authenticate->isValid()) {
                    $identity = $authAdapter->getResultRowObject();
                    $this->_auth->getStorage()->write($identity);

//                    $infoUsuario = $this->_auth->getIdentity();
//                    
////                    echo var_dump($infoUsuario);
////                    echo 'Valido Login =>'.$infoUsuario->usuario;
////                    exit;
                    $this->_redirect("$this->baseUrl/");
                } else {
                    switch ($authenticate->getCode()) {
                        case -1:
                            $this->view->error = array('Usuario ' => array("$username no existe"));
                            $this->view->form = $formLogin->populate($this->getAllParams());
                            break;
                        case -3:
                            $this->view->error = array('Clave ' => array('incorrecta verifique Mayuscula y Minisculas'));
                            $this->view->form = $formLogin->populate($this->getAllParams());

                            break;
                    }
                }
            } else {

                // print_r($formLogin->getMessages());exit;
                $this->view->error = $formLogin->getMessages();
                $this->view->form = $formLogin->populate($this->getAllParams());
            }
        } else {

            $this->view->formAction = $formLoginAction;
            $this->view->form = $formLogin;
        }
    }

    public function logoutAction()
    {
        $this->_auth->clearIdentity();
        $this->_redirect("$this->_baseUrl/");
        // action body
    }

}


