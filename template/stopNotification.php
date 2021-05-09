<?php
include ('database.php');
$mode = $_POST['mode'];
$href = $_POST['href'];
$name = array();
if($mode == 'passport'){
    $passportNum = $_POST['passportNum'];
    $creationDate = $_POST['creationDate'];
    $result = $conn->query("UPDATE passport set `notification` = 'no' where passportNum = '$passportNum' AND creationDate = '$creationDate'");
    array_push($name, $passportNum);
}else if($mode == 'visa'){
    $processingId = $_POST['processingId'];
    $result = $conn->query("UPDATE processing set `notification` = 'no' where processingId = $processingId");
    $passport = mysqli_fetch_assoc($conn->query("SELECT passportNum from processing where processingId = $processingId"));
    array_push($name, $passport['passportNum']);
}else if($mode == 'ticket'){
    $ticketId = $_POST['ticketId'];
    $result = $conn->query("UPDATE ticket set `notification` = 'no' where ticketId = $ticketId");
    $passport = mysqli_fetch_assoc($conn->query("SELECT passportNum from ticket where ticketId = $ticketId"));
    array_push($name, $passport['passportNum']);
}
echo json_encode($name);