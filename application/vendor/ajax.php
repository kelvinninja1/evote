<?php

require '../../config/class.php';

$db = new dbObj();
$connString = $db->getConstring();
$vendorClass = new Vendor($connString);

$requestData = $_REQUEST;

$columns = array(    
    0 => 'id',
    1 => 'company_name',
    2 => 'company_address',    
    3 => 'tlp',
    4 => 'email',
    5 => 'join_date',    
);

$vendorClass->getData($requestData, $columns);
