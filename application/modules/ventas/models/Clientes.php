<?php

class Ventas_Model_Clientes extends Zend_Db_Table_Abstract
{
    protected $_name = 'clientes';
    protected $_primary = 'idcliente';
    
     public function getAll()
    {
        return $this->fetchAll();
    }
    
    public function getValores()
    {
       $select = $this->select()
               ->from($this->_name, array('idcliente', 'descripcion', 'cod'));
   
       //return $this->fetchAll($select)->toArray();
       $rowset = $this->fetchAll($select);
       
       $result = array();
       
       foreach ($rowset as $row) {
           $result[$row->idcliente] = $row->cod.' | '.$row->descripcion;
       }
       
       return $result;
    }
   

}

