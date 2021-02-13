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
if(!empty($_POST['companyId'])){
    $companyId = $_POST['companyId'];
}else{
    $companyId = '';
}
if($alter == 'delete') {
    $qry = "delete from company where companyId = $companyId";
    $result = mysqli_query($conn, $qry);
    if ($result) {
        echo "<script>window.alert('Deleted')</script>";
        echo "<script> window.location.href='../../index.php?page=companyList'</script>";
    } else {
        echo "<script>window.alert('Error')</script>";
    }
}else {
    $admin = $_SESSION['email'];
    $companyName = $_POST['companyName'];
    $date = date("Y-m-d");
    if ($alter == 'update') {
        $qry = "UPDATE company SET companyName='$companyName',updatedBy='$admin',updatedOn='$date', remark = '$remark' WHERE companyId = $companyId";
        $result = mysqli_query($conn, $qry);
        if ($result) {
            echo "<script>window.alert('Updated')</script>";
            echo "<script> window.location.href='../../index.php?page=companyList'</script>";
        } else {
            echo "<script>window.alert('Update Error')</script>";
        }
    } else {
        $qry = "INSERT INTO company (companyName, status, updatedBy, updatedOn, remark) 
        VALUES ('$companyName',1,'$admin','$date','$remark')";
        $result = mysqli_query($conn, $qry);
        if ($result) {
            echo "<script>window.alert('Created')</script>";
            echo "<script> window.location.href='../../index.php?page=companyList'</script>";
        } else {
            echo "<script>window.alert('Error')</script>";
        }
    }
}

