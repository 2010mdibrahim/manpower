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
if(!empty($_POST['departmentId'])){
    $departmentId = $_POST['departmentId'];
}else{
    $departmentId = '';
}

if($alter == 'delete') {
    $qry = "delete from department where departmentId = $departmentId";
    $result = mysqli_query($conn, $qry);
    if ($result) {
        echo "<script>window.alert('Deleted')</script>";
        echo "<script> window.location.href='../../index.php?page=departmentList'</script>";
    } else {
        echo "<script>window.alert('Error')</script>";
    }
}else {
    $admin = $_SESSION['email'];
    $departmentName = $_POST['departmentName'];
    $date = date("Y-m-d");
    if ($alter == 'update') {
        $qry = "UPDATE department SET departmentName='$departmentName',updatedBy='$admin',updatedOn='$date', remark = '$remark' WHERE departmentId = $departmentId";
        $result = mysqli_query($conn, $qry);
        if ($result) {
            echo "<script>window.alert('Updated')</script>";
            echo "<script> window.location.href='../../index.php?page=departmentList'</script>";
        } else {
            echo "<script>window.alert('Update Error '.$departmentId)</script>";
            echo $departmentId;
            echo "this is test";
        }
    } else {
        $qry = "INSERT INTO department (departmentName, status, updatedBy, updatedOn, remark) 
        VALUES ('$departmentName',1,'$admin','$date','$remark')";
        $result = mysqli_query($conn, $qry);
        if ($result) {
            echo "<script>window.alert('Created')</script>";
            echo "<script> window.location.href='../../index.php?page=departmentList'</script>";
        } else {
            echo "<script>window.alert('Error')</script>";
        }
    }
}

