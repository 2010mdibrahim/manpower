<?php
include ('database.php');
$passport = $_POST['passport'];
$airplane = $_POST['airline'];
$flightNo = $_POST['flightNo'];
$flightDate = $_POST['flightDate'];
$flightTime = $_POST['flightTime'];
$fromPlace = $_POST['fromPlace'];
$toPlace = $_POST['toPlace'];
$amount = $_POST['amount'];
$departure = $_POST['departure'];
$terminal = $_POST['terminal'];
$agent = $_POST['agent'];

$qry = "INSERT INTO ticket(`passportNum`, `airplane`, `agent`, `flightNo`, `flightDate`, `flightTime`, `fromPlace`, `toPlace`, `amount`, `departure`, `terminal`) 
        VALUES ('$passport','$airplane',$agent,'$flightNo','$flightDate','$flightTime','$fromPlace','$toPlace',$amount,'$departure','$terminal')";
$result = mysqli_query($conn,$qry);
if($result)
{
    echo "<script> window.alert('Inserted')</script>";
    echo "<script> window.location.href='../index.php?page=newTicket'</script>";
}
else{
    echo 'something went wrong!';
}

