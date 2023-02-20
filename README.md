# test_konecta

1. Colocar achivos de este repositorio en la raiz del servidor local o ambiente e internet, en una carpeta que se llame test_konecta
2. Crear DB con nombre test_konecta en phpmyadmin o mysql command desde linux
3. Importar archivo llamado test_konecta.sql (adjunto en correo) en phpmyadmin o por comando dump en linux. Este ya cuenta con información
4. Ejecutar archivo index.php en cualquier navegador
5. Realizar una consulta que permita conocer cuál es el producto que más stock tiene: SELECT nombre as producto, MAX(stock) as mayor_stock FROM tb_producto WHERE 1 ORDER BY nombre ASC
Realizar una consulta que permita conocer cuál es el producto más vendido: SELECT nombre as producto, count(id_producto) as total_ventas FROM tb_venta tv, tb_producto tp WHERE tv.id_producto = tp.ID group by id_producto order by total_ventas DESC limit 0,1
