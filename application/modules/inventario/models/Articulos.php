<?php

class Inventario_Model_Articulos extends Zend_Db_Table_Abstract
{
    protected $_name = 'articulos';
    protected $_primary = 'idarticulo';
    
     public function getAll()
    {
        return $this->fetchAll();
    }
    
    public function getValores()
    {
       $select = $this->select()
               ->from($this->_name, array('idarticulo', 'descripcion', 'cod'));
   
       //return $this->fetchAll($select)->toArray();
       $rowset = $this->fetchAll($select);
       
       $result = array('' => '');
       
       foreach ($rowset as $row) {
           $result[$row->idarticulo] = $row->cod.' | '.$row->descripcion;
       }
       
       return $result;
    }
 

}

