<?php
include ('database.php');
$passport = $_POST['passportNum'];
$airplane = $_POST['airline'];
$flightNo = $_POST['flightNo'];
$flightDate = $_POST['flightDate'];
$fromPlace = $_POST['fromPlace'];
$toPlace = $_POST['toPlace'];
$amount = $_POST['amount'];
$comment = $_POST['comment'];
$admin = $_SESSION['email'];
$date = date("Y-m-d");

$result = $conn->query("INSERT INTO ticket(flightDate, ticketPrice, flightNo, flightFrom, flightTo, airline, passportNum, comment, updatedBy, updatedOn) 
        VALUES ('$flightDate', '$amount', '$flightNo', '$fromPlace', '$toPlace', '$airplane', '$passport', '$comment', '$admin', '$date')");
if($result)
{
    echo "<script> window.alert('Inserted')</script>";
    echo "<script> window.location.href='../index.php?page=listTicket'</script>";
}
else{
    echo 'something went wrong!';
}

