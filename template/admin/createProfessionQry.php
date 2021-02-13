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
if(!empty($_POST['professionId'])){
    $professionId = $_POST['professionId'];
}else{
    $professionId = '';
}

if($alter == 'delete') {
    $qry = "delete from profession where professionId = $professionId";
    $result = mysqli_query($conn, $qry);
    if ($result) {
        echo "<script>window.alert('Deleted')</script>";
        echo "<script> window.location.href='../../index.php?page=professionList'</script>";
    } else {
        echo "<script>window.alert('Error')</script>";
    }
}else {
    $admin = $_SESSION['email'];
    $professionName = $_POST['professionName'];
    $date = date("Y-m-d");
    if ($alter == 'update') {
        $qry = "UPDATE profession SET professionName='$professionName',updatedBy='$admin',updatedOn='$date', remark = '$remark' WHERE professionId = $professionId";
        $result = mysqli_query($conn, $qry);
        if ($result) {
            echo "<script>window.alert('Updated')</script>";
            echo "<script> window.location.href='../../index.php?page=professionList'</script>";
        } else {
            echo "<script>window.alert('Update Error ')</script>";
            echo "this is test".$professionId;
        }
    } else {
        $qry = "INSERT INTO profession (professionName, status, updatedBy, updatedOn, remark) 
        VALUES ('$professionName',1,'$admin','$date','$remark')";
        $result = mysqli_query($conn, $qry);
        if ($result) {
            echo "<script>window.alert('Created')</script>";
            echo "<script> window.location.href='../../index.php?page=professionList'</script>";
        } else {
            echo "<script>window.alert('Error')</script>";
        }
    }
}

