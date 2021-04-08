<?php
include ('database.php');
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Ticket", $_SESSION['sections'])){
            if (headers_sent()) {
                die("No Access");
            }else{
                header("Location: ../index.php");
                exit();
            } 
        }        
    }
}
if(isset($_POST['alter'])){
    $alter = $_POST['alter'];
}else{
    $alter = '';
}
$outsidePassportId = $_POST['outsidePassportId'];
if($alter == 'delete'){
    $result = $conn->query("DELETE from outsidepassport where outsidePassportId = $outsidePassportId");
}else{
    $name = $_POST['name'];
    $mobNum = $_POST['mobNum'];
    $passportNum = $_POST['passportNum'];
    $issueDate = $_POST['issueDate'];
    if($_FILES['outsidePassportCopy']['name'] != ''){
        $target_dir = 'uploads/ticket/';
        $file = $_FILES['outsidePassportCopy']['name'];
        $path = pathinfo($file);
        $file_ext = $path['extension'];
        $outside_file_tmp = $_FILES['outsidePassportCopy']['tmp_name'];
        $outside_db_file = $target_dir.'ticket_outside_passport_'.$passportNum.'.'.$file_ext;
        $file_outside_path_filename_ext = $base_dir.$target_dir.'ticket_outside_passport_'.$passportNum.'.'.$file_ext;
    }
    $result = $conn->query("UPDATE outsidepassport set outsidePassportCopy = '$outside_db_file',name = '$name', mobNum = '$mobNum', passportNum = '$passportNum', issuDate = '$issueDate' where outsidePassportId = $outsidePassportId");
    if($result)
    {
        if($_FILES['outsidePassportCopy']['name'] != ''){
            move_uploaded_file($outside_file_tmp,$file_outside_path_filename_ext);
        }
    }
}
if($result){
    echo "<script> window.location.href='../index.php?page=outsideCandidateList'</script>";
}else{
    print_r('error');
}