<?php
include ('database.php');
if(!empty($_POST['alter'])){
    $alter = $_POST['alter'];
}else{
    $alter = '';
}
$visaId = $_POST['visaId'];
$visaFee = $_POST['visaFee'];
$payDate = $_POST['payDate'];
$admin = $_SESSION['email'];
$date = date("Y-m-d");

$qry = "update visainfo set visaFee = $visaFee, visaFeeStage = 'Paid', visaFeeDate = '$payDate', updatedBy = '$admin', updatedOn = '$date' where visaId = $visaId";
$result = mysqli_query($conn,$qry);
if($result)
{
    echo "<script> window.alert('Updated')</script>";
    echo "<script> window.location.href='../index.php?page=completeCandidate'</script>";
}
else{
    echo "<script> window.alert('Error')</script>";
    echo "<script> window.location.href='../index.php?page=completeCandidate'</script>";
}


