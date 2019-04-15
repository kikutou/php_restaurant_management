<?php

class Db{

 public function connect_db(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "order_system";
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4",$username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }
    catch(PDOException $e) {
        echo $e->getMessage();
        exit();
    }
    $conn = null;
  }

}

?>
