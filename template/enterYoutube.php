<?php
include ('database.php');
$processingId = $_POST['processingId'];
$youtube = $_POST['youtube'];

$result = $conn->query("UPDATE processing set youtube = '$youtube' where processingId = $processingId");
print_r(mysqli_error($conn));
// echo "<script> window.location.href='../index.php?page=visaList'</script>";
