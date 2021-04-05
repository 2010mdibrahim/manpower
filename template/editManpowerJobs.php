<?php
include ('database.php');
$manpowerJobProcessingId = $_POST['manpowerJobProcessingId'];
$manpowerOfficeId = $_POST['manpowerOfficeId'];
if(isset($_POST['alter'])){
    $result = $conn->query("DELETE from manpowerjobprocessing WHERE manpowerJobProcessingId= $manpowerJobProcessingId");
}else{
    $processingCost = $_POST['processingCost'];
    $jobId = $_POST['jobId'];
    $admin = $_SESSION['email'];
    $date = date('Y-m-d');
    $result = $conn->query("UPDATE manpowerjobprocessing SET jobId=$jobId,processingCost=$processingCost,updatedBy='$admin',updatedOn='$date' WHERE manpowerJobProcessingId= $manpowerJobProcessingId");
}

if($result){
    echo "<script> window.location.href='../index.php?page=manpowerJobList&mi=".base64_encode($manpowerOfficeId)."'</script>";
}else{
    echo "<script>window.alert('Error')</script>";
    echo "<script> window.location.href='../index.php?page=manpowerJobList&mi=".base64_encode($manpowerOfficeId)."'</script>";
}  