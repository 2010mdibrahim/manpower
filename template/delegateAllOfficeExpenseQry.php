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
$date = $_POST['date'];
if(isset($_POST['rate'])){
    $rate = $_POST['rate'];
}else{
    $rate = 1; // for taka
}
if(isset($_POST['amount'])){
    $amount = $_POST['amount']; // in dollar
}else{
    $amount = $_POST['amountBDT']; // in taka
}
if(isset($_POST['officeId'])){
    $officeId = $_POST['officeId']; 
}else{
    $officeId = 'self'; 
}
$creationDate = date('Y-m-d H:i:s');
$account_maheer = mysqli_fetch_assoc($conn->query("SELECT max(id) as max_id from account_maheer"));
$maxId = intval($account_maheer['max_id'])+1;
if($_FILES['delegate_file']['name'] != ''){
    $target_dir = 'uploads/delegate_account/';
    $file_name = $_FILES['delegate_file']['name'];
    $path = pathinfo($file_name);
    $ext = $path['extension'];
    $file_tmp =$_FILES['delegate_file']['tmp_name'];
    $path_file_ext = $base_dir.$target_dir."delegate_".$maxId.".".$ext;
    $data_path = $target_dir."delegate_".$maxId.".".$ext;
}else{
    $data_path = '';
}
$result = $conn->query("INSERT INTO account_maheer(particular, date, debit, credit, dollar_rate_debit, debit_receipt_2) VALUES ('$officeId','$date', $amount, 0, $rate, '".$data_path."')");
if($result){
    if($_FILES['delegate_file']['name'] != ''){
        move_uploaded_file($file_tmp,$path_file_ext);
    }
    echo "<script> window.location.href='../index.php?page=delegateAllOfficeExpense'</script>";
}else{
    print_r(mysqli_error($conn));
}