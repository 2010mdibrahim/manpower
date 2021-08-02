<?php
include ('database.php');
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("VISA", $_SESSION['sections'])){
            header("Location: ../index.php");
            exit();
        }        
    }
}
$email = $_POST['adminEmail'];
$pass = $conn->real_escape_string($_POST['adminPass']);
if($email!="" && $pass!=""){
    $qry = "INSERT into admin (email, pass) values ('$email','$pass')";
    $result = mysqli_query($conn, $qry);
    if($result){
        echo "<script>window.alert('Inserted')</script>";
        echo "<script> window.location.href='../index.php?page='</script>";
    }else{
        echo "<script>window.alert('Error')</script>";
    }
}
