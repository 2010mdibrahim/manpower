<?php
include ('database.php');
$processingId = $_POST['processingId'];
$selectedSponsorVisa = $_POST['selectedSponsorVisa'];
$selectedSponsorVisaAmount = intval($_POST['selectedSponsorVisaAmount']);
$info = explode('-',$_POST['sponsorInfo']);
$sponsorVisa = $info[0];
$visaAmount = intval($info[1]);

$result = $conn->query("UPDATE processing set sponsorVisa = '$sponsorVisa' where processingId = $processingId");

if($result){
    $selectedSponsorVisaAmount += 1;
    $visaAmount -= 1;
    $result = $conn->query("UPDATE sponsorvisalist set visaAmount = $selectedSponsorVisaAmount where sponsorVisa = '$selectedSponsorVisa'");
    $result = $conn->query("UPDATE sponsorvisalist set visaAmount = $visaAmount where sponsorVisa = '$sponsorVisa'");
    if($result){
        echo "<script> window.location.href='../index.php?page=visaList'</script>";
    }else{
        echo mysqli_error($conn);
    }
}else{
    echo mysqli_error($conn);
}