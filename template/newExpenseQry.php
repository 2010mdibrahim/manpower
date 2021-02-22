<?php
include ('database.php');
$alter = $_POST['alter'];

if(!empty($_POST['purpose'])){
    $purpose = $_POST['purpose'];
}else{
    $purpose = '';
}

if(!empty($_POST['amount'])){
    $amount = $_POST['amount'];
}else{
    $amount = '';
}

if(!empty($_POST['advance'])){
    $advance = $_POST['advance'];
}else{
    $advance = 0;
}

if(!empty($_POST['payDate'])){
    $payDate = $_POST['payDate'];
}else{
    $payDate = '';
}

if(!empty($_POST['remark'])){
    $remark = $_POST['remark'];
}else{
    $remark = '';
}

if(!empty($_POST['expenseId'])){
    $expenseId = $_POST['expenseId'];
}else{
    $expenseId = '';
}

$date = date("Y-m-d");
$creationDate = date("Y-m-d H:i:s");
$admin = $_SESSION['email'];

if($alter == 'insert'){
    $qry = "INSERT INTO expense (purpose, amount, advance, payDate, creationDate, updatedBy, updatedOn, comment) 
            VALUES ('$purpose',$amount,$advance,'$payDate','$creationDate', '$admin','$date','$remark')";
    $result = mysqli_query($conn,$qry);
    if($result)
    {
        echo "<script> window.alert('Added')</script>";
        echo "<script> window.location.href='../index.php?page=expenseDetails'</script>";
    }
    else{
        echo 'something went wrong insert!';
    }
}else if($alter == 'update'){
    $qry = "UPDATE expense SET purpose='$purpose',amount=$amount,advance=$advance,payDate='$payDate',updatedBy='$admin',updatedOn = '$date',comment= '$remark' WHERE expenseId = $expenseId";
    $result = mysqli_query($conn,$qry);
    if($result)
    {
        echo "<script> window.alert('Updated')</script>";
        echo "<script> window.location.href='../index.php?page=expenseDetails'</script>";
    }
    else{
        echo 'something went wrong!';
    }
}else{
    $qry = "DELETE from expense where expenseId = $expenseId";
    $result = mysqli_query($conn,$qry);
    if($result)
    {
        echo "<script> window.alert('Deleted')</script>";
        echo "<script> window.location.href='../index.php?page=expenseDetails'</script>";
    }
    else{
        echo 'something went wrong!';
    }
}
