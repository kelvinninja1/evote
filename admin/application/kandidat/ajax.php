<?php

require '../../../config/class.php';

$db = new dbObj();
$connString = $db->getConstring();
$kandidatClass = new Kandidat($connString);

$requestData = $_REQUEST;

$columns = array(    
    0 => 'id',
    1 => 'nama_ketua',
    2 => 'nama_wakil',
    3 => 'photo'
);

$kandidatClass->getData($requestData, $columns);
