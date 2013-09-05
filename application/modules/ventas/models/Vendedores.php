<?php

class Ventas_Model_Vendedores extends Zend_Db_Table_Abstract
{

    protected $_name = 'vendedores';
    protected $_primary = 'idvendedor';

    public function getAll()
    {
        return $this->fetchAll();
    }

    public function getValores($where = NULL)
    {
        $select = $this->select()
                ->from($this->_name, array('idvendedor', 'nombre','cod'));

        //return $this->fetchAll($select)->toArray();
        if($where){
            $select->where($where);
        }
        $rowset = $this->fetchAll($select);

        $result = array('' => '');

        foreach ($rowset as $row) {
            $result[$row->idvendedor] = $row->cod.' - '.$row->nombre;
        }

        return $result;
    }

}

