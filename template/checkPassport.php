<?php
include ('database.php');
$passportNum = $_POST['passportNum'];
$pass_count = mysqli_fetch_assoc($conn->query("SELECT count(passportNum) as pass_count from passport where passportNum = '$passportNum'"));
if($pass_count['pass_count'] == 0){
    echo 'no';
}else{
    echo 'yes';
}
