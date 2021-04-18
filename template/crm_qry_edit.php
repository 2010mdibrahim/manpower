<?php
include ('database.php');
$id = $_POST['id'];
if(isset($_POST['alter'])){
    $result = $conn->query("DELETE from crm where id = $id");
}else{
    $comment = $_POST['comment'];
    $result = $conn->query("UPDATE crm set comment = '$comment' where id = $id");
}
echo "<script> window.location.href='../index.php?page=crm'</script>";
