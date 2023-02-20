<?php 
include("config.php");

$action = isset($_POST) && isset($_POST["action"]) != "" ? $_POST["action"] : "";


switch($action){
    case "add":
        $arrayField = array();
        $arrayValue = array();
        

        $sqlProducto = "SELECT * FROM tb_producto WHERE ID = " . $_POST["id_producto"] . " ORDER BY nombre ASC";
        $resProducto = $db_conn -> sqlSelect($sqlProducto);

        /*echo "<pre>";
        print_r($resProducto);
        echo "</pre>";*/

        if($resProducto[0]["stock"] - $_POST["cantidad"] > 0) {
            $_POST["valor"] = $_POST["cantidad"] * $resProducto[0]["precio"];

            foreach($_POST as $key => $value){
                if($key != "action") {
                    $arrayField[] = $key;
                    $arrayValue[] = "'" . $value . "'";
                }
            }

            $insVenta = $db_conn -> sqlInsert("tb_venta", $arrayField, $arrayValue);

            if($insVenta == "1"){

                $strSet = "stock = " . $resProducto[0]["stock"] - $_POST["cantidad"];
                $where = "ID = " . $_POST["id_producto"];
                
                $updProducto = $db_conn -> sqlUpdate("tb_producto", $strSet, $where);

                echo "Venta creada";
            } else{
                echo "Venta no se pudo crear. Intente nuevamente. " . $insVenta;
            }
 
        } else {
            echo "Error: el stock del producto no permite realizar la compra con la cantidad registrada. Stock actual: " . $resProducto[0]["stock"] . ". Intente nuevamente";
        }

    break;    
    
    default: 
        $sqlVentas = "SELECT tv.ID, tp.nombre as producto, tv.cantidad, tv.valor, tv.fecha, tc.nombre as categoria FROM tb_venta tv, tb_producto tp, tb_categoria tc WHERE tp.id_categoria = tc.ID AND tv.id_producto = tp.ID  ORDER BY tv.ID DESC";

        $resVentas = $db_conn -> sqlSelect($sqlVentas);

        $sqlProductos = "SELECT * FROM tb_producto WHERE 1 ORDER BY nombre ASC";

        $resProductos = $db_conn -> sqlSelect($sqlProductos);
    break;

}



?>