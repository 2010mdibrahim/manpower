<?php
include ('database.php');
if(isset($_POST['check1'])){
    print ($_POST['check1']);
}
$passportNum = $_POST['passportNum'];
$sponsorInfo = explode("-",$_POST['sponsorInfo']);
$sponsorName = $sponsorInfo[0];
$jobType = $sponsorInfo[1];
$visaGenderType = $sponsorInfo[2];
$visaAmount = $sponsorInfo[3];
$manpower = $_POST['manpower'];
$jobId = $_POST['jobId'];
$visaNo = $_POST['visaNo'];
$date = date("Y-m-d");
$admin = $_SESSION['email'];
$comment = $_POST['comment'];
$creatDate = date("Y-m-d H:i:s");

$existingVisa = mysqli_fetch_assoc($conn->query("SELECT count(visaNo) as visaCount from visa where visaNo = '$visaNo'"));
if($existingVisa['visaCount'] > 0){
   echo "<script> window.alert('VISA already exists')</script>";
   echo "<script> window.location.href='../index.php?page=visaList'</script>";
}else{
   $qry = "INSERT INTO visa (visaNo, jobId, jobType, manpowerOffice, passportNum, sponsorName, comment, updatedBy, updatedOn, creationDate) 
         VALUES ('$visaNo', '$jobId', '$jobType', '$manpower', '$passportNum', '$sponsorName', '$comment', '$admin', '$date', '$creatDate')";
   $rslt = mysqli_query($conn,$qry);
   if($rslt){
      $visaAmount -= 1; 
      print_r($visaAmount);
      $result = $conn->query("UPDATE sponsorvisalist set visaAmount = ".$visaAmount." where visaGenderType = '$visaGenderType' AND jobType = '$jobType' AND sponsorName = '$sponsorName'");
      echo "<script> window.alert('Saved')</script>";
      echo "<script> window.location.href='../index.php?page=visaList'</script>";
   }else{
      echo 'something went wrong!';
   }
}

