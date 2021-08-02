<?php
include ('database.php');
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("VISA", $_SESSION['sections'])){
            if (headers_sent()) {
                die("No Access");
            }else{
                header("Location: ../index.php");
                exit();
            } 
        }        
    }
}
$alter = $_POST['alter'];
$ticketId = $_POST['ticketId'];
if($alter == 'delete'){
    $qry = "DELETE from ticket where ticketId = $ticketId";
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
    $flightTime = $_POST['flightTime'];
    $passport = $_POST['passportNum'];
    $airplane = $_POST['airline'];
    $flightNo = $_POST['flightNo'];
    $flightDate = $_POST['flightDate'];

    if(isset($_POST['fromPlace'])){
        $fromPlace = $conn->real_escape_string($_POST['fromPlace']);
    }else{
        $fromPlace = '';
    }

    $toPlace = $conn->real_escape_string($_POST['toPlace']);
    $amount = $_POST['amount'];
    $comment = $conn->real_escape_string($_POST['comment']);

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
        $db_file = $target_dir.'ticket_'.$passport.'.'.$file_ext;
        $file_path_filename_ext = $base_dir.$target_dir.'ticket_'.$passport.'.'.$file_ext;
        $result = $conn->query("UPDATE ticket SET ticketCopy = '$db_file' WHERE ticketId = $ticketId");
        if($result){
            move_uploaded_file($file_tmp,$file_path_filename_ext);
        }else{
            echo 'something went wrong!';
        }
    }

    $admin = $_SESSION['email'];
    $date = date("Y-m-d");

    $result = $conn->query("UPDATE ticket SET flightDate='$flightDate', flightTime  = '$flightTime', transit = $transitHour, ticketPrice=$amount,flightNo='$flightNo',flightTo='$toPlace',flightFrom='$fromPlace',airline='$airplane',passportNum='$passport',comment='$comment',updatedBy='$admin',updatedOn='$date' WHERE ticketId = $ticketId");
    if($result)
    {
        echo "<script> window.alert('Updated')</script>";
        echo "<script> window.location.href='../index.php?page=listTicket'</script>";
    }
    else{
        echo 'something went wrong!';
    }
}

