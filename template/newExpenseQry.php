<?php
include ('database.php');
$alter = $_POST['alter'];
if(!empty($_POST['expenseId'])){
    $expenseId = $_POST['expenseId'];
}else{
    $expenseId = '';
}
if(!empty($_POST['expenseName'])){
    $expenseNameId = $_POST['expenseName'];
}else{
    $expenseNameId = '';
}
if(!empty($_POST['amount'])){
    $amount = $_POST['amount'];
}else{
    $amount = '';
}
if(!empty($_POST['paymode'])){
    $paymode = $_POST['paymode'];
}else{
    $paymode = '';
}
if(!empty($_POST['remark'])){
    $remark = $_POST['remark'];
}else{
    $remark = '';
}
if(!empty($_POST['date'])){
    $date = $_POST['date'];
}else{
    $date= '';
}

if($alter == 'insert'){
    $qry = "INSERT INTO expense(expenseheadId, amount, paymode, date, remark) VALUES ($expenseNameId,$amount,'$paymode','$date','$remark')";
    $result = mysqli_query($conn,$qry);
    if($result)
    {
        echo "<script> window.alert('Added')</script>";
        echo "<script> window.location.href='../index.php?page=expenseDetails'</script>";
    }
    else{
        echo 'something went wrong!';
    }
}else if($alter == 'update'){
    $qry = "UPDATE expense SET expenseheadId=$expenseNameId,amount=$amount,paymode='$paymode',date='$date',remark='$remark' WHERE expenseId = $expenseId";
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
    $qry = "delete from expense where expenseId = $expenseId";
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
