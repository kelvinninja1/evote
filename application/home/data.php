<?php

require_once '../../config/class.php';
$db = new dbObj();
$connString = $db->getConstring();
$homeClass = new homeClass($connString);
$params = $_REQUEST;

$action = isset($params['action']) != '' ? $params['action'] : '';

switch ($action) {
    default : $json_data = array(
            'jKepuasan' => $homeClass->getKepuasan($params),
            'jKeluhan' => $homeClass->getKeluhan($params),
            'jClient' => $homeClass->getClient($params)
        );
        echo json_encode($json_data);
        break;
}

class homeClass {

    protected $conn;

    function __construct($connString) {
        $this->conn = $connString;
    }

    function getKepuasan($params) {
        
        $sql = "SELECT * FROM data_kepuasan";
        $result = mysqli_query($this->conn, $sql) or die();
        $qTotal = intval($result->num_rows);

        return $qTotal;
    }
    
    function getKeluhan($params) {
        
        $sql = "SELECT * FROM data_keluhan";
        $result = mysqli_query($this->conn, $sql) or die();
        $qTotal = intval($result->num_rows);

        return $qTotal;
    }
    
    function getClient($params) {
        
        $sql = "SELECT * FROM data_client";
        $result = mysqli_query($this->conn, $sql) or die();
        $qTotal = intval($result->num_rows);

        return $qTotal;
    }

}
