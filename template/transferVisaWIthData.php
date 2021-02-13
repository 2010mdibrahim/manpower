<?php
include ('database.php');
$passport = $_POST['passport'];
$visa = $_POST['visa'];
$qry = "update visainfo set passNo = '$passport' where visaId = $visa";
$result = mysqli_query($conn, $qry);
if ($result) {
    echo "<script>window.alert('Transferred')</script>";
    echo "<script> window.location.href='../index.php?page='</script>";
} else {
    echo "<script>window.alert('Error')</script>";
}
