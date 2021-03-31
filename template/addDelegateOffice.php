<?php
include ('database.php');
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