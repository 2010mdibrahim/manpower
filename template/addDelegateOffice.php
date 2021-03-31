<?php
include ('database.php');
$delegateId = $_POST['delegateId'];
$delegateOffice = $_POST['delegateOffice'];
foreach($delegateOffice as $officeName){
    $result = $conn->query("INSERT INTO delegateoffice(officeName, delegateId) VALUES ('$officeName', $delegateId)");
}
if ($result) {
    echo "<script> window.location.href='../index.php?page=delegateList'</script>";
} else {
    echo "<script>window.alert('Error')</script>";
}