<?php
include ('database.php');
$candidateList = $_POST['candidateList'];
$delegatePayDate = $_POST['delegatePayDate'];
foreach($candidateList as $candidate){
    $candidate_split = explode('_',$candidate);
    $passportNum = $candidate_split[0];
    $creationDate = $candidate_split[1];
    $result = $conn->query("UPDATE passport set delegateComissionPaid = 'paid', delegateComissionPayDate = '$delegatePayDate' where passportNum = '$passportNum' AND creationDate = '$creationDate'");
}
if($result){
    echo "<script> window.location.href='../index.php?page=delegateList'</script>";
}else{
    print_r(mysqli_error($conn));
}