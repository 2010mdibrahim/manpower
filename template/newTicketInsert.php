<?php
include ('database.php');
$passport_info = explode("_",$_POST['passport_info']);
$passport = $passport_info[0];
$passportCreationDate = $passport_info[1];
print_r($passport."-".$passportCreationDate);   
$airplane = $_POST['airline'];
$flightNo = $_POST['flightNo'];
$flightDate = $_POST['flightDate'];
if(isset($_POST['fromPlace'])){
    $fromPlace = $_POST['fromPlace'];
}else{
    $fromPlace = '';
}

$toPlace = $_POST['toPlace'];
$amount = $_POST['amount'];
$comment = $_POST['comment'];

if(!empty($_POST['transitHour'])){
    $transitHour = $_POST['transitHour'];
}else{
    $transitHour = 0.0;
}
print_r($transitHour);

$admin = $_SESSION['email'];
$date = date("Y-m-d");
$createDate = date("Y-m-d H:i:s");

if($_FILES['ticketCopy']['name'] != ''){
    $target_dir = 'uploads/ticket/';
    $file = $_FILES['ticketCopy']['name'];
    $path = pathinfo($file);
    $file_ext = $path['extension'];
    $file_tmp = $_FILES['ticketCopy']['tmp_name'];
    $db_file = $target_dir.'ticket_'.$passport.'.'.$file_ext;
    $file_path_filename_ext = $base_dir.$target_dir.'ticket_'.$passport.'.'.$file_ext;
}

// $existingTicket = $conn->query("SELECT count(ticketId) from ticket where passportNum = '$passport'"); // will use if passport will have only one ticket

$result = $conn->query("INSERT INTO ticket(flightDate, transit, ticketPrice, flightNo, flightFrom, flightTo, airline, passportNum, passportCreationDate, ticketCopy, comment, updatedBy, updatedOn, creationDate) VALUES ('$flightDate', $transitHour, $amount, '$flightNo', '$fromPlace', '$toPlace', '$airplane', '$passport', '$passportCreationDate', '$db_file', '$comment', '$admin', '$date', '$createDate')");

if($result)
{
    if($_FILES['ticketCopy']['name'] != ''){
        move_uploaded_file($file_tmp,$file_path_filename_ext);
    }
    echo "<script> window.alert('Inserted')</script>";
    echo "<script> window.location.href='../index.php?page=listTicket'</script>";
}
else{
    print_r(mysqli_error($conn));
    echo "<script> window.alert('Error')</script>";
    echo "<script> window.location.href='../index.php?page=newTicket'</script>";
}

