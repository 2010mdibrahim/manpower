<?php
include ('database.php');
$processingId = $_POST['processingId'];
$href = $_POST['href']; 
if(isset($_POST['complete'])){
    $result = $conn->query("UPDATE processing set pending = 2 where processingId = $processingId");
}else if(isset($_POST['return'])){
    $result = $conn->query("UPDATE processing set pending = 3 where processingId = $processingId");
}else if(isset($_POST['hold'])){
    $passport = mysqli_fetch_assoc($conn->query("SELECT passportNum, passportCreationDate from processing where processingId = $processingId"));
    $result = $conn->query("UPDATE passport set status = 1 where passportNum = '".$passport['passportNum']."' AND creationDate = '".$passport['passportCreationDate']."'");
    
}else if(isset($_POST['release'])){
    $passport = mysqli_fetch_assoc($conn->query("SELECT passportNum, passportCreationDate from processing where processingId = $processingId"));
    $result = $conn->query("UPDATE passport set status = 0 where passportNum = '".$passport['passportNum']."' AND creationDate = '".$passport['passportCreationDate']."'");
}
echo "<script> window.location.href='../index.php?page=".$href."'</script>";
