<?php

require '../../config/class.php';

$db = new dbObj();
$connString = $db->getConstring();
$departmentClass = new Department($connString);

$requestData = $_REQUEST;

$columns = array(    
    0 => 'id',    
    1 => 'kode_department',
    2 => 'nama_department'
);

$departmentClass->getData($requestData, $columns);
