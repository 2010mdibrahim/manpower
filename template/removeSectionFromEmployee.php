<?php
include ('database.php');
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Employee", $_SESSION['sections'])){
            if (headers_sent()) {
                die("No Access");
            }else{
                header("Location: ../index.php");
                exit();
            } 
        }        
    }
}
$sectionInfo = explode('_', $_POST['sectionInfo']);
$result = $conn->query("DELETE from employeeaccesssection where employeeId = ".$sectionInfo[1]." AND sectionId = ".$sectionInfo[0]);
if($result){
    echo '<script>window.location.href = "../index.php?page=employeeList"</script>';
}
