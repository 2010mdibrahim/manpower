<?php
include ('database.php');
if(isset($_POST['sponsor'])){
    $sponsorNid = $_POST['sponsorNid'];
    $visaNo = $_POST['visaNo'];
    $visaAmount = $_POST['visaAmount'];
    $jobType = strtolower($_POST['jobType']);
    $gender = strtolower($_POST['gender']);
    $comment = $_POST['comment'];
    $admin = $_SESSION['email'];
    $date = date("Y-m-d");

    $validate = mysqli_fetch_assoc($conn->query("SELECT count(sponsorNID) as sponsorCount from sponsorvisalist where sponsorVisa = '$visaNo '"));
    if($validate['sponsorCount'] == 0){
        $result = $conn->query("INSERT INTO sponsorvisalist (`sponsorVisa`, `visaAmount`, `visaGenderType`, `jobType`, `sponsorNID`, `comment`, `updatedBy`, `updatedOn`) VALUES ('$visaNo', $visaAmount, '$gender', '$jobType', '$sponsorNid', '$comment', '$admin', '$date')");
        if($result){
            echo "<script>window.alert('Entered')</script>";
            echo "<script> window.location.href='../index.php?page=allVisaList'</script>";
        }else{
            echo "<script>window.alert('Not Entered')</script>";
            echo "<script> window.location.href='../index.php?page=visaSponsor'</script>";
        }
        
    }else{
        echo "<script>window.alert('Exists')</script>";
        echo "<script> window.location.href='../index.php?page=allVisaList'</script>";
    }
    
}
?>