<?php
include ('database.php');
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("VISA", $_SESSION['sections'])){
            if (headers_sent()) {
                die("No Access");
            }else{
                header("Location: ../index.php");
                exit();
            } 
        }        
    }
}
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