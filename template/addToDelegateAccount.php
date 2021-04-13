<?php
include ('database.php');
if(isset($_POST['alter'])){
    $alter = $_POST['alter'];
}else{
    $alter = '';
}
$delegateId = $_POST['delegateId'];
if($alter == 'delete'){
    $delegateAccountId = $_POST['delegateAccountId'];
    $result = $conn->query("DELETE from delegateaccount where delegateAccountId = $delegateAccountId");
}else{
    $purpose = $_POST['purpose'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];
    $transactionType = $_POST['transactionType'];
    $particular = $_POST['particular'];
    $today = date('Y-m-d H:i:s');
    $todayDate = date('Y-m-d');
    $admin = $_SESSION['email'];
    $delegateAccountIdQry = mysqli_fetch_assoc($conn->query("SELECT max(delegateAccountId) as delegateAccountId from delegateaccount"));
    if(is_null($delegateAccountIdQry)){
        $delegateAccountId = 1;
    }else{
        $delegateAccountId = $delegateAccountIdQry['delegateAccountId'] + 1;
    }
    
    if (($_FILES['withdrawFile']['name'] != "")){
        // Where the file is going to be stored
        $target_dir = "uploads/withdrawFile/";    
        $file = $_FILES['withdrawFile']['name'];
        $path = pathinfo($file);
        $ext = $path['extension'];
        $temp_name = $_FILES['withdrawFile']['tmp_name'];
        $path_filename_ext = $base_dir.$target_dir."withdrawFile"."_".$delegateAccountId.".".$ext;
        $withdrawFile = $target_dir."withdrawFile"."_".$delegateAccountId.".".$ext;
    }else{
        $withdrawFile = '';
    }
    
    $result = $conn->query("INSERT INTO delegateaccount(delegateId, particular, amount, typeOfTransaction, dateOfTransaction, purpose, transactionSlip, creationDate, updatedAt, updatedBy) VALUES ($delegateId, '$particular', $amount, '$transactionType', '$date', '$purpose', '$withdrawFile', '$today', '$todayDate', '$admin')");
    if($result){
        if (($_FILES['withdrawFile']['name'] != "")){
            move_uploaded_file($temp_name,$path_filename_ext);
        }
    }
}

echo "<script> window.location.href='../index.php?page=delegateAccount&dI=".base64_encode($delegateId)."'</script>";