<?php
include ('database.php');
$email = $_POST['adminEmail'];
$pass = $_POST['adminPass'];
if($email!="" && $pass!=""){
    $qry = "insert into admin (email, pass) values ('$email','$pass')";
    $result = mysqli_query($conn, $qry);
    if($result){
        echo "<script>window.alert('Inserted')</script>";
        echo "<script> window.location.href='../index.php?page='</script>";
    }else{
        echo "<script>window.alert('Error')</script>";
    }
}
