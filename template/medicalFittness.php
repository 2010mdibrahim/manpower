<?php
include ('database.php');
$passportNum = $_POST['passportNum'];
$creationDate = $_POST['creationDate'];
$medical = $_POST['medical'];
$medicalStatus = $_POST['medicalStatus'];
if($medicalStatus == 'unfit'){
    $updateStatus = 'fit';
}else{
    $updateStatus = 'unfit';
}
$result = $conn->query("UPDATE passport set $medical = '$updateStatus' where passportNum = '$passportNum' AND creationDate = '$creationDate'");
echo "<script> window.location.href='../index.php?page=listCandidate'</script>";

