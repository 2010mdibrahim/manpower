<?php
include ('database.php');
$alter = $_POST['alter'];
$passportNum = $_POST['passportNum'];
if($alter == 'delete'){
    $result = $conn -> query("DELETE FROM passport WHERE passportNum = '$passportNum'");
    if($result){
        echo "<script>window.alert('Deleted')</script>";
        echo "<script> window.location.href='../index.php?page=listCandidate'</script>";
    }else{
        echo "<script>window.alert('Error')</script>";
        echo "<script> window.location.href='../listCandidate.php'</script>";
    }
}else{
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $mobNum = $_POST['mobNum'];
    $passportNum = $_POST['passportNum'];
    $issuD = $_POST['issuD'];
    $country = $_POST['country'];
    $expD = $_POST['expD'];
    $departureDate = $_POST['departureDate'];
    $arrivalDate = $_POST['arrivalDate'];
    $policeVerification = $_POST['policeVerification'];
    $photo = $_POST['photo'];
    $agentEmail = $_POST['agentEmail'];
    $comment = $_POST['comment'];
    $admin = $_SESSION['email'];
    $date = date("Y-m-d");
    $qry = "UPDATE passport SET fName='$fName',lName='$lName',mobNum='$mobNum',dob = '$dob',gender='$gender',issueDate='$issuD',expiryDate='$expD',departureDate='$departureDate',arrivalDate='$arrivalDate',policeClearance='$policeVerification',country='$country',passportPhoto='$photo',agentEmail='$agentEmail',comment='$comment',updatedBy='$admin',updatedOn='$date' WHERE passportNum = '$passportNum'";
    $result = mysqli_query($conn,$qry);
    if($result){
        echo "<script>window.alert('Updated')</script>";
        echo "<script> window.location.href='../index.php?page=listCandidate'</script>";
    }else{
        echo "<script>window.alert('Error')</script>";
        echo "<script> window.location.href='../index.php'</script>";
    }

}



