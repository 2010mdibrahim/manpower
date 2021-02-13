<?php
include ('database.php');
$alter = $_POST['alter'];
$visaId = $_POST['visaId'];
$emigrationStage = $_POST['emigrationStage'];
$emigrationDate = $_POST['emigrationDate'];
$admin = $_SESSION['email'];
$date = date("Y-m-d");
if($alter == 'insert') {
    $qry = "INSERT INTO emigration(visaId, approval, date, status, updatedBy, updatedOn) VALUES ($visaId,'$emigrationStage','$emigrationDate',1,'$admin','$date')";
    $result = mysqli_query($conn, $qry);
    if ($result) {
        echo "<script> window.alert('Created')</script>";
        echo "<script> window.location.href='../index.php?page=completeCandidate'</script>";
    } else {
        echo 'something went wrong!';
    }
}else{
    $qry = "update emigration set approval = '$emigrationStage', date = '$emigrationDate', updatedBy = '$admin', updatedOn = '$date' where visaId = $visaId";
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
