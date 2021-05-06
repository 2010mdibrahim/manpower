<?php
include ('database.php');
$flightTime = $_POST['flightTime'];
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
    $result = $conn->query("INSERT INTO ticket(flightDate, flightTime, transit, ticketPrice, flightNo, flightTo, flightFrom, airline, passportNum, passportCreationDate, ticketCopy, comment, updatedBy, updatedOn, creationDate) VALUES ('$flightDate', '$flightTime', $transitHour, $amount, '$flightNo', '$toPlace', '$fromPlace', '$airplane', '$passportNum', '$passportCreationDate', '$db_file', \"$comment\", '$admin', '$date', '$createDate')");
    if($result)
    {
        if($_FILES['ticketCopy']['name'] != ''){
            move_uploaded_file($file_tmp,$file_path_filename_ext);
        }
        echo "<script> window.location.href='../index.php?page=listTicket'</script>";
    }
    else{
        echo "<script> window.alert('Error')</script>";
        print_r(mysqli_error($conn));
    }
}else if($candidateSelect == 'new'){
    $referrer = $_POST['referrer'];
    if($referrer == 'local'){
        $localReferrerName = $_POST['localAgentName'];
        $localReferrerMob = $_POST['localAgentMob'];
        $insert = $conn->query("INSERT INTO localreferrer(localReferrerName, localReferrerMob) VALUES ('$localReferrerName', '$localReferrerMob')");
        $localReferrerDb = mysqli_fetch_assoc($conn->query("SELECT max(localReferrerId) as lastReferrer from localreferrer"));
        $localRefferer = $localReferrerDb['lastReferrer'];
    }else{
        $localRefferer = 0;
    }
    if($referrer == 'existing'){
        $referrerAgent = $_POST['referredAgent'];
    }else{
        $referrerAgent = '';
    }
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
    if($_FILES['outsidePassportCopy']['name'] != ''){
        $target_dir = 'uploads/ticket/';
        $file = $_FILES['outsidePassportCopy']['name'];
        $path = pathinfo($file);
        $file_ext = $path['extension'];
        $outside_file_tmp = $_FILES['outsidePassportCopy']['tmp_name'];
        $outside_db_file = $target_dir.'ticket_outside_passport_'.$passportNum.'.'.$file_ext;
        $file_outside_path_filename_ext = $base_dir.$target_dir.'ticket_outside_passport_'.$passportNum.'.'.$file_ext;
    }
    $result = $conn->query("INSERT INTO outsidepassport(passportNum, outsidePassportCopy, issuDate, name, mobNum, referrerMedia, localReferrerId, agentEmail) VALUES ('$passportNum', '$outside_db_file', '$issueDate','$name','$mobNum', '$referrer', $localRefferer, '$referrerAgent')");
    $outsidePassportId = mysqli_fetch_assoc($conn->query("SELECT max(outsidePassportId) as outsidePassportId from outsidepassport"));
    $result = $conn->query("INSERT INTO outsideticket(flightDate, flightTime, transit, ticketPrice, flightNo, flightTo, flightFrom, airline, outsidePassportId, ticketCopy, comment, updatedBy, updatedOn, creationDate) VALUES ('$flightDate', '$flightTime', $transitHour, $amount, '$flightNo', '$toPlace', '$fromPlace', '$airplane', ".$outsidePassportId['outsidePassportId'].", '$db_file', \"$comment\", '$admin', '$date', '$createDate')");
    if($result)
    {
        if($_FILES['ticketCopy']['name'] != ''){
            move_uploaded_file($file_tmp,$file_path_filename_ext);
        }
        if($_FILES['outsidePassportCopy']['name'] != ''){
            move_uploaded_file($outside_file_tmp,$file_outside_path_filename_ext);
        }
        // echo "<script> window.alert('Inserted')</script>";
        echo "<script> window.location.href='../index.php?page=outsideListTicket'</script>";
    }
    else{
        echo "<script> window.alert('Error')</script>";
        print_r(mysqli_error($conn));
        // echo "<script> window.location.href='../index.php?page=newTicket'</script>";
    }

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
    $result = $conn->query("INSERT INTO outsideticket(flightDate, flightTime, transit, ticketPrice, flightNo, flightTo, flightFrom, airline, outsidePassportId, ticketCopy, comment, updatedBy, updatedOn, creationDate) VALUES ('$flightDate', '$flightTime', $transitHour, $amount, '$flightNo', '$toPlace', '$fromPlace', '$airplane', $outsidePassportId, '$db_file', \"$comment\", '$admin', '$date', '$createDate')");
    if($result)
    {
        if($_FILES['ticketCopy']['name'] != ''){
            move_uploaded_file($file_tmp,$file_path_filename_ext);
        }
        // echo "<script> window.alert('Inserted')</script>";
        echo "<script> window.location.href='../index.php?page=outsideListTicket'</script>";
    }
    else{
        echo "<script> window.alert('Error')</script>";
        print_r(mysqli_error($conn));
    }
}




