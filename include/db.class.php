<?php 
class db {
    private $conn;
    public $db;
    
    function __construct($servername, $username, $password){
        try {
            $this -> conn = new PDO("mysql:host=$servername;dbname=test_konecta", $username, $password);
            // set the PDO error mode to exception
            $this -> conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this -> db = true;
        } catch(PDOException $e) {
            $this -> db = $e->getMessage();
        }
    }

    function validateConn(){
        return $this-> db;
    }

    function closeConn(){
        $this -> db = "";
        return $this -> conn = null;
        
    }

    function sqlSelect($sql){
        try {
            
            $stmt =  $this -> conn->prepare($sql);
            $stmt->execute();
          
            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetchAll();
           
          } catch(PDOException $e) {
            return "Error: " . $e->getMessage();
          }
    }

    function sqlInsert($table, $arrayField, $arrayValue){
        try {
            $fields = implode(",", $arrayField);
            $values = implode(",", $arrayValue);

            $sql = "INSERT INTO  ". $table ." (" . $fields . ")
            VALUES (" . $values . ")";

            // use exec() because no results are returned
            return $this -> conn->exec($sql);
                       
        } catch(PDOException $e) {
                return "Error: " . $sql . " - " . $e->getMessage();
        }
    }

    function sqlDelete($table, $where){
        try {

            $sql = "DELETE FROM " . $table . " WHERE " . $where;

            // use exec() because no results are returned

            return $this -> conn->exec($sql);
                           
        } catch(PDOException $e) {
            return "Error: " . $sql . " - " . $e->getMessage();
        }
    }

    function sqlUpdate($table, $strSet, $where){
        try {
            
            $sql = "UPDATE " . $table . " SET ". $strSet . " WHERE " . $where;

            // Prepare statement
            $stmt = $this -> conn->prepare($sql);

            // execute the query
            return $stmt->execute();
                           
        } catch(PDOException $e) {
            return "Error: " . $sql . " - " . $e->getMessage();
        }
    }

    
}


?>