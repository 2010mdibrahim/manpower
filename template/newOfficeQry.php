<?php
include ('database.php');
if(isset($_POST['alter'])){
    $alter = $_POST['alter'];
}else{
    $alter = '';
}
if($alter == 'delete'){
    $officeId = $_POST['officeId'];
    $result = $conn->query("DELETE from office where officeId = $officeId");
    if($result){
        echo "<script> window.location.href='../index.php?page=officeList'</script>";
    }else{
        print_r(mysqli_error($conn));
    }
}else{
    $officeName = $_POST['officeName'];
    $comment = $_POST['comment'];
    $admin = $_SESSION['email'];
    $date = date('Y-m-d');
    if($alter == 'update'){
        $result = $conn->query("UPDATE office set officeName = '$officeName', comment = '$comment', updatedBy = '$admin', updatedOn = '$date'");
    }else{
        $result = $conn->query("INSERT INTO office(officeName, comment, updatedBy, updatedOn, creationDate) VALUES ('$officeName','$comment','$admin','$date','$date')");
    }
    if($result){
        echo "<script> window.location.href='../index.php?page=officeList'</script>";
    }else{
        print_r(mysqli_error($conn));
    }
}
