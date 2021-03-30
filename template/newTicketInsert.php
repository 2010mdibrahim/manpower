<?php
include ('database.php');
$candidateSelect = $_POST['candidateSelect'];
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



// $existingTicket = $conn->query("SELECT count(ticketId) from ticket where passportNum = '$passport'"); // will use if passport will have only one ticket
if($candidateSelect == 'inhouse'){
    $passport_info = explode("_",$_POST['passport_info']);
    $passportNum = $passport_info[0];
    $passportCreationDate = $passport_info[1];
    if($_FILES['ticketCopy']['name'] != ''){
        $target_dir = 'uploads/ticket/';
        $file = $_FILES['ticketCopy']['name'];
        $path = pathinfo($file);
        $file_ext = $path['extension'];
        $file_tmp = $_FILES['ticketCopy']['tmp_name'];
        $db_file = $target_dir.'ticket_'.$passportNum.'.'.$file_ext;
        $file_path_filename_ext = $base_dir.$target_dir.'ticket_'.$passportNum.'.'.$file_ext;
    }
    $result = $conn->query("INSERT INTO ticket(flightDate, transit, ticketPrice, flightNo, flightTo, airline, passportNum, passportCreationDate, ticketCopy, comment, updatedBy, updatedOn, creationDate) VALUES ('$flightDate', $transitHour, $amount, '$flightNo', '$toPlace', '$airplane', '$passportNum', '$passportCreationDate', '$db_file', '$comment', '$admin', '$date', '$createDate')");
}else if($candidateSelect == 'new'){
    $name = $_POST['name'];
    $mobNum = $_POST['mobNum'];
    $passportNum = $_POST['passportNum'];
    $issueDate = $_POST['issueDate'];
    if($_FILES['ticketCopy']['name'] != ''){
        $target_dir = 'uploads/ticket/';
        $file = $_FILES['ticketCopy']['name'];
        $path = pathinfo($file);
        $file_ext = $path['extension'];
        $file_tmp = $_FILES['ticketCopy']['tmp_name'];
        $db_file = $target_dir.'ticket_'.$passportNum.'.'.$file_ext;
        $file_path_filename_ext = $base_dir.$target_dir.'ticket_'.$passportNum.'.'.$file_ext;
    }
    $result = $conn->query("INSERT INTO outsidepassport(passportNum, issuDate, name, mobNum) VALUES ('$passportNum','$issueDate','$name','$mobNum')");
    $outsidePassportId = mysqli_fetch_assoc($conn->query("SELECT max(outsidePassportId) as outsidePassportId from outsidepassport"));
    $result = $conn->query("INSERT INTO outsideticket(flightDate, transit, ticketPrice, flightNo, flightTo, airline, outsidePassportId, ticketCopy, comment, updatedBy, updatedOn, creationDate) VALUES ('$flightDate', $transitHour, $amount, '$flightNo', '$toPlace', '$airplane', ".$outsidePassportId['outsidePassportId'].", '$db_file', '$comment', '$admin', '$date', '$createDate')");
}else{
    $outsidePassportId = $_POST['outsidePassportId'];
    if($_FILES['ticketCopy']['name'] != ''){
        $target_dir = 'uploads/ticket/';
        $file = $_FILES['ticketCopy']['name'];
        $path = pathinfo($file);
        $file_ext = $path['extension'];
        $file_tmp = $_FILES['ticketCopy']['tmp_name'];
        $db_file = $target_dir.'ticket_'.$outsidePassportId.'.'.$file_ext;
        $file_path_filename_ext = $base_dir.$target_dir.'ticket_'.$outsidePassportId.'.'.$file_ext;
    }
    $result = $conn->query("INSERT INTO outsideticket(flightDate, transit, ticketPrice, flightNo, flightTo, airline, outsidePassportId, ticketCopy, comment, updatedBy, updatedOn, creationDate) VALUES ('$flightDate', $transitHour, $amount, '$flightNo', '$toPlace', '$airplane', $outsidePassportId, '$db_file', '$comment', '$admin', '$date', '$createDate')");
}



if($result)
{
    if($_FILES['ticketCopy']['name'] != ''){
        move_uploaded_file($file_tmp,$file_path_filename_ext);
    }
    echo "<script> window.alert('Inserted')</script>";
    // echo "<script> window.location.href='../index.php?page=listTicket'</script>";
}
else{
    echo "<script> window.alert('Error')</script>";
    print_r(mysqli_error($conn));
    // echo "<script> window.location.href='../index.php?page=newTicket'</script>";
}

