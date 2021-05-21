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
$account_maheer_id = $_POST['account_maheer_id'];
if(isset($_POST['alter'])){
    $alter = $_POST['alter'];
}else{
    $alter = '';
}
if($alter == 'delete'){
    $result = $conn->query("DELETE from account_maheer where id = $account_maheer_id");
}else{
    $edit_debit_amount = $_POST['edit_debit_amount'];
    $edit_credit_amount = $_POST['edit_credit_amount'];
    $edit_dollar_rate = $_POST['edit_dollar_rate'];
    $date = $_POST['date'];
    if (($_FILES['officeReceipt']['name'] != "")){
        // Where the file is going to be stored
        $target_dir = "uploads/officeReceipt/";    
        $file = $_FILES['officeReceipt']['name'];
        $path = pathinfo($file);
        $ext = $path['extension'];
        $temp_name = $_FILES['officeReceipt']['tmp_name'];
        $path_filename_ext = $base_dir.$target_dir."officeReceipt"."_".$account_maheer_id.".".$ext;
        $receipt = $target_dir."officeReceipt"."_".$account_maheer_id.".".$ext;
        $result = $conn->query("UPDATE account_maheer set debit_receipt = '$receipt' where id = $account_maheer_id");
        move_uploaded_file($temp_name,$path_filename_ext);
    }
    $result = $conn->query("UPDATE account_maheer set debit = $edit_debit_amount,credit = $edit_credit_amount, dollar_rate_debit = $edit_dollar_rate, date = '$date' where id = $account_maheer_id");
}
if($result){
    echo "<script> window.location.href='../index.php?page=delegateAllOfficeExpense'</script>";
}else{
    print_r(mysqli_error($conn));
}