<?php
session_start();
$server='localhost';
$user='root';
$password='!@#$%databaseserveradmin2020';
$dbname='samin_erp';
$conn=mysqli_connect($server,$user,$password,$dbname);
$path = 'C:/xampp/htdocs/mahfuza/';
if(file_exists($path)){
    $base_dir = $path;
}else{
    $base_dir = '//10.100.105.200/g/xampp/htdocs/mahfuza/';
}
if(!$conn){
    die("not connected".mysqli_connect_error());
}
?>

<script>
    function custom_alert(){
        let element = document.createElement('div');
        element.setAttribute('style','position:absolute; top:50%; left:50%; background-color:black');
        element.innerHTML('This is test');
        setTimeout(function(){
            element.parentNode.removeChild(element);
        },500);
        document.body.appendChild(element);
    }
</script>