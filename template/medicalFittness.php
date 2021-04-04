<?php
include ('database.php');
$medical = $_POST['medical'];
$passportNum = $_POST['passportNum'];
$creationDate = $_POST['creationDate'];
$medicalStatus = $_POST['medicalStatus'];
if($medicalStatus == 'fit'){
    $result = $conn->query("UPDATE passport set $medical = 'unfit' where passportNum = '$passportNum' AND creationDate = '$creationDate'");
}else{
    $result = $conn->query("UPDATE passport set $medical = 'fit' where passportNum = '$passportNum' AND creationDate = '$creationDate'");
}
if($result){
    echo "<script> window.location.href='../index.php?page=listCandidate'</script>";
}else{
    print_r(mysqli_error($conn));
}