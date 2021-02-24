<?php
include ("database.php");
if(isset($_POST['sponsorVisaEdit'])){
  $alter = $_POST['alter'];
  if($alter == 'delete'){
    $sponsorVisa = explode('-',$_POST['sponsorVisa']);
    $sponsorName = $sponsorVisa[2];
    $jobType = $sponsorVisa[1];
    $gender = $sponsorVisa[0];

    $result = $conn->query("DELETE from sponsorvisalist where visaGenderType = '$gender' AND jobType = '$jobType' AND sponsorName = '$sponsorName'");

    if($result){
      echo "<script> window.alert('Deleted')</script>";
      echo "<script> window.location.href='../index.php?page=allVisaList'</script>";
    }else{
        echo "<script> window.alert('Failed')</script>";
        echo "<script> window.location.href='../index.php?page=allVisaList'</script>";
    }
  }else{
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
}