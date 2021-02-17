<?php
session_start();
$server='localhost';
$user='root';
$password='';
$dbname='samin_erp';
$conn=mysqli_connect($server,$user,$password,$dbname);
if(!$conn){
    die("not connected".mysqli_connect_error());
}
