<?php
include ('database.php');
$sectionInfo = explode('_', $_POST['sectionInfo']);
$result = $conn->query("DELETE from employeeaccesssection where employeeId = ".$sectionInfo[1]." AND sectionId = ".$sectionInfo[0]);
if($result){
    echo '<script>window.location.href = "../index.php?page=employeeList"</script>';
}
