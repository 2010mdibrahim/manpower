<?php
include ('database.php');
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Delegate", $_SESSION['sections'])){
            if (headers_sent()) {
                die("No Access");
            }else{
                header("Location: ../index.php");
                exit();
            } 
        }        
    }
}
$type = $_POST['type'];
$officeId = $_POST['officeId'];
$amount = $_POST['amount'];
$date = $_POST['date'];
$delegateTotalExpenseId = $_POST['delegateTotalExpenseId'];
$maxId = mysqli_fetch_assoc($conn->query("SELECT max(delegateTotalExpenseOfficeId) as id from delegatetotalexpenseoffice"));
if (($_FILES['officeReceipt']['name'] != "")){
    // Where the file is going to be stored
    $target_dir = "uploads/officeReceipt/";    
    $file = $_FILES['officeReceipt']['name'];
    $path = pathinfo($file);
    $ext = $path['extension'];
    $temp_name = $_FILES['officeReceipt']['tmp_name'];
    $path_filename_ext = $base_dir.$target_dir."officeReceipt"."_".$maxId['id'].".".$ext;
    $receipt = $target_dir."officeReceipt"."_".$maxId['id'].".".$ext;
}
$result = $conn->query("INSERT INTO delegatetotalexpenseoffice(delegateTotalExpenseId, officeId, amount, date, type, receipt) VALUES ($delegateTotalExpenseId,'$officeId',$amount,'$date', '$type', '$receipt')");

if($result){
    move_uploaded_file($temp_name,$path_filename_ext);
    echo "<script> window.location.href='../index.php?page=delegateAllOfficeExpense&dei=".base64_encode($delegateTotalExpenseId)."'</script>";
}else{
    print_r(mysqli_error($conn));
}