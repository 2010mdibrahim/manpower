<?php
include ('database.php');
if(!empty($_POST['alter'])){
    $alter = $_POST['alter'];
}else{
    $alter = '';
}
$visaId = $_POST['visaId'];
$stampingStage = $_POST['stampingStage'];
$stampingDate = $_POST['stampingDate'];
$admin = $_SESSION['email'];
$date = date("Y-m-d");
if($alter == 'update'){
    $qry = "update stamping set stampStage = '$stampingStage', date = '$stampingDate', updatedBy = '$admin', updatedOn = '$date' where visaId = $visaId";
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
}else{
    $qry = "INSERT INTO stamping(visaId, stampStage, date, status, updatedBy, updatedOn) VALUES ($visaId,'$stampingStage','$stampingDate',1,'$admin','$date')";
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
}

