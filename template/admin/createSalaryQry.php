<?php
include ('../database.php');
if(!empty($_POST['alter'])){
    $alter = $_POST['alter'];
}else{
    $alter = '';
}
if(!empty($_POST['remark'])){
    $remark = $_POST['remark'];
}else{
    $remark = '';
}
if(!empty($_POST['salaryId'])){
    $salaryId = $_POST['salaryId'];
}else{
    $salaryId = '';
}

if($alter == 'delete') {
    $qry = "delete from salary where salaryId = $salaryId";
    $result = mysqli_query($conn, $qry);
    if ($result) {
        echo "<script>window.alert('Deleted')</script>";
        echo "<script> window.location.href='../../index.php?page=salaryList'</script>";
    } else {
        echo "<script>window.alert('Error')</script>";
    }
}else {
    $admin = $_SESSION['email'];
    $salaryAmount = $_POST['salaryAmount'];
    $date = date("Y-m-d");
    if ($alter == 'update') {
        $qry = "UPDATE salary SET salaryAmount=$salaryAmount,updatedBy='$admin',updatedOn='$date', remark = '$remark' WHERE salaryId = $salaryId";
        $result = mysqli_query($conn, $qry);
        if ($result) {
            echo "<script>window.alert('Updated')</script>";
            echo "<script> window.location.href='../../index.php?page=salaryList'</script>";
        } else {
            echo "<script>window.alert('Update Error ')</script>";
            echo "this is test";
        }
    } else {
        $qry = "INSERT INTO salary (salaryAmount, status, updatedBy, updatedOn, remark) 
        VALUES ($salaryAmount,1,'$admin','$date','$remark')";
        $result = mysqli_query($conn, $qry);
        if ($result) {
            echo "<script>window.alert('Created')</script>";
            echo "<script> window.location.href='../../index.php?page=salaryList'</script>";
        } else {
            echo "<script>window.alert('Error')</script>";
        }
    }
}

