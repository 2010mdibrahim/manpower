<?php
include ('database.php');
$candidateList = $_POST['candidateList'];
foreach($candidateList as $candidate){
    $candidate_split = explode('_',$candidate);
    $passportNum = $candidate_split[0];
    $creationDate = $candidate_split[1];
    $result = $conn->query("UPDATE passport set delegateComissionPaid = 'paid' where passportNum = '$passportNum' AND creationDate = '$creationDate'");
}
if($result){
    print_r('done');
    echo "<script> window.location.href='../index.php?page=delegateList'</script>";
}else{
    print_r(mysqli_error($conn));
}