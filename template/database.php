<?php
include('class/getConnectionController.php');
session_start();
$path = 'C:/xampp/htdocs/mahfuza/';
$gettingConn = new getConnectionController();
$conn = $gettingConn->getConnection();
$host = 'localhost';
$user = 'root';
$pass = '!@#$%databaseserveradmin2020';
$db = 'samin_erp';
if(file_exists($path)){
    $base_dir = $path;
}else{
    $base_dir = '//10.100.105.200/g/xampp/htdocs/mahfuza/';
}
?>