<?php

require '../../config/class.php';

$db = new dbObj();
$connString = $db->getConstring();
$kategoriClass = new Kategori($connString);

$requestData = $_REQUEST;

$columns = array(    
    0 => 'id',    
    1 => 'kode_kategori',
    2 => 'nama_kategori'
);

$kategoriClass->getData($requestData, $columns);
