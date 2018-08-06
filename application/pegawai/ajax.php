<?php

require '../../config/class.php';

$db = new dbObj();
$connString = $db->getConstring();
$pegawaiClass = new Pegawai($connString);

$requestData = $_REQUEST;

$columns = array(
    0 => 'id',
    1 => 'no_induk',
    2 => 'nama_pegawai',
    3 => 'nama_divisi',
    4 => 'nama_department',
    5 => 'nama_jabatan',
    6 => 'alamat_pegawai',
    7 => 'no_tlp',
    8 => 'email'
);

$pegawaiClass->getData($requestData, $columns);
