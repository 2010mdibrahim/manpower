<?php
include ("database.php");
if(isset($_POST['musanadReady'])){
    $passportNum = $_POST['passportNum'];
    $musanadReady = $_POST['musanadReady'];
    $result = $conn-> query("UPDATE passport set musanadEntry = '$musanadReady' where passportNum = '$passportNum'");
    if($result){
        if($musanadReady == 'no'){
            echo "<script>window.alert('Musanad Withdrawed')</script>";
            echo "<script> window.location.href='../index.php?page=listCandidate'</script>";
        }else{
            echo "<script>window.alert('Musanad Submitted')</script>";
            echo "<script> window.location.href='../index.php?page=listCandidate'</script>";
        }
        
    }else{
        echo "<script>window.alert('Error')</script>";
        echo "<script> window.location.href='../index.php'</script>";
    }
}