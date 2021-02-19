<?php
include ('database.php');
if(isset($_POST['sponsor'])){
    $sponsorName = $_POST['sponsorName'];
    $visaAmount = $_POST['visaAmount'];
    $jobType = strtolower($_POST['jobType']);
    $gender = strtolower($_POST['gender']);
    $comment = $_POST['comment'];
    $admin = $_SESSION['email'];
    $date = date("Y-m-d");
    $amount = mysqli_fetch_assoc($conn -> query("SELECT count(visaAmount) as visaCount, visaAmount from sponsorvisalist where sponsorName = '$sponsorName' AND visaGenderType = '$gender' AND jobType = '$jobType'"));
    if($amount['visaCount'] == 0){
        $result = $conn->query("INSERT INTO sponsorvisalist (visaAmount, visaGenderType, jobType, sponsorName, comment, updatedBy, updatedOn) VALUES ($visaAmount, '$gender', '$jobType', '$sponsorName', '$comment', '$admin', '$date')");
    }else{
        $newAmount =  $visaAmount + $amount['visaAmount'];
        $result = $conn -> query("UPDATE sponsorvisalist set visaAmount = $newAmount where sponsorName = '$sponsorName' AND visaGenderType = '$gender' AND jobType = '$jobType'");
    }
    if($result){
        echo "<script>window.alert('Success')</script>";
        echo "<script> window.location.href='../index.php?page=allVisaList'</script>";
    }else{
        echo "<script>window.alert('Error')</script>";
        echo "<script> window.location.href='../index.php?page=allVisaList'</script>";
    }
    
}
?>