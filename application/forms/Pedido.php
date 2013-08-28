<?php

/**
 * Description of Pedido
 *
 * @author Pedro Giacometto
 */
class Application_Form_Pedido extends Zend_Form
{

    private $_modelClientes = null;
    private $_modelVendedores = null;
    private $_modelCondicionPago = null;
    private $_modelArticulos = null;
  

    public function init()
    {
        $this->setElementDecorators(array(
            'ViewHelper'
                )
        );

        $this->_modelClientes = new Ventas_Model_Clientes();
        $this->_modelVendedores = new Ventas_Model_Vendedores();
        $this->_modelCondicionPago = new Ventas_Model_CondicionPago();
       
    }

    public function getDatosCliente()
    {
        $this->setAction('/ventas/pedidos/nuevo');

        $this->addElement('select', 'cliente', array(
            'label' => 'Cliente',
            'class' => 'span chzn-select',
            'data-placeholder' => 'Selecciona el cliente...',
            'required' => true
        ));
        $this->cliente->addMultiOptions(
                $this->_modelClientes->getValores()
        );

        $this->addElement('select', 'vendedor', array(
            'label' => 'Vendedor',
            'class' => 'span chzn-select',
            'data-placeholder' => 'Seleccione el Vendedor...',
            'required' => true
        ));
        $this->vendedor->addMultiOptions(
                $this->_modelVendedores->getValores()
        );
        $this->addElement('select', 'condPago', array(
            'label' => 'Cond Pago',
            'class' => 'span chzn-select',
            'data-placeholder' => 'Selecciona la forma de pago...',
            'required' => true
        ));
        $this->condPago->addMultiOptions(
                $this->_modelCondicionPago->getValores()
        );
        
        $this->addElement('text', 'status', array(
            'label' => 'Status',
            'class' => 'span',
            'disable' => true,
        ));

        $this->addElement('text', 'fechaCreado', array(
            'label' => 'Fecha Creacion',
            'class' => 'span',
            'disable' => true,
            'filters' => array('StringTrim', 'StripTags'),
            'validators' => array('date')
        ));

        $this->addElement('text', 'fechaDespacho', array(
            'label' => 'Fecha Despacho',
            'class' => 'span input-mask-date date-picker',        
            'data-date-format' => 'dd/mm/yyyy',        
        ));
        
        $this->addElement('text', 'descripcion', array(
            'label' => 'Descripcion',
            'class' => 'span',          
        ));
        
        // Validaciones
        
         $this->cliente->addValidator('notEmpty', true, 
               array('messages' => array( 'isEmpty' => 'es obligatorio', ))
               );
         $this->vendedor->addValidator('notEmpty', true, 
               array('messages' => array( 'isEmpty' => 'es obligatorio', ))
               );
         $this->fechaDespacho->addValidator('date', true, 
               array('messages' => array('dateFalseFormat' => ' no es una fecha valida (ejm: dd/mm/aa)', ))
               );
        

        return $this;
    }
    
    public function getArticulos()
    {
        $this->_modelArticulos = new Inventario_Model_Articulos();
        
        $this->setAction('/ventas/pedidos/nuevoarticulo');

        $this->addElement('select', 'articulo', array(
            'label' => 'Articulo',
            'class' => 'span chzn-select',
            'data-placeholder' => '.',
            'required' => true
        ));
        $this->articulo->addMultiOptions(
                $this->_modelArticulos->getValores()
        );
        
        $this->addElement('text', 'idpedido', array(
            'label' => 'N° de Pedido',
            'class' => 'span',
            'disable' => true,
            'filters' => array('Alnum'),           
        ));
        
        $this->addElement('text', 'cantidad', array(
            'label' => 'cantidad',
            'class' => 'span',        
            'filters' => array('Digits'),           
        ));
        $this->addElement('text', 'desc', array(
            'label' => 'Descuento',
            'class' => 'span',        
            'filters' => array('Digits'),           
        ));
        
        $this->articulo->addValidator('notEmpty', true, 
               array('messages' => array( 'isEmpty' => 'es obligatorio', ))
               );
        
        $this->cantidad->addValidator('notEmpty', true, 
               array('messages' => array( 'isEmpty' => 'es obligatorio', ))
               );
        
        
        
        return $this;    
    }

    //put your code here
}

