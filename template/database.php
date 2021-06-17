<?php
include('class/getConnectionController.php');
session_start();
$path = 'http://localhost/mahfuza/';
$live_path = 'http://erp.superhostelbd.com/mahfuza/';
$gettingConn = new getConnectionController();
$conn = $gettingConn->getConnection();
$host = 'localhost';
$user = 'root';
$pass = '!@#$%databaseserveradmin2020';
$db = 'samin_erp';
$base_dir = $live_path;

?>