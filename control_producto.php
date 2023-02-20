<?php 
include("config.php");

$action = isset($_POST) && isset($_POST["action"]) != "" ? $_POST["action"] : "";


switch($action){
    case "add":
        $arrayField = array();
        $arrayValue = array();
        foreach($_POST as $key => $value){
            if($key != "action") {
                $arrayField[] = $key;
                $arrayValue[] = "'" . $value . "'";
            }
        }

        $insProducto = $db_conn -> sqlInsert("tb_producto", $arrayField, $arrayValue);

        if($insProducto == "1"){
            echo "Producto creado";
        } else{
            echo "Producto no se pudo crear. Intente nuevamente. " . $insProducto;
        }

    break;    
    case "edit":
        $id_producto = $_POST["ID"];
        $sqlProducto = "SELECT tp.ID, tp.nombre, tp.referencia, tp.stock, tp.precio, tp.peso, tp.fecha, tp.id_categoria, tc.nombre as categoria FROM tb_producto tp, tb_categoria tc WHERE tp.id_categoria = tc.ID AND tp.ID = " .   $id_producto;

        $resProducto = $db_conn -> sqlSelect($sqlProducto);

        echo json_encode(array_shift($resProducto));

    break;    
    case "update":
        $strSet = "";
        $where = "";
        foreach($_POST as $key => $value){
            if($key == "ID"){
                $where = $key . " = '" . $value . "'";
            } else if($key == "action") {
                continue;
            } else {                
                $strSet .= $strSet == "" ? $key . "=" . "'" . $value . "'" : ", " . $key . "=" . "'" . $value . "'" ;
                
            }
        }

        $updProducto = $db_conn -> sqlUpdate("tb_producto", $strSet, $where);

        if($updProducto == "1"){
            echo "Producto actualizado";
        } else{
            echo "Producto no se pudo actualizar. Intente nuevamente. " . $updProducto;
        }
    break;
    case "delete":
        $where = "";
        foreach($_POST as $key => $value){
            if($key == "ID"){
                $where = $key . " = '" . $value . "'";
            } else  {
                continue;
            }
        }

        $delProducto = $db_conn -> sqlDelete("tb_producto", $where);

        if($delProducto == "1"){
            echo "Producto eliminado";
        } else{
            echo "Producto no se pudo eliminar. Intente nuevamente. " . $delProducto;
        }
    break;
    default: 
        $sqlProductos = "SELECT tp.ID, tp.nombre, tp.referencia, tp.stock, tp.fecha, tc.nombre as categoria FROM tb_producto tp, tb_categoria tc WHERE tp.id_categoria = tc.ID ORDER BY tp.ID DESC";

        $resProductos = $db_conn -> sqlSelect($sqlProductos);

        $sqlCategoria = "SELECT * FROM tb_categoria  WHERE 1 ORDER BY nombre";

        $resCategoria = $db_conn -> sqlSelect($sqlCategoria);
    break;

}



?>