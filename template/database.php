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