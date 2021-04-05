<?php
include ('database.php');
$manpowerOfficeId = $_POST['manpowerOfficeId'];
$jobIdArr = $_POST['jobId'];
$processingCostArr = $_POST['processingCost'];
$admin = $_SESSION['email'];
$date = date('Y-m-d');
foreach($jobIdArr as $index => $jobId){
    $result = $conn->query("INSERT INTO manpowerjobprocessing(manpowerOfficeId, jobId, processingCost, updatedBy, updatedOn) VALUES (".$manpowerOfficeId.",$jobId,$processingCostArr[$index],'$admin', '$date')");
}
if($result){
    echo "<script> window.location.href='../index.php?page=manpowerList'</script>";
}else{
    echo "<script>window.alert('Error')</script>";
    echo "<script> window.location.href='../index.php?page=manpowerList'</script>";
} 