<?php

class Ventas_PedidosController extends Zend_Controller_Action
{

    private $_infoUsuario = null;

    private $_baseUrl = null;
    
    private $_formPedido = null;
    
    private $_date;
    

    public function init()
    {
        $this->_baseUrl = $this->getRequest()->getBaseUrl();
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $this->_infoUsuario = $auth->getIdentity();
             $this->view->infoUsuario = $this->_infoUsuario;
        } else {
            $this->_redirect("$this->_baseUrl/autenticacion/login");
        }
        $this->view->headLink()->appendStylesheet('/assets/css/chosen.css');
        $this->view->headScript()->appendFile('/assets/js/chosen.jquery.min.js','text/javascript')
                                 ->appendFile('/assets/js/date-time/bootstrap-datepicker.min.js','text/javascript')
                                 ->appendFile('/assets/js/jquery.maskedinput.min.js','text/javascript');
        
        $this->_formPedido = new Application_Form_Pedido();
        $this->_date = new Zend_Date();
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->view->headTitulo = "Lista de Pedidos";
       
        // action body
    }

    public function nuevoAction()
    {
        $this->view->headTitulo = "Nuevo Pedido";

        $formDatosClientes = $this->_formPedido->getDatosCliente();

        if ($this->_request->isPost()) {

            if ($formDatosClientes->isValid($this->getAllParams())) {
                
                echo 'Valido Form : '. $this->_request->getPost('descripcion')
                 ; exit;
                
            } else {

                $formDatosClientes->setDefault('fechaCreado', $this->_date->now()->toString('dd/MM/yyyy'));
                $formDatosClientes->setDefault('status', 'No Registrado');
                // print_r($formDatosClientes->getMessages());exit;
                $this->view->error = $formDatosClientes->getMessages();            
                $this->view->formDatosClientes = $formDatosClientes->populate($this->getAllParams());
            }
        } else {

            $formDatosClientes->setDefault('fechaCreado', $this->_date->now()->toString('dd/MM/yyyy'));
            $formDatosClientes->setDefault('status', 'No Registrado');

            $this->view->formDatosClientes = $formDatosClientes;
        }
    }


}



