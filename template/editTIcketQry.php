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
    $qry = "UPDATE ticket SET passportNum='$passport',airplane='$airplane',agent='$agent',flightNo='$flightNo',flightDate='$flightDate',flightTime='$flightTime'
              ,fromPlace='$fromPlace',toPlace='$toPlace',amount=$amount,departure='$departure',terminal='$terminal' WHERE ticketId=$ticketId";
    $result = mysqli_query($conn,$qry);
    if($result)
    {
        echo "<script> window.alert('Updated')</script>";
        echo "<script> window.location.href='../index.php?page=listTicket'</script>";
    }
    else{
        echo 'something went wrong!';
    }
}

