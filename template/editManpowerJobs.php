<?php
include ('database.php');
$manpowerJobProcessingId = $_POST['manpowerJobProcessingId'];
$processingCost = $_POST['processingCost'];
$manpowerOfficeId = $_POST['manpowerOfficeId'];
$jobId = $_POST['jobId'];
$admin = $_SESSION['email'];
$date = date('Y-m-d');
$result = $conn->query("UPDATE manpowerjobprocessing SET jobId=$jobId,processingCost=$processingCost,updatedBy='$admin',updatedOn='$date' WHERE manpowerJobProcessingId= $manpowerJobProcessingId");
if($result){
    echo "<script> window.location.href='../index.php?page=manpowerJobList&mi=".base64_encode($manpowerOfficeId)."'</script>";
}else{
    echo "<script>window.alert('Error')</script>";
    echo "<script> window.location.href='../index.php?page=manpowerJobList&mi=".base64_encode($manpowerOfficeId)."'</script>";
}  