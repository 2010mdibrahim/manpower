<?php
include ('database.php');
$passport = $_POST['passport'];
$qry = "SELECT COUNT(passportNum) as total FROM ticket WHERE passportNum = '$passport'";
$result = mysqli_query($conn,$qry);
$count = mysqli_fetch_assoc($result);
$admin = $_SESSION['email'];
$date = date("Y-m-d");
if($count['total'] == 1){
    $qry = "select paid from ticket where passportNum = '$passport'";
    $result = mysqli_query($conn,$qry);
    $alreadyPaid = mysqli_fetch_assoc($result);
    $amount = $_POST['adjustAmount#1'];
    $newAmount = $amount + $alreadyPaid['paid'];
    $qry = "update ticket set paid = $newAmount,updatedOn = '$date',updatedBy = '$admin' where passportNum = '$passport'";
    $result = mysqli_query($conn,$qry);
}else{
    for($i=1; $i<=$count['total'];$i++){
        $ticketId = $_POST['ticketId#'.$i];
        $qry = "select paid from ticket where ticketId = $ticketId";
        $result = mysqli_query($conn,$qry);
        $alreadyPaid = mysqli_fetch_assoc($result);
        if(!empty($_POST['adjustAmount#'.$i])){
            $amount = $_POST['adjustAmount#'.$i];
        }else{
            $amount = 0;
        }
        $newAmount = $amount + $alreadyPaid['paid'];
        $qry = "update ticket set paid = $newAmount,updatedOn = '$date',updatedBy = '$admin' where ticketId = $ticketId";
        $result = mysqli_query($conn,$qry);
    }
}

//if($result){
    echo "<script>window.alert('Adjusted')</script>";
    echo "<script> window.location.href='../index.php?page=selectTicketWithPassport&passport=$passport'</script>";
//}

