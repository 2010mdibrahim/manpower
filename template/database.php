<?php
include('class/getConnectionController.php');
session_start();
$path = 'C:/xampp/htdocs/mahfuza/';
$gettingConn = new getConnectionController();
$conn = $gettingConn->getConnection();
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'samin_erp';
$req_urldd = explode("/",$_SERVER['REQUEST_URI']);
$auto_url_finder = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://" . $_SERVER['HTTP_HOST']."/".$req_urldd[1].'/';
$home = $auto_url_finder;
if(file_exists($path)){
    $base_dir = $path;
    $datable_path = 'http://localhost/mahfuza/';
}else{
    $base_dir = '//10.100.105.200/g/xampp/htdocs/mahfuza/';
    $datable_path = '//'.$_SERVER['HTTP_HOST']."/".$req_urldd[1].'/';
}
?>