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

    public function getDatosCliente($idusuario = NULL)
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
                $this->_modelVendedores->getValores($idusuario)
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
        
        $this->addElement('textarea', 'descripcion', array(
            'label' => 'Descripcion',
            'class' => 'span',          
            'rows' => '3',          
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
    
    public function getDatosArticulos()
    {
        $this->_modelArticulos = new Inventario_Model_Articulos();
        
        $this->setAction('/ventas/pedidos/agregararticulo');

        $this->addElement('select', 'idarticulo', array(
            'label' => 'Articulo',
            'class' => 'span chzn-select',
            'data-placeholder' => 'Seleccione un Articulo',
            'required' => true
        ));
        $this->idarticulo->addMultiOptions(
                $this->_modelArticulos->getValores()
        );
        
        $this->addElement('hidden', 'idpedido', array(
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
        $this->addElement('select', 'desc', array(
            'label' => 'Descuento',
            'class' => 'span',        
            'filters' => array('Digits'),           
        ));
        $this->desc->addMultiOptions(array(
                '0' => '0%',
                '5' => '5%',
                '10' => '10%',
            )
        );
        
        
        $this->idarticulo->addValidator('notEmpty', true, 
               array('messages' => array( 'isEmpty' => 'es obligatorio', ))
               );
        
        $this->cantidad->addValidator('notEmpty', true, 
               array('messages' => array( 'isEmpty' => 'es obligatorio', ))
               );
        
        
        
        return $this;    
    }
    
    public function getCrearCliente()
    {
        $this->addElement('text', 'descripcion', array(
            'label' => 'Razon Social',
            'class' => 'span',                 
        ));
        $this->addElement('text', 'cod', array(
            'label' => 'Codigo',
            'class' => 'span',                 
            'disabled' => 'true',                 
        ));
        $this->addElement('text', 'rif', array(
            'label' => 'Rif',
            'class' => 'span',                 
        ));
        
        return $this;
    }


    public function getBorrar()
    {
        $this->addElement('hidden','id');
        
        return $this;
    }

    //put your code here
}

