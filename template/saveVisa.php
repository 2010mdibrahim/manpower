<?php
include ('database.php');
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
   $passportNum = $_POST['passportNum'];
   $sponsorInfo = explode('-',$_POST['sponsorInfo']);
   $sponsorVisa = $sponsorInfo[0];
   $visaAmount = intval($sponsorInfo[1]);
   $comment = $_POST['comment'];

   $date = date("Y-m-d");
   $admin = $_SESSION['email'];
   // $comment = $_POST['comment'];
   $curdate = date("Y/m/d H:i:s");
   $creatDate = date("Y-m-d H:i:s", strtotime('+3 hours', strtotime($curdate)));
   // print_r("INSERT into processing (passportNum, sponsorVisa, updatedBy, updatedOn, creationDate, comment) values ('$passportNum', '$sponsorVisa', '$admin', '$date', '$creatDate', '$comment')");
   $result = $conn->query("INSERT into processing (passportNum, sponsorVisa, updatedBy, updatedOn, creationDate, comment, okala, mufa, medicalUpdate, visaStamping, finger, trainingCard, manpowerCard) values ('$passportNum', '$sponsorVisa', '$admin', '$date', '$creatDate', '$comment', 'no', 'no', 'no', 'no', 'no', 'no', 'no')");
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
