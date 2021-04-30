<?php
include ('database.php');
$processingId = $_POST['processingId'];
if(isset($_POST['complete'])){
    $result = $conn->query("UPDATE processing set pending = 2 where processingId = $processingId");
}
if(isset($_POST['return'])){
    $result = $conn->query("UPDATE processing set pending = 3 where processingId = $processingId");
}
echo "<script> window.location.href='../index.php?page=pendingVisaList'</script>";
