<?php
include_once '../../../config/class.php';
$db = new dbObj();
$connString = $db->getConstring();
$crudClass = new CRUD($connString);

if(!isset($_GET['id'])){
    exit();
}else{
    $params = $_GET['id'];
    $tb_name = $_GET['tb_name'];
}
if ($params > 0) {
    $crudClass->getData($params, $tb_name);
} else {
    mysql_errno();
}

class CRUD {

    protected $conn;
    protected $data = [];

    function __construct($connString) {
        $this->conn = $connString;
    }

    function getData($params, $tb_name) {        
        $sql = "SELECT * FROM ".$tb_name;
        $sql .= " WHERE id = $params";

        $result = mysqli_query($this->conn, $sql) or die();
                
        while ($row = mysqli_fetch_assoc($result)) {            
            $data = $row;
        }
        echo json_encode($data);
    }
}
