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
    private $_date;

    public function init()
    {
        $this->setElementDecorators(array(
            'ViewHelper'
                )
        );

        $this->_modelClientes = new Ventas_Model_Clientes();
        $this->_modelVendedores = new Ventas_Model_Vendedores();
        $this->_modelCondicionPago = new Ventas_Model_CondicionPago();
        $this->_date = new Zend_Date();
        
    }

    public function getDatosCliente()
    {
        $this->setAction('ventas/pedidos/nuevo');
             
        $this->addElement('select', 'cliente', array(
             'label'=>'Cliente', 
             'class'=>'span4 chzn-select' 
        ));
            $this->cliente->addMultiOptions(
            $this->_modelClientes->getValores()
            );
        
        $this->addElement('select', 'vendedor', array(
             'label'=>'Vendedor', 
             'class'=>'span' 
        ));
            $this->vendedor->addMultiOptions(
            $this->_modelVendedores->getValores()
            );
        $this->addElement('select', 'condPago', array(
             'label'=>'Cond Pago', 
             'class'=>'span' 
        ));
            $this->condPago->addMultiOptions(
            $this->_modelCondicionPago->getValores()
            );
            
        $this->addElement('text', 'fecha', array(
            'label' => 'Fecha Creacion', 
            'class' => 'span', 
            'required' => true, 
            'disable' => true, 
            'filters' => array('StringTrim', 'StripTags'), 
            'validators' => array('date')
            ));
            
            $this->setDefault('fecha', $this->_date->now()->toString('dd/MM/yyyy') );
           

        return $this;
    }

    //put your code here
}

