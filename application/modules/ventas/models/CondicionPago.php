<?php

class Ventas_Model_CondicionPago extends Zend_Db_Table_Abstract
{
    protected $_name = 'condicion_pago';
    protected $_primary = 'idcondicion_pago';
    
    
    public function getAll()
    {
        $this->fetchAll();
    }
    
    public function getValores()
    {
        $select = $this->select()
                ->from($this->_name, array('idcondicion_pago', 'descripcion'));

        //return $this->fetchAll($select)->toArray();
        $rowset = $this->fetchAll($select);

        $result = array();

        foreach ($rowset as $row) {
            $result[$row->idcondicion_pago] = $row->descripcion;
        }

        return $result;
    }
    //put your code here
}

