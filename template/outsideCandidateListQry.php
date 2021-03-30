<?php
include ('database.php');
if(isset($_POST['alter'])){
    $alter = $_POST['alter'];
}else{
    $alter = '';
}
$outsidePassportId = $_POST['outsidePassportId'];
if($alter == 'delete'){
    $result = $conn->query("DELETE from outsidepassport where outsidePassportId = $outsidePassportId");
}else{
    $name = $_POST['name'];
    $mobNum = $_POST['mobNum'];
    $passportNum = $_POST['passportNum'];
    $issueDate = $_POST['issueDate'];
    $result = $conn->query("UPDATE outsidepassport set name = '$name', mobNum = '$mobNum', passportNum = '$passportNum', issuDate = '$issueDate' where outsidePassportId = $outsidePassportId");
}
if($result){
    echo "<script> window.location.href='../index.php?page=outsideCandidateList'</script>";
}else{
    print_r('error');
}