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
           // var_dump($this->_infoUsuario);
        } else {
            $this->_redirect("$this->_baseUrl/autenticacion/login");
        }
        $this->view->headLink()->appendStylesheet('/assets/css/chosen.css')
                ->appendStylesheet('/assets/css/select2.css');
        $this->view->headScript()->appendFile('/assets/js/chosen.jquery.min.js', 'text/javascript')
                ->appendFile('/assets/js/date-time/bootstrap-datepicker.min.js', 'text/javascript')
                ->appendFile('/assets/js/jquery.validate.min.js', 'text/javascript')
                ->appendFile('/assets/js/select2.min.js', 'text/javascript')
                ->appendFile('/assets/js/jquery.maskedinput.min.js', 'text/javascript')
                ->appendFile('/assets/js/fuelux/fuelux.spinner.min.js', 'text/javascript');

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
        
        $idusuario = $this->_infoUsuario->idusuario;
        $formDatosClientes = $this->_formPedido->getDatosCliente("idusuario = $idusuario");

        if ($this->_request->isPost()) {

            if ($formDatosClientes->isValid($this->getAllParams())) {


                $result = $this->_modelPedidos->addPedido($this->getAllParams(),  $this->_infoUsuario->idusuario);

                if ($result->idpedido) {

                    $this->_redirect('/ventas/pedidos/editar/id/' . $result->idpedido);
                }
            } else {

                $formDatosClientes->setDefault('fechaCreado', $this->_date->now()->toString('dd/MM/yyyy'));
                $formDatosClientes->setDefault('status', 'No Registrado');
                // print_r($formDatosClientes->getMessages());exit;
                $this->view->error = $formDatosClientes->getMessages();
                $this->view->formDatosClientes = $formDatosClientes->populate($this->getAllParams());
            }
        } else {

            if ($this->_hasParam('ac')) {
                switch ($this->getParam('ac')) {
                    case 1:
                        $this->view->exito = array('Exito ' => array('DB' => 'Cliente Registrado'));
                        $formDatosClientes->setDefault('cliente', $this->getParam('c'));
                        break;
                    case 2:
                        $this->view->error = array('ERROR ' => array('DB' => 'Rif Existente'));
                        break;

                    default:

                        break;
                }
            }

            $formDatosClientes->setDefault('fechaCreado', $this->_date->now()->toString('dd/MM/yyyy'));
            $formDatosClientes->setDefault('status', 'No Registrado');

            $this->view->formDatosClientes = $formDatosClientes;
        }
    }

    public function agregarclienteAction()
    {
        $this->_helper->layout()->disableLayout();

        $formCrearCliente = $this->_formPedido->getCrearCliente();

        if ($this->getRequest()->isPost()) {

            if ($formCrearCliente->isValid($this->getAllParams())) {

                $modelClientes = new Ventas_Model_Clientes();

                try {
                    $row = $modelClientes->addClienteTemporal($this->getAllParams());
                    $this->_redirect('/ventas/pedidos/nuevo/ac/1/c/'.$row->idcliente);
                } catch (Exception $e) {
                    switch ($e->getCode()) {
                        case 23000:
                            $this->_redirect('/ventas/pedidos/nuevo/ac/2');
                            break;
                        default:
                            echo $e->getCode() . '<br/>' . $e->getMessage();
                            exit;
                            break;
                    }
                }
            } else {

                echo 'form invalido';
                exit;
            }
        } else {


            $formCrearCliente->setAction('/ventas/pedidos/agregarcliente/');

            $this->view->formCrearCliente = $formCrearCliente;
        }
        // action body
    }

    public function listaAction()
    {
        $this->view->headScript()->appendFile('/assets/js/jquery.dataTables.min.js', 'text/javascript')
                ->appendFile('/assets/js/jquery.dataTables.bootstrap.js', 'text/javascript')
                ->appendFile('/assets/js/run/runDataTable.js', 'text/javascript');

        if ($this->_infoUsuario->tipo == 1) {

            $pedidosLista = $this->_modelPedidos->getListaPedidos();
            
        } else {
            
            $pedidosLista = $this->_modelPedidos->getListaPedidos($this->_infoUsuario->idusuario);
            
        }


        //var_dump($pedidosLista);exit;
        $this->view->pedidosLista = $pedidosLista;
    }

    public function editarAction()
    {
        if (!$this->_hasParam('id')) {
            return $this->_redirect('/ventas/pedidos/');
        }

        $this->view->headScript()->appendFile('/assets/js/jquery.dataTables.min.js', 'text/javascript')
                ->appendFile('/assets/js/jquery.dataTables.bootstrap.js', 'text/javascript')
                ->appendFile('/assets/js/run/runDataTable.js', 'text/javascript');

        $formDatosClientes = $this->_formPedido->getDatosCliente();

        if ($this->getRequest()->isPost()) {
            
        } else {
            $rowPedido = $this->_modelPedidos->getPedido($this->getParam('id'));

            if ($rowPedido) {
                $formDatosClientes->setAction('/ventas/pedidos/editar');
                //$formDatosClientes->populate($rowPedido->toArray());
                $rowToArray = $this->_modelPedidos->rowPedidoToArray($rowPedido);
                $formDatosClientes->populate($rowToArray);

                $modelPedidosHasArticulo = new Ventas_Model_PedidosHasArticulos();
                $articulosPedido = $modelPedidosHasArticulo->getArticulos($this->getParam('id'));
                $this->view->itemsArticulos = $articulosPedido->count();
                $this->view->articulosPedidos = $articulosPedido;
            }


            $this->view->idpedido = $this->getParam('id');
            $this->view->formDatosClientes = $formDatosClientes;
        }
    }

    public function agregararticuloAction()
    {
        $this->_helper->layout()->disableLayout();

        $formArticulos = $this->_formPedido->getDatosArticulos();

        if ($this->_request->isPost()) {

            if ($formArticulos->isValid($this->getAllParams())) {

                $modelPedidosHasArticulo = new Ventas_Model_PedidosHasArticulos();
                $result = $modelPedidosHasArticulo->addPedidoHasArticulo($this->getAllParams());

                if ($result->idpedido) {

                    $this->_redirect("/ventas/pedidos/editar/id/$result->idpedido#art");
                } else {
                    echo 'Error Sistema';
                    exit;
                }
            } else {
                
            }
        } else {



            if (!$this->_hasParam('id')) {
                return $this->_redirect('/ventas/pedidos');
            }

            $formArticulos->setDefault('idpedido', $this->_getParam('id'));

            $this->view->idpedido = $this->_getParam('id');
            $this->view->formArticulos = $formArticulos;
        }
    }

    public function editararticuloAction()
    {
        $this->_helper->layout()->disableLayout();

        $modelPhA = new Ventas_Model_PedidosHasArticulos();
        $formArticulos = $this->_formPedido->getDatosArticulos();

        if ($this->getRequest()->isPost()) {

            if ($formArticulos->isValid($this->getAllParams())) {

                $modelPhA->updateFila($formArticulos->getValues(), $this->getParam('idpha'));
                return $this->_redirect('/ventas/pedidos/editar/id/' . $this->getParam('idpedido') . '#art');
            } else {

                echo 'Error del Sitema';
                exit;
            }
        } else {

            if (!$this->_hasParam('id')) {
                return $this->_redirect('/ventas/pedidos/');
            }

            $rowArticuloToArray = $modelPhA->rowArticuloToArray($this->_getParam('id'));


            $formArticulos->setAction('/ventas/pedidos/editararticulo');
            $formArticulos->addElement('hidden', 'idpha')->setDefault('idpha', $this->_getParam('id'));

            $this->view->idpedido = $rowArticuloToArray['idpedido'];
            $this->view->formDatosArticulos = $formArticulos->populate($rowArticuloToArray);
        }
    }

    public function borrararticuloAction()
    {
        $this->_helper->layout()->disableLayout();

        if ($this->getRequest()->isPost()) {

            $modelPhA = new Ventas_Model_PedidosHasArticulos();
            $fila = $modelPhA->getArticulo($this->_getParam('id'));

            if ($fila) {
                $idpedido = $fila->idpedido;
                $fila->delete();
                return $this->redirect('/ventas/pedidos/editar/id/' . $idpedido . '#art');
            } else {

                echo 'Error del Sitema';
                exit;
            }
        } else {

            if (!$this->_hasParam('id')) {
                return $this->_redirect('/ventas/pedidos/');
            }

            $formborrar = $this->_formPedido->getBorrar();
            $formborrar->setAction('/ventas/pedidos/borrararticulo');
            $formborrar->setDefault('id', $this->_getParam('id'));
            $this->view->formBorrar = $formborrar;
        }
        // action body
    }

    public function detalleAction()
    {
        if (!$this->_hasParam('id')) {
            return $this->_redirect('/ventas/pedidos/');
        }
        
        $rowPedido = $this->_modelPedidos->getPedido($this->getParam('id'));
        
        if($rowPedido){
            
            
            $rowDetallePedido = $this->_modelPedidos->getDetallePedidos($this->getParam('id'));  
            
            $modelPhA = new Ventas_Model_PedidosHasArticulos();
            $articulosPedido = $modelPhA->getArticulos($this->getParam('id'));
            
            $this->view->pedido = $rowDetallePedido;
            $this->view->articulosPedidos = $articulosPedido;
            //var_dump($articulosPedido);
            
            
        }else{
            
            echo 'No exite';
        }
        
        // action body
    }


}



