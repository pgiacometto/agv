<?php

class Ventas_PedidosController extends Zend_Controller_Action
{

    private $_infoUsuario = null;

    private $_baseUrl = null;
    
    private $_formPedido = null;
    

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
        $this->view->headScript()->appendFile('/assets/js/chosen.jquery.min.js','text/javascript');
        
        $this->_formPedido = new Application_Form_Pedido();
      
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
    
        $this->view->formDatosClientes = $this->_formPedido->getDatosCliente();
        
    }


}



