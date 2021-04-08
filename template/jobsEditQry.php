<?php
include ('database.php');
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Jobs", $_SESSION['sections'])){
            header("Location: ../index.php");
            exit();
        }        
    }
}
$jobType = $_POST['jobType'];
$creditType = $_POST['creditType'];
$jobId = $_POST['jobId'];
$result = $conn->query("UPDATE jobs set jobType = '$jobType', creditType = '$creditType' where jobId = $jobId");
if($result){
    echo "<script> window.location.href='../index.php?page=jobs'</script>";
}