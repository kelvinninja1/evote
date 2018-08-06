<?php

require '../../../config/class.php';

$db = new dbObj();
$connString = $db->getConstring();
$userClass = new User($connString);

$requestData = $_REQUEST;

$columns = array(    
    0 => 'id',
    1 => 'username',
    2 => 'fullname',
    3 => 'role'
);

$userClass->getData($requestData, $columns);
