<?php
include ('database.php');
$alter = $_POST['alter'];
$ticketId = $_POST['ticketId'];
if($alter == 'delete'){
    $qry = "delete from ticket where ticketId = $ticketId";
    $result = mysqli_query($conn,$qry);
    if($result)
    {
        echo "<script> window.alert('Deleted')</script>";
        echo "<script> window.location.href='../index.php?page=listTicket'</script>";
    }
    else{
        echo 'something went wrong!';
    }
}else{
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
    $result = $conn->query("UPDATE ticket SET flightDate='$flightDate',ticketPrice='$amount',flightNo='$flightNo',flightFrom='$fromPlace',flightTo='$toPlace',airline='$airplane',passportNum='$passport',comment='$comment',updatedBy='$admin',updatedOn='$date' WHERE ticketId = $ticketId");
    if($result)
    {
        echo "<script> window.alert('Updated')</script>";
        echo "<script> window.location.href='../index.php?page=listTicket'</script>";
    }
    else{
        echo 'something went wrong!';
    }
}

