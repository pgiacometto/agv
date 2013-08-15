<?php

class Ventas_PedidosController extends Zend_Controller_Action
{

    private $_infoUsuario = null;

    private $_baseUrl = null;

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
        // action body
    }


}



