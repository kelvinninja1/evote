<?php
//get session(user) admin application
session_start();
//set class & configuration
require_once 'config/function.php';
require_once 'config/class.php';

$main = new Main();
include 'model/main.php';

?>		