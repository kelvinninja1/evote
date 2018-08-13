<?php
session_start();
require_once '../../config/class.php';

$db = new dbObj();
$connString = $db->getConstring();
$homeClass = new homeClass($connString);
$params = $_REQUEST;

$action = isset($params['action']) != '' ? $params['action'] : '';

switch ($action) {
    case 'login' : $homeClass->login($params); break;
    default : break;
}

class homeClass {

    protected $conn;
    protected $data = [];
    
    function __construct($connString) {
        $this->conn = $connString;
    }

    function login($params) {
        $gen_code = strtolower($params['noreg']);
        $sql = "SELECT * FROM data_pemilih";
        $sql .= " WHERE no_reg = '$gen_code'";
                  
        $query = mysqli_query($this->conn, $sql) or die('error to query');
        $num = mysqli_num_rows($query);
        
        if($num < 1) {
            echo 404;
        } else {
            $data = mysqli_fetch_assoc($query);
            if($data['status_vote'] == 0) {
                $_SESSION['sesi_pilih'] = TRUE;
                $_SESSION['id_user'] = $data['id'];
                echo 0;
            } else {
                echo 1;
                session_destroy();
            }
        }
    }

}
