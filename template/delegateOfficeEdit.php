<?php
include ('database.php');
$delegateOfficeId = $_POST['delegateOfficeId'];
$licenseNum = $_POST['licenseNum'];
$officeName = $_POST['officeName'];
if(isset($_POST['delete'])){
    $result = $conn->query("DELETE from delegateOffice where delegateOfficeId = $delegateOfficeId");
}else{
    $result = $conn->query("UPDATE delegateOffice set officeName = '$officeName', officeLicenseNumber = '$licenseNum' where delegateOfficeId = $delegateOfficeId");
}
if($result){
    echo "<script> window.location.href='../index.php?page=delegateList'</script>";
}else{
    print_r(mysqli_error($conn));
}