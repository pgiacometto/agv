SELECT pha.idpedido, a.idarticulo, a.cod, a.descripcion, p.precio1, pha.cantidad, pha.desc
FROM pedidos_has_articulos as pha
JOIN articulos as a 
ON pha.idarticulo = a.idarticulo 
JOIN articulos_precios as p
ON
a.cod = p.articulo_cod