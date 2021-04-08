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
if(isset($_POST['alter'])){
    $alter = $_POST['alter'];
}else{
    $alter = '';
}
if(isset($_POST['expenseId'])){
    $expenseId = $_POST['expenseId'];
}else{
    $expenseId = 0;
}
if($alter == 'delete'){
    $result = $conn->query("DELETE from delegateofficeexpense where expenseId = $expenseId");
    if($result){
        echo "<script> window.location.href='../index.php?page=delegateOfficeExpenseList'</script>";
    }else{
        print_r(mysqli_error($conn));
    }
}else{
    $manpowerOfficeId = $_POST['manpowerOfficeId'];
    $delegateId = $_POST['delegateId'];
    $today = date('Y-m-d');
    $toDayTime = time();
    if (($_FILES['officeReceipt']['name'] != "")){
        // Where the file is going to be stored
        $target_dir = "uploads/delegateOfficeExpense/";
        $file = $_FILES['officeReceipt']['name'];
        $path = pathinfo($file);
        $ext = $path['extension'];
        $temp_name_office = $_FILES['officeReceipt']['tmp_name'];
        $path_database_office = $target_dir."officeReceipt"."_".$toDayTime."_".$manpowerOfficeId.".".$ext;
        $path_filename_ext_office = $base_dir.$target_dir."officeReceipt"."_".$toDayTime."_".$manpowerOfficeId.".".$ext;
        if($alter == 'update'){
            $result = $conn->query("UPDATE delegateofficeexpense set officeReceipt = '$path_database_office' where expenseId = $expenseId)");
            move_uploaded_file($temp_name_office,$path_filename_ext_office);
        }
    }
    if (($_FILES['delegateReceipt']['name'] != "")){
        // Where the file is going to be stored
        $target_dir = "uploads/delegateOfficeExpense/";
        $file = $_FILES['delegateReceipt']['name'];
        $path = pathinfo($file);
        $ext = $path['extension'];
        $temp_name_delegate = $_FILES['delegateReceipt']['tmp_name'];
        $path_database_delegate = $target_dir."delegateReceipt"."_".$toDayTime."_".$delegateId.".".$ext;
        $path_filename_ext_delegate = $base_dir.$target_dir."delegateReceipt"."_".$toDayTime."_".$delegateId.".".$ext;
        if($alter == 'update'){
            $result = $conn->query("UPDATE delegateofficeexpense set delegateReceipt = '$path_database_delegate' where expenseId = $expenseId)");
            move_uploaded_file($temp_name_delegate,$path_filename_ext_delegate);
        }
    }
    $amount = $_POST['amount'];
    $comment = $_POST['comment'];
    $payDate = $_POST['payDate'];
    $admin = $_SESSION['email'];
    if($alter == 'update'){
        $result = $conn->query("UPDATE delegateofficeexpense set delegateId = $delegateId, amount = $amount, date = '$payDate', updatedBy = '$admin', updatedOn = '$today', comment = '$comment' where expenseId = $expenseId");
    }else{
        $result = $conn->query("INSERT INTO delegateofficeexpense(manpowerOfficeId, officeReceipt, delegateId, delegateReceipt, amount, date, updatedBy, updatedOn, comment) VALUES ($manpowerOfficeId, '$path_database_office', $delegateId, '$path_database_delegate',$amount,'$payDate','$admin','$today','$comment')");
    }
    if($result){
        if (($_FILES['officeReceipt']['name'] != "")){
            move_uploaded_file($temp_name_office,$path_filename_ext_office);
        }
        if (($_FILES['delegateReceipt']['name'] != "")){
            move_uploaded_file($temp_name_delegate,$path_filename_ext_delegate);
        }
        echo "<script> window.location.href='../index.php?page=delegateOfficeExpenseList'</script>";
    }
    print_r(mysqli_error($conn));
    print_r("UPDATE delegateofficeexpense set delegateId = $delegateId, amount = $amount, date = '$payDate', updatedBy = '$admin', updatedOn = '$today', comment = '$comment')");
}