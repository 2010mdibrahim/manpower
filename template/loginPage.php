<?php
include ('database.php');
$email = $_POST["email"];
$pass = md5($_POST["pass"]);
$sections = array();
if($email!="" && $pass!=""){
    $admin = mysqli_fetch_assoc($conn -> query("select employee.employeeId from employee where employeeOfficeId = '$email' and empPass = '$pass'"));
    if(count($admin) > 0){
        $sections_result = $conn -> query("select sections.sectionName from sections INNER JOIN employeeaccesssection using (sectionId) where employeeaccesssection.employeeId = ".$admin['employeeId']);
        $_SESSION['email'] = $email;
        while($sections = mysqli_fetch_assoc($sections_result)){
            $sections[$sections['sectionName']] = 'yes';
        }
        $_SESSION['sections'] = $sections;
        echo "<script>window.location='../index.php'</script>";
    }else{
        echo "<script>window.alert('You are not an admin');</script>";
        echo "<script>window.location='../index.php'</script>";
    }
}else{
    echo "<script>window.location='login.php'</script>";
}