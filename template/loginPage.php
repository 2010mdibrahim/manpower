<?php
include ('database.php');
$email = $_POST["email"];
$pass = $_POST["pass"];
if($email!="" && $pass!=""){
    $admin = mysqli_fetch_assoc($conn -> query("select * from admin where adminEmail='$email' and adminPass='$pass'"));
    if(count($admin) > 0){
        $_SESSION['email'] = $email;
        $_SESSION['pass'] = $pass;
        echo "<script>window.location='../index.php'</script>";
    }else{
        echo "<script>window.alert('You are not an admin');</script>";
        echo "<script>window.location='../index.php'</script>";
    }
}else{
    echo "<script>window.location='login.php'</script>";
}