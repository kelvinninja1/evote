<?php

require '../../config/class.php';

$db = new dbObj();
$connString = $db->getConstring();
$jabatanClass = new Jabatan($connString);

$requestData = $_REQUEST;

$columns = array(    
    0 => 'id',    
    1 => 'kode_jabatan',
    2 => 'nama_jabatan'
);

$jabatanClass->getData($requestData, $columns);
