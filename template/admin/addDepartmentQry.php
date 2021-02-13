<?php
include ('../database.php');
$departmentId = $_POST['departmentId'];
$companyId = $_POST['companyId'];
$admin = $_SESSION['email'];
$date = date("Y-m-d");
$qry = "insert into hasDepartment (departmentId, companyId, status, updatedBy, updatedOn) values ($departmentId,$companyId,1,'$admin','$date')";
$result = mysqli_query($conn, $qry);
if ($result) {
    echo "<script>window.alert('Transferred')</script>";
    echo "<script> window.location.href='../../?page=companyDepartmentList'</script>";
} else {
    echo "<script>window.alert('Error')</script>";
}