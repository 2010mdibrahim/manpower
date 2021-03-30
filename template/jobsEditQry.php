<?php
include ('database.php');
$jobType = $_POST['jobType'];
$creditType = $_POST['creditType'];
$jobId = $_POST['jobId'];
$result = $conn->query("UPDATE jobs set jobType = '$jobType', creditType = '$creditType' where jobId = $jobId");
if($result){
    echo "<script> window.location.href='../index.php?page=jobs'</script>";
}