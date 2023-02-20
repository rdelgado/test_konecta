<?php 
include("config.php");

$action = isset($_POST) && isset($_POST["query"]) != "" ? $_POST["query"] : "";


switch($action){
    case "stock":
        
        

        $sqlProducto = "SELECT nombre as producto, MAX(stock) as mayor_stock FROM tb_producto WHERE 1 ORDER BY nombre ASC";
        $resProducto = $db_conn -> sqlSelect($sqlProducto);



        if(sizeof($resProducto) > 0) {
            echo json_encode(array_shift($resProducto));
 
        } else {
            echo "No existen productos con el reporte solicitado";
        }

    break;    
    case "vendido"  :
        $sqlVendido = "SELECT nombre as producto, count(id_producto) as total_ventas FROM tb_venta tv, tb_producto tp WHERE tv.id_producto = tp.ID group by id_producto order by total_ventas DESC limit 0,1";
        $qryVendido = $db_conn -> sqlSelect($sqlVendido);



        if(sizeof($qryVendido) > 0) {
            echo json_encode(array_shift($qryVendido));
 
        } else {
            echo "No existen productos con el reporte solicitado";
        }

    break; 

}



?>