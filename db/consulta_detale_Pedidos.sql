SELECT p.idpedido, p.descripcion, p.comentario, p.status, p.subtotal, p.iva, p.monto_total,
p.despacho, p.create_at, cp.descripcion, c.cod, c.descripcion, c.rif, c.representante,
c.dir1, c.telf, c.email, v.cod, v.nombre, v.telf2
FROM pedidos as p
JOIN condicion_pago as cp 
ON p.idcondicion_pago = cp.idcondicion_pago
JOIN clientes as c 
ON p.idcliente = c.idcliente
JOIN vendedores as v 
ON p.idvendedor = v.idvendedor 
