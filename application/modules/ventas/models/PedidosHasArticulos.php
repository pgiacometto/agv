<?php

class Ventas_Model_PedidosHasArticulos extends Zend_Db_Table_Abstract
{
    
    protected $_name = 'pedidos_has_articulos';
    protected $_primary = array('idpedido', 'idarticulo');
    
    public function addPedidoHasArticulo($data)
    {

        $row = $this->createRow();

        $row->idarticulo = $data['idarticulo'];
        $row->idpedido = $data['idpedido'];
        $row->cantidad = $data['cantidad'];
        $row->desc = $data['desc'];
        

//      $row->setFromArray($array);
        $row->save();

        return $row;
    }
    
    public function getArticulos($idpedido = NULL)
    {
        $query = $this->select()
                ->from(array('pha' => 'pedidos_has_articulos'),array('pha.idpedido', 'a.idarticulo', 'a.cod', 'a.descripcion',  'pha.cantidad', 'pha.desc'))
                ->join(array('a' => 'articulos'), 'pha.idarticulo = a.idarticulo',array(''))               
                             
                ->setIntegrityCheck(false);
              
        
        if($idpedido){
            $query->where('pha.idpedido = '.$idpedido);
        }
               
       return $this->fetchAll( $query );
        
    }

}

