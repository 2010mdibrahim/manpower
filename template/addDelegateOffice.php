<?php
include ('database.php');
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Delegate", $_SESSION['sections'])){
            if (headers_sent()) {
                die("No Access");
            }else{
                header("Location: ../index.php");
                exit();
            } 
        }        
    }
}
$delegateId = $_POST['delegateId'];
$licenseNumber = $_POST['licenseNumber'];
$delegateOffice = $_POST['delegateOffice'];
foreach($delegateOffice as $index => $officeName){
    $result = $conn->query("INSERT INTO delegateoffice(officeName, officeLicenseNumber, delegateId) VALUES ('$officeName', '$licenseNumber[$index]', $delegateId)");
}
if ($result) {
    echo "<script> window.location.href='../index.php?page=delegateList'</script>";
} else {
    echo "<script>window.alert('Error')</script>";
}