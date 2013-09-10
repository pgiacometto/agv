<?php

class Ventas_Model_Pedidos extends Zend_Db_Table_Abstract
{

    protected $_name = 'pedidos';
    protected $_primary = 'idpedido';

    public function addPedido($data,$idusuario)
    {

        $row = $this->createRow();

        $row->idcondicion_pago = $data['condPago'];
        $row->idcliente = $data['cliente'];
        $row->idvendedor = $data['vendedor'];
        $row->descripcion = $data['descripcion'];
        $row->despacho = $data['fechaDespacho'];
        $row->idusuario = $idusuario;
        $row->status = 'Registrado';

//      $row->setFromArray($array);
        $row->save();

        return $row;
    }
    
    public function getLista()
    {
        return $this->fetchAll();    
        
    }
    
    public function getListaPedidos($idusuario = NULL)
    {
        $query = $this->select()
                ->from(array('p' => 'pedidos'),array('p.idpedido','p.descripcion', 'p.status', 
                                                     'p.monto_total','p.create_at','v.cod', 'v.nombre',''))
                ->join(array('v' => 'vendedores'), 'p.idvendedor = v.idvendedor',array(''))                                           
                ->setIntegrityCheck(false);
              
        
        if($idusuario){
            $query->where('p.idusuario = '.$idusuario);
        }
        $query->order('p.create_at ASC');
        
       return $this->fetchAll( $query );
        
    }



    public function getPedido($id)
    {
        $fila = $this->find($id)->current();
        return $fila;
    }

    public function rowPedidoToArray($rowPedido)
    {
        if ($rowPedido->status > 0) {
            switch ($rowPedido->status) {
                case 1:
                    $rowPedido->status = 'Registrado';

                    break;
                case 2:
                    $rowPedido->status = 'Procesado';

                    break;

                default:
                    $rowPedido->status = 'Sin Registrar';
                    break;
            }
        }

        $result = array(
            'id' => $rowPedido->idpedido,
            'cliente' => $rowPedido->idcliente,
            'vendedor' => $rowPedido->idvendedor,
            'condPago' => $rowPedido->idcondicion_pago,
            'fechaCreado' => $rowPedido->create_at,
            'fechaDespacho' => $rowPedido->despacho,
            'descripcion' => $rowPedido->descripcion,
            'status' => $rowPedido->status,
        );



        return $result;
    }

}

