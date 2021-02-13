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
if(!empty($_POST['branchId'])){
    $branchId = $_POST['branchId'];
}else{
    $branchId = '';
}

if($alter == 'delete') {
    $qry = "delete from branch where branchId = $branchId";
    $result = mysqli_query($conn, $qry);
    if ($result) {
        echo "<script>window.alert('Deleted')</script>";
        echo "<script> window.location.href='../../index.php?page=branchList'</script>";
    } else {
        echo "<script>window.alert('Error')</script>";
    }
}else {
    $admin = $_SESSION['email'];
    $branchName = $_POST['branchName'];
    $date = date("Y-m-d");
    if ($alter == 'update') {
        $qry = "UPDATE branch SET branchName='$branchName',updatedBy='$admin',updatedOn='$date', remark = '$remark' WHERE branchId = $branchId";
        $result = mysqli_query($conn, $qry);
        if ($result) {
            echo "<script>window.alert('Updated')</script>";
            echo "<script> window.location.href='../../index.php?page=branchList'</script>";
        } else {
            echo "<script>window.alert('Update Error ')</script>";
            echo "this is test";
        }
    } else {
        $qry = "INSERT INTO branch (branchName, status, updatedBy, updatedOn, remark) 
        VALUES ('$branchName',1,'$admin','$date','$remark')";
        $result = mysqli_query($conn, $qry);
        if ($result) {
            echo "<script>window.alert('Created')</script>";
            echo "<script> window.location.href='../../index.php?page=branchList'</script>";
        } else {
            echo "<script>window.alert('Error')</script>";
        }
    }
}

