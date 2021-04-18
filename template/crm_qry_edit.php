<?php
include ('database.php');
$comment = $_POST['comment'];
$id = $_POST['id'];

$result = $conn->query("UPDATE crm set comment = '$comment' where id = $id");

echo "<script> window.location.href='../index.php?page=crm'</script>";
