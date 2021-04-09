<?php
include ('database.php');
$employeeId = $_POST['employeeId'];
$empAccess = $_POST['empAccess'];
foreach($empAccess as $section){
    $result = $conn->query("INSERT INTO employeeaccesssection(sectionId, employeeId) VALUES ($section, $employeeId)");
}
if($result){
    echo '<script>window.location.href = "../index.php?page=employeeList"</script>';
}