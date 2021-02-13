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
if(!empty($_POST['designationId'])){
    $designationId = $_POST['designationId'];
}else{
    $designationId = '';
}

if($alter == 'delete') {
    $qry = "delete from designation where designationId = $designationId";
    $result = mysqli_query($conn, $qry);
    if ($result) {
        echo "<script>window.alert('Deleted')</script>";
        echo "<script> window.location.href='../../index.php?page=designationList'</script>";
    } else {
        echo "<script>window.alert('Error')</script>";
    }
}else {
    $admin = $_SESSION['email'];
    $designationName = $_POST['designationName'];
    $date = date("Y-m-d");
    if ($alter == 'update') {
        $qry = "UPDATE designation SET designationName='$designationName',updatedBy='$admin',updatedOn='$date', remark = '$remark' WHERE designationId = $designationId";
        $result = mysqli_query($conn, $qry);
        if ($result) {
            echo "<script>window.alert('Updated')</script>";
            echo "<script> window.location.href='../../index.php?page=designationList'</script>";
        } else {
            echo "<script>window.alert('Update Error ')</script>";
            echo "this is test".$professionId;
        }
    } else {
        $qry = "INSERT INTO designation (designationName, status, updatedBy, updatedOn, remark) 
        VALUES ('$designationName',1,'$admin','$date','$remark')";
        $result = mysqli_query($conn, $qry);
        if ($result) {
            echo "<script>window.alert('Created')</script>";
            echo "<script> window.location.href='../../index.php?page=designationList'</script>";
        } else {
            echo "<script>window.alert('Error')</script>";
        }
    }
}

