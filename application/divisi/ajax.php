<?php

require '../../config/class.php';

$db = new dbObj();
$connString = $db->getConstring();
$divisiClass = new Divisi($connString);

$requestData = $_REQUEST;

$columns = array(    
    0 => 'id',    
    1 => 'kode_divisi',
    2 => 'nama_divisi'
);

$divisiClass->getData($requestData, $columns);
