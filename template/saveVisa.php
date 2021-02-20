<?php
include ('database.php');
if(isset($_POST['check1'])){
    print ($_POST['check1']);
}
$passportNum = $_POST['passportNum'];
$sponsorInfo = explode("-",$_POST['sponsorInfo']);
$sponsorName = $sponsorInfo[0];
$jobType = $sponsorInfo[1];
$manpower = $_POST['manpower'];
$jobId = $_POST['jobId'];
$visaNo = $_POST['visaNo'];
$date = date("Y-m-d");
$admin = $_SESSION['email'];
$comment = $_POST['comment'];
$creatDate = date("Y-m-d H:i:s");

$qry = "INSERT INTO visa (visaNo, jobId, jobType, manpowerOffice, passportNum, sponsorName, comment, updatedBy, updatedOn, creationDate) 
        VALUES ('$visaNo', '$jobId', '$jobType', '$manpower', '$passportNum', '$sponsorName', '$comment', '$admin', '$date', '$creatDate')";
$rslt = mysqli_query($conn,$qry);
if($rslt)
{
   echo "<script> window.alert('Saved')</script>";
   echo "<script> window.location.href='../index.php?page=visaList'</script>";
}
else{
   echo 'something went wrong!';
}