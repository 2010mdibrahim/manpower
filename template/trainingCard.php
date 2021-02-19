<?php
include ('database.php');
if(isset($_POST['trainingCard'])){
    $passportNum = $_POST['passportNum'];
    $result = $conn -> query("UPDATE passport set trainingCard = 'yes' where passportNum = '$passportNum'");
    if($result){
        echo "<script>window.alert('Card Received')</script>";
        echo "<script> window.location.href='../index.php?page=listCandidate'</script>";
    }else{
        echo "<script>window.alert('Eroor')</script>";
        echo "<script> window.location.href='../index.php?page=listCandidate'</script>";
    }
}