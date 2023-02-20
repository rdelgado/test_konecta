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

        $insCategoria = $db_conn -> sqlInsert("tb_categoria", $arrayField, $arrayValue);

        if($insCategoria == "1"){
            echo "Categoria creada";
        } else{
            echo "Categoria no se pudo crear. Intente nuevamente. " . $insCategoria;
        }
       

    break;    
    case "edit":
        $id_categoria = $_POST["ID"];
        $sqlCategoria = "SELECT * FROM  tb_categoria WHERE ID = " .   $id_categoria;

        $qryCategoria = $db_conn -> sqlSelect($sqlCategoria);

        echo json_encode(array_shift($qryCategoria));

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

        $updCategoria = $db_conn -> sqlUpdate("tb_categoria", $strSet, $where);

        if($updCategoria == "1"){
            echo "Categoria actualizada";
        } else{
            echo "Categoria no se pudo actualizar. Intente nuevamente. " . $updCategoria;
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

        $delCategoria = $db_conn -> sqlDelete("tb_categoria", $where);

        if($delCategoria == "1"){
            echo "Categoria eliminada.";
        } else{
            echo "Categoria no se pudo eliminar. Intente nuevamente. " . $delCategoria;
        }
    break;
    default: 
        $sqlCategorias = "SELECT * FROM tb_categoria WHERE 1 ORDER BY ID DESC";

        $resCategoria = $db_conn -> sqlSelect($sqlCategorias);
    break;

}



?>