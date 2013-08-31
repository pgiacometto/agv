<?php

class Ventas_Model_PedidosHasArticulos extends Zend_Db_Table_Abstract
{
    
    protected $_name = 'pedidos_has_articulos';
    protected $_primary = 'idpha';
    
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
                ->from(array('pha' => 'pedidos_has_articulos'),array('pha.idpha','pha.idpedido', 'a.idarticulo','ap.precio1', 'a.cod', 'a.descripcion',  'pha.cantidad', 'pha.desc'))
                ->join(array('a' => 'articulos'), 'pha.idarticulo = a.idarticulo',array(''))               
                ->join(array('ap' => 'articulos_precios'), 'a.cod = ap.articulo_cod',array(''))               
                             
                ->setIntegrityCheck(false);
              
        
        if($idpedido){
            $query->where('pha.idpedido = '.$idpedido);
        }
         
       return $this->fetchAll( $query );
        
    }
    
    public function getArticulo($id)
    {
        $fila = $this->find($id)->current();
        return $fila;
    }
    
    public function rowArticuloToArray($id)
    {
        $rowPedido = $this->getArticulo($id);
       

        $result = array(
            'id' => $rowPedido->idpha,
            'idpedido' => $rowPedido->idpedido,
            'idarticulo' => $rowPedido->idarticulo,
            'cantidad' => $rowPedido->cantidad,
            'desc' => $rowPedido->desc,           
        );



        return $result;
    }

}

