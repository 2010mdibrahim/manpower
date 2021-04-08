<?php
include ('database.php');
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Manpower", $_SESSION['sections'])){
            header("Location: ../index.php");
            exit();
        }        
    }
}
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