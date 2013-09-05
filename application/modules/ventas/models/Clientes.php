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
               ->from($this->_name, array('idcliente', 'descripcion', 'cod', 'rif'))
               ->order('cod asc');
   
       //return $this->fetchAll($select)->toArray();
       $rowset = $this->fetchAll($select);
       
       $result = array('' => '');
       
       foreach ($rowset as $row) {
           $result[$row->idcliente] = $row->rif.'  '.$row->cod. '  '.$row->descripcion;
       }
       
       return $result;
    }
   
     public function addCliente($data)
    {

        $row = $this->createRow();

        $row->idcliente = '';
        $row->cod = strtoupper($data['cod']);
        $row->rif = strtoupper($data['rif']);
        $row->descripcion = strtoupper($data['descripcion']);
        
//      $row->setFromArray($array);
        $row->save();

        return $row;
    }
    
    public function addClienteTemporal($data)
    {
       $data['cod'] = 'XXX';
       //$data['cod'] = $data['rif'];
       
       $row = $this->addCliente($data);
       
       return $row;
    }

}

