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
if(isset($_POST['alter'])){
   $alter = ($_POST['alter']);
}else{
   $alter = '';
}
if($alter == 'delete'){
   $processingId = $_POST['processingId'];
   $result = $conn->query("DELETE from processing where processingId = $processingId");
   if($result){
      echo "<script> window.alert('Deleted')</script>";
      echo "<script> window.location.href='../index.php?page=visaList'</script>";
   }else{
      echo "<script> window.alert('Failed')</script>";
      echo "<script> window.location.href='../index.php?page=visaList'</script>";
   }
}else{
   $passport_info = explode("_",$_POST['passport_info']);
   $passportNum = $passport_info[0];
   $passportCreationDate = $passport_info[1];
   $candidate_name = $passport_info[2];
   $sponsorInfo = explode('-',$_POST['sponsorInfo']);
   $sponsorVisa = $sponsorInfo[0];
   $visaAmount = intval($sponsorInfo[1]);
   $comment = $_POST['comment'];

   $date = date("Y-m-d");
   $admin = $_SESSION['email'];
   $curdate = date("Y/m/d H:i:s");
   $result = $conn->query("INSERT into processing (passportNum, passportCreationDate, sponsorVisa, updatedBy, updatedOn, creationDate, comment, okala, mufa, medicalUpdate, visaStamping, finger, trainingCard, manpowerCard, `name`) values ('$passportNum', '$passportCreationDate', '$sponsorVisa', '$admin', '$date', '$curdate', \"$comment\", 'no', 'no', 'no', 'no', 'no', 'no', 'no', '$candidate_name')");
   if($result){
      $visaAmount -= 1;
      $deduct_visa = $conn->query("UPDATE sponsorvisalist set visaAmount = $visaAmount where sponsorVisa = '$sponsorVisa'");
      echo "<script> window.alert('Saved')</script>";
      echo "<script> window.location.href='../index.php?page=visaList'</script>";
   }else{
      echo "<script> window.alert('Failed')</script>";
      echo "<script> window.location.href='../index.php?page=newVisa'</script>";
   }
}
