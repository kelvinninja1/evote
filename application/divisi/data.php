<?php

include_once '../../config/class.php';

$db = new dbObj();
$connString = $db->getConstring();

$params = $_REQUEST;

$action = isset($params['action']) != '' ? $params['action'] : '';
$crudClass = new CRUD($connString);

switch ($action) {
    case 'add' : $crudClass->insertData($params); break;
    case 'edit' : $crudClass->updateData($params); break;
    case 'delete' : $crudClass->deleteData($params); break;
    default : break;        
}

class CRUD {

    protected $conn;    

    function __construct($connString) {
        $this->conn = $connString;
    }
    
    function insertData($params) {
        
        $numData = $this->cekData($params);

        if($numData > 0) {
            echo 1;
        }else{
            $sql = "INSERT INTO master_divisi";
            $sql .= " (kode_divisi, nama_divisi)";
            $sql .= " VALUES('".addslashes($params['kode'])."', "
                    . "'".  addslashes($params['divisi'])."')";

            $result = mysqli_query($this->conn, $sql) or die("error to insert data");
            echo 0;
        }                
    }

    function updateData($params) {

        $numData = $this->cekData($params);

        if($numData > 1) {
            echo 1;
        }else{
            $sql = "UPDATE master_divisi";
            $sql .= " SET kode_divisi = '".addslashes($params['kode'])."', ";
            $sql .= " nama_divisi = '".  addslashes($params['divisi'])."'";
            $sql .= " WHERE id = '" . $_POST['edit_id'] . "'";

            $result = mysqli_query($this->conn, $sql) or die("error to update data");
            echo 0;
        }                
    }

    function deleteData($params) {
        
        $sql = "DELETE from master_divisi";
        $sql .= " WHERE id = '" . $_POST['id'] . "'";

        $result = mysqli_query($this->conn, $sql) or die("error to delete data");
        echo 'delete';
    }

    function cekData($params) {
        
        $sql = "SELECT * FROM master_divisi";
        $sql .= " WHERE kode_divisi LIKE '%".addslashes($params['kode'])."%' OR "
                . "nama_divisi LIKE '".addslashes($params['divisi'])."'";
        
        $query = mysqli_query($this->conn, $sql) or die('error to cek data');
        $numData = intval($query->num_rows);

        return $numData;
    }

}
