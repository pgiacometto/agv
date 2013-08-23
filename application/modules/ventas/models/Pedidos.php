<?php

class Ventas_Model_Pedidos extends Zend_Db_Table_Abstract
{

    protected $_name = 'pedidos';
    protected $_primary = 'idpedido';

    public function addPedido($data)
    {

        $row = $this->createRow();

        $row->idcondicion_pago = $data['condPago'];
        $row->idcliente = $data['cliente'];
        $row->idvendedor = $data['vendedor'];
        $row->descripcion = $data['descripcion'];
        $row->despacho = $data['fechaDespacho'];
        $row->status = 'Registrado';

//      $row->setFromArray($array);
        $row->save();

        return $row;
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

