<?php
include ('../database.php');
$branchId = $_POST['branchId'];
$companyId = $_POST['companyId'];
$admin = $_SESSION['email'];
$date = date("Y-m-d");
$qry = "insert into hasbranch (branchId, companyId, status, updatedBy, updatedOn) values ($branchId,$companyId,1,'$admin','$date')";
$result = mysqli_query($conn, $qry);
if ($result) {
    echo "<script>window.alert('Transferred')</script>";
    echo "<script> window.location.href='../../?page=companyBranchList'</script>";
} else {
    echo "<script>window.alert('Error')</script>";
    echo "<script> window.location.href='../../?page=addBranch'</script>";
}