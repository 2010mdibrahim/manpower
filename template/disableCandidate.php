<?php
include ('database.php');
$passportNum = $_POST['passportNum'];
$creationDate = $_POST['creationDate'];
$href = $_POST['href'];
if(isset($_POST['disable'])){
    $reason = $_POST['reason'];
    $result = $conn->query("UPDATE passport set status = 2, disableReason = \"$reason\" where passportNum = '$passportNum' AND creationDate = '$creationDate'");
}else if(isset($_POST['enable'])){
    $result = $conn->query("UPDATE passport set status = 0, disableReason = '' where passportNum = '$passportNum' AND creationDate = '$creationDate'");
}
echo "<script> window.location.href='../index.php?page=$href'</script>";