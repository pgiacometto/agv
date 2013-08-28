<?php

class Ventas_PedidosController extends Zend_Controller_Action
{

    private $_infoUsuario = null;
    private $_baseUrl = null;
    private $_formPedido = null;
    private $_date = null;
    private $_modelPedidos = null;

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
        $this->view->headScript()->appendFile('/assets/js/chosen.jquery.min.js', 'text/javascript')
                ->appendFile('/assets/js/date-time/bootstrap-datepicker.min.js', 'text/javascript')
                ->appendFile('/assets/js/jquery.maskedinput.min.js', 'text/javascript');

        $this->_formPedido = new Application_Form_Pedido();
        $this->_date = new Zend_Date();
        $this->_modelPedidos = new Ventas_Model_Pedidos();
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


                $result = $this->_modelPedidos->addPedido($this->getAllParams());

                if ($result->idpedido) {

                    $this->_redirect('/ventas/pedidos/editar/id/'.$result->idpedido);
                  
                }
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

    public function agregarAction()
    {
        // action body
    }

    public function editarAction()
    {
        if (!$this->_hasParam('id')) {
            return $this->_redirect('/ventas/pedidos/');
        }
        
        $this->view->headScript()->appendFile('/assets/js/jquery.dataTables.min.js', 'text/javascript')
                                 ->appendFile('/assets/js/jquery.dataTables.bootstrap.js', 'text/javascript');

        $formDatosClientes = $this->_formPedido->getDatosCliente();

        if ($this->getRequest()->isPost()) {
            
        } else {
            $rowPedido = $this->_modelPedidos->getPedido($this->getParam('id'));

            if ($rowPedido) {
                $formDatosClientes->setAction('/ventas/pedidos/editar');
                //$formDatosClientes->populate($rowPedido->toArray());
                $rowToArray = $this->_modelPedidos->rowPedidoToArray($rowPedido);
                $formDatosClientes->populate($rowToArray);
            }
            
            $this->view->idpedido = $this->getParam('id');
            $this->view->formDatosClientes = $formDatosClientes;
        }
    }
    
    public function agregararticuloAction()
    {
        $this->_helper->layout()->disableLayout();

       

        if ($this->_request->isPost()) {
            
            $formArticulos = $this->_formPedido->getArticulos();
            $formArticulos->setDefault('idpedido', $this->_getParam('id'));
            $formArticulos->setDefault('cantidad', 55);
            $formArticulos->setDefault('desc', 0);
            $this->view->formArticulos = $formArticulos;
            
        } else {
            
             $this->view->headScript()->appendFile('/assets/js/jquery.validate.min.js', 'text/javascript');
            
            if (!$this->_hasParam('id')) {
                return $this->_redirect('/ventas/pedidos');
            }

            $formArticulos = $this->_formPedido->getArticulos();
            $formArticulos->setDefault('idpedido', $this->_getParam('id'));
            $formArticulos->setDefault('cantidad', 1);
            $formArticulos->setDefault('desc', 0);
            $this->view->formArticulos = $formArticulos;
        }
    }

}

