<?php
include ('database.php');
$email = $_POST["email"];
$pass = $_POST["pass"];
if($email!="" && $pass!=""){
    $qry = "select * from admin where email='$email' and pass='$pass'";
    $result = mysqli_query($conn,$qry);
    $admin = mysqli_fetch_assoc($result);
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