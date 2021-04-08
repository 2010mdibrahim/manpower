<?php
include ('database.php');
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Pay Mode", $_SESSION['sections'])){
            if (headers_sent()) {
                die("No Access");
            }else{
                header("Location: ../index.php");
                exit();
            } 
        }        
    }
}
if(!empty($_POST['alter'])){
    $alter = $_POST['alter'];
}else{
    $alter = '';
}
$paymode = $_POST['paymode'];
$date = date("Y-m-d");
if($alter == 'delete'){
    $result = $conn->query("DELETE from paymentmethod where paymentMode = '$paymode'");
    if($result)
    {
        echo "<script> window.location.href='../index.php?page=payMode'</script>";
    }
    else{
        echo "<script> window.location.href='../index.php?page=payMode'</script>";
    }
}else{
    $result = $conn->query("INSERT into paymentmethod (paymentMode, creationDate) values ('$paymode', '$date')");
    if($result)
    {
        echo "<script> window.location.href='../index.php?page=payMode'</script>";
    }
    else{
        echo "<script> window.location.href='../index.php?page=payMode'</script>";
    }
}


