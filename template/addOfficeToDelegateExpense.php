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
$officeId = $_POST['officeId'];
$amount = $_POST['amount'];
$date = $_POST['date'];
$rate = 1;
$max_id_qry = mysqli_fetch_assoc($conn->query("SELECT max(id) as max_id from account_maheer"));
$max_id = $max_id_qry['max_id'] + 1;
if (($_FILES['officeReceipt']['name'] != "")){
    // Where the file is going to be stored
    $target_dir = "uploads/officeReceipt/";    
    $file = $_FILES['officeReceipt']['name'];
    $path = pathinfo($file);
    $ext = $path['extension'];
    $temp_name = $_FILES['officeReceipt']['tmp_name'];
    $path_filename_ext = $base_dir.$target_dir."officeReceipt"."_".$max_id.".".$ext;
    $receipt = $target_dir."officeReceipt"."_".$max_id.".".$ext;
}
$result = $conn->query("INSERT INTO account_maheer(particular, date, debit, credit, dollar_rate_credit, debit_receipt) VALUES ('$officeId','$date', 0, $amount, $rate, '$receipt')");

if($result){
    move_uploaded_file($temp_name,$path_filename_ext);
    echo "<script> window.location.href='../index.php?page=delegateAllOfficeExpense'</script>";
}else{
    print_r(mysqli_error($conn));
}