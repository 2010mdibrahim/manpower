<?php
include ('database.php');
$alter = $_POST['alter'];
$visaId = $_POST['visaId'];
$medicalStage = $_POST['medicalStage'];
$medicalDate = $_POST['medicalDate'];
$admin = $_SESSION['email'];
$date = date("Y-m-d");
if($alter == 'insert'){
    $qry = "INSERT INTO medical(visaId, mediStage, date, status, updatedBy, updatedOn) VALUES ($visaId,'$medicalStage','$medicalDate',1,'$admin','$date')";
    $result = mysqli_query($conn,$qry);
    if($result)
    {
        echo "<script> window.alert('Updated')</script>";
        echo "<script> window.location.href='../index.php?page=completeCandidate'</script>";
    }
    else{
        echo 'something went wrong!';
    }
}else{
    $qry = "update medical set mediStage = '$medicalStage', date = '$medicalDate', updatedBy = '$admin', updatedOn = '$date' where visaId = $visaId";
    $result = mysqli_query($conn,$qry);
    if($result)
    {
        echo "<script> window.alert('Updated')</script>";
        echo "<script> window.location.href='../index.php?page=completeCandidate'</script>";
    }
    else{
        echo 'something went wrong!';
    }
}

