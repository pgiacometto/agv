<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of acceso
 *
 * @author Pedro Giacometto
 */
class Application_Form_Acceso extends Zend_Form
{

    public function init()
    {
        $this->setElementDecorators(array('ViewHelper','Errors'));
        
        $this->addElement('text', 'usuario', array(
            'class' => 'span12',
            'placeorder' => 'Usuario',
            'required' => true
        ));
        $this->addElement('textarea', 'contenido', array(
             'label'=>'Contenido', 
             'rows'=>'6'
        ));
        
        $this->addElement('submit', 'Guardar', array());
        
        
        
        
        
    
    }
}
