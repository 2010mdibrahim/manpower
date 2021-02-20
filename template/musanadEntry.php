<?php
include ("database.php");
if(isset($_POST['musanadReady'])){
    $passportNum = $_POST['passportNum'];
    $result = $conn-> query("UPDATE passport set musanadEntry = 'submitted' where passportNum = '$passportNum'");
    if($result){
        echo "<script>window.alert('Musanad Submitted')</script>";
        echo "<script> window.location.href='../index.php?page=listCandidate'</script>";
    }else{
        echo "<script>window.alert('Error')</script>";
        echo "<script> window.location.href='../index.php'</script>";
    }
}