<?php
include ('database.php');
$processingId = $_POST['processingId'];
$result = $conn->query("UPDATE processing set pending = 3 where processingId = $processingId");
echo "<script> window.location.href='../index.php?page=pendingVisaList'</script>";
