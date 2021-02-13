<?php
include ('database.php');
$mofaId = $_POST['mofaId'];
$mofaStage = $_POST['mofaStage'];
$mofaRemark = $_POST['mofaRemark'];
$admin = $_SESSION['email'];
$date = date("Y-m-d");
$qry = "update mofa set mofaStage = '$mofaStage', mofaRemark = '$mofaRemark',updatedBy = '$admin', updatedOn = '$date' where mofaId = $mofaId";
if(mysqli_query($conn,$qry)){
    echo '<script>alert("MOFA Updated")</script>';
    echo "<script> window.location.href='../index.php?page=selectPassport'</script>";
}else{
    echo '<script>alert("MOFA Not Updated")</script>';
    echo "<script> window.location.href='../index.php?page=selectPassport'</script>";
}