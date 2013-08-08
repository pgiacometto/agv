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
        $this->setElementDecorators(array(
            'ViewHelper', 
            array('Errors', array('class' => 'errorboot')),
            )
                ); 
        
    }
    
    public function getLogin()
    {
        $this->setAction('/acceso');
        
        $this->addElement('text', 'usuario', array(
            'class' => 'span12',
            'placeholder' => 'Usuario',
            'filters' => array('StringTrim', 'StringToLower'),    
            'required' => true
        ));
        $this->addElement('password', 'clave', array(
            'class' => 'span12',
            'placeholder' => 'Clave',
            'required' => true
        ));
        
       // $this->addElement('submit', 'Enviar', array());
        
       
       $this->usuario->addValidator('notEmpty', true, 
               array('messages' => array( 'isEmpty' => 'Usuario es obligatorio', ))
               );
       $this->usuario->addValidator('EmailAddress', true,
               array('messages' => array( 'emailAddressInvalidFormat' => 'Usuario debe ser un email valido', ))
               );
             
      
       
        return $this;
    }
    
   
}
