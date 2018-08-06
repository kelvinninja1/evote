<?php

include_once '../../config/class.php';
$db = new dbObj();
$connString = $db->getConstring();

$params = $_REQUEST;
$tb_name = "data_vendor";

$action = isset($params['action']) != '' ? $params['action'] : '';
$crudClass = new CRUD($connString);

switch ($action) {
    case 'add' : $crudClass->insertData($params, $tb_name); break;
    case 'edit' : $crudClass->updateData($params, $tb_name); break;
    case 'delete' : $crudClass->deleteData($params, $tb_name); break;
    default : break;
}

class CRUD {

    protected $conn;

    function __construct($connString) {
        $this->conn = $connString;
    }
    
    function insertData($params, $tb_name) {
            
        $sql = "INSERT INTO ".$tb_name;
        $sql .= " (company_name, company_address, tlp, email, join_date)";
        $sql .= " VALUES('".addslashes($params['cname'])."', "
                . "'".addslashes($params['caddress']). "', '" .addslashes($params['tlp']). "', "
                . "'".addslashes($params['email'])."', '".$params['jdate']."')";                

        echo $result = mysqli_query($this->conn, $sql) or die("error to insert data");
    }

    function updateData($params, $tb_name) {
        
        $sql = "UPDATE ".$tb_name;
        $sql .= " SET company_name = '".addslashes($params['cname'])."', "
                . " company_address ='".addslashes($params['caddress'])."', "
                . " tlp = '".addslashes($params['tlp'])."', "
                . " email = '".addslashes($params['email'])."', "
                . " join_date = '".$params['jdate']."'";
        $sql .= " WHERE id = '".$_POST['edit_id']."'";

        echo $result = mysqli_query($this->conn, $sql) or die("error to update data");
    }

    function deleteData($params, $tb_name) {
        
        $sql = "DELETE FROM ".$tb_name;
        $sql .= " WHERE id = '".$params['id']."'";

        echo $result = mysqli_query($this->conn, $sql) or die("error to delete data");
    }

}
