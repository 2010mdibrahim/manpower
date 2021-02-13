<?php
include ('database.php');
if(isset($_POST['check1'])){
    print ($_POST['check1']);
}
//$name = $_POST['name'];
//$date = $_POST['date'];
//$type = $_POST['type'];
//$pos = $_POST['pos'];
//$bSal = $_POST['bSalary'];
//$tSal = $_POST['tSalary'];
//$admin = $_SESSION['email'];
//$sponsorId = $_POST['sponsorId'];
//$date = date("Y-m-d");
//$agent = $_POST['agent'];
//
//$qry = "INSERT INTO visainfo (name, date, type, position, bSalary, tSalary, visaIssuAgent, visaSponsorId, status, updatedBy, updatedOn)
//            VALUES ('$name','$date','$type','$pos',$bSal,$tSal,$agent,$sponsorId,1,'$admin','$date')";
//$rslt = mysqli_query($conn,$qry);
//if($rslt)
//{
//    echo "<script> window.alert('Saved')</script>";
//    echo "<script> window.location.href='../index.php?page=visaList'</script>";
//}
//else{
//    echo 'something went wrong!';
//}