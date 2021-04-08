<?php
include ('database.php');
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Ticket", $_SESSION['sections'])){
            header("Location: ../index.php");
            exit();
        }        
    }
}
$alter = $_POST['alter'];
$ticketId = $_POST['ticketId'];
if($alter == 'delete'){
    $qry = "DELETE from outsideticket where ticketId = $ticketId";
    $result = mysqli_query($conn,$qry);
    if($result)
    {
        echo "<script> window.alert('Deleted')</script>";
        echo "<script> window.location.href='../index.php?page=outsideListTicket'</script>";
    }
    else{
        echo 'something went wrong!';
    }
}else{
    $flightTime = $_POST['flightTime'];
    $outsidePassportId = $_POST['outsidePassportId'];
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

    if($_FILES['ticketCopy']['name'] != ''){
        $base_dir = 'C:/xampp/htdocs/mahfuza/';
        $target_dir = 'uploads/ticket/';
        $file = $_FILES['ticketCopy']['name'];
        $path = pathinfo($file);
        $file_ext = $path['extension'];
        $file_tmp = $_FILES['ticketCopy']['tmp_name'];
        $db_file = $target_dir.'ticket_'.$outsidePassportId.'.'.$file_ext;
        $file_path_filename_ext = $base_dir.$target_dir.'ticket_'.$outsidePassportId.'.'.$file_ext;
        $result = $conn->query("UPDATE outsideticket SET ticketCopy = '$db_file' WHERE ticketId = $ticketId");
        if($result){
            move_uploaded_file($file_tmp,$file_path_filename_ext);
        }else{
            echo 'something went wrong!';
        }
    }

    $admin = $_SESSION['email'];
    $date = date("Y-m-d");

    $result = $conn->query("UPDATE outsideticket SET flightDate='$flightDate',flightTime = '$flightTime', transit = $transitHour, ticketPrice=$amount,flightNo='$flightNo',flightTo='$toPlace',flightFrom='$fromPlace',airline='$airplane',outsidePassportId=$outsidePassportId,comment='$comment',updatedBy='$admin',updatedOn='$date' WHERE ticketId = $ticketId");
    if($result)
    {
        echo "<script> window.alert('Updated')</script>";
        echo "<script> window.location.href='../index.php?page=outsideListTicket'</script>";
    }
    else{
        echo 'something went wrong!';
    }
}

