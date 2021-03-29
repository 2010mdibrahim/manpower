<?php
include ('database.php');
$delegateOfficeId = $_POST['delegateOfficeId'];
$officeName = $_POST['officeName'];
$result = $conn->query("UPDATE delegateOffice set officeName = '$officeName' where delegateOfficeId = $delegateOfficeId");
if($result){
    echo "<script> window.location.href='../index.php?page=delegateList'</script>";
}else{
    print_r(mysqli_error($conn));
}