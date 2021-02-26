<?php
include ('database.php');
if(isset($_POST['check1'])){
    print ($_POST['check1']);
}
$passportNum = $_POST['passportNum'];
$sponsorInfo = $_POST['sponsorInfo'];
$sponsorVisa = $sponsorInfo[0];
$visaAmount = intval($sponsorInfo[1]);


$date = date("Y-m-d");
$admin = $_SESSION['email'];
// $comment = $_POST['comment'];
$creatDate = date("Y-m-d H:i:s");

$result = $conn->query("INSERT into processing (passportNum, sponsorVisa) values ('$passportNum', '$sponsorVisa')");
if($result){
   $visaAmount -= 1;
   $deduct_visa = "UPDATE sponosrvisalist set visaAmount = $visaAmount where sponsorVisa = '$sponsorVisa'";
   echo "<script> window.alert('Saved')</script>";
   
}else{
   echo "<script> window.alert('Failed')</script>";
}

// $existingVisa = mysqli_fetch_assoc($conn->query("SELECT count(visaNo) as visaCount from visa where visaNo = '$visaNo'"));
// if($existingVisa['visaCount'] > 0){
//    echo "<script> window.alert('VISA already exists')</script>";
//    echo "<script> window.location.href='../index.php?page=visaList'</script>";
// }else{
//    $qry = "INSERT INTO visa (visaNo, jobId, jobType, manpowerOffice, passportNum, sponsorName, comment, updatedBy, updatedOn, creationDate) 
//          VALUES ('$visaNo', '$jobId', '$jobType', '$manpower', '$passportNum', '$sponsorName', '$comment', '$admin', '$date', '$creatDate')";
//    $rslt = mysqli_query($conn,$qry);
//    if($rslt){
//       $visaAmount -= 1; 
//       print_r($visaAmount);
//       $result = $conn->query("UPDATE sponsorvisalist set visaAmount = ".$visaAmount." where visaGenderType = '$visaGenderType' AND jobType = '$jobType' AND sponsorName = '$sponsorName'");
//       echo "<script> window.alert('Saved')</script>";
//       echo "<script> window.location.href='../index.php?page=visaList'</script>";
//    }else{
//       echo 'something went wrong!';
//    }
// }

