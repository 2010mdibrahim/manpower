<?php
include ("database.php");
if(isset($_POST['sponsorVisaEdit'])){
    $sponsorName = $_POST['sponsorName'];
    $jobType = $_POST['jobType'];
    $gender = $_POST['gender'];

    $comment = $_POST['comment'];
    $addAmount = $_POST['addAmount'];
    $existAmount = $_POST['visaAmount'];
    $newAmount = $addAmount + $existAmount;

    $result = $conn->query("UPDATE sponsorvisalist set visaAmount = $newAmount where visaGenderType = '$gender' AND jobType = '$jobType' AND sponsorName = '$sponsorName'");
    
    if($result){
      echo "<script> window.alert('Added')</script>";
      echo "<script> window.location.href='../index.php?page=allVisaList'</script>";
    }else{
        echo "<script> window.alert('Failed')</script>";
        echo "<script> window.location.href='../index.php?page=allVisaList'</script>";
    }
    
}