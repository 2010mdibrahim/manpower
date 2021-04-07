<?php
include ('database.php');
if(isset($_POST['alter'])){
    $alter = $_POST['alter'];
}else{
    $alter = '';
}
if($alter == 'delete'){
    $employeeId = $_POST['employeeId'];
    $result = $conn->query("DELETE FROM employee WHERE employeeId= $employeeId");
}else{
    $name = $_POST['name'];
    $mobNum = $_POST['mobNum'];
    $address = $_POST['address'];
    $empDesignation = $_POST['empDesignation'];
    if($alter == 'update'){
        $employeeId = $_POST['employeeId'];
        $result = $conn->query("UPDATE employee SET employeeName='$name',empMob='$mobNum',empAddress='$address',empDesignation='$empDesignation' WHERE employeeId= $employeeId");
    }else{
        $officeId = $_POST['officeId'];
        $password = md5($_POST['password']);
        $empAccess = $_POST['empAccess'];
        $result = $conn->query("INSERT INTO employee(employeeOfficeId, employeeName, empMob, empAddress, empDesignation, empPass) VALUES ('$officeId', '$name', '$mobNum', '$address', '$empDesignation', '$password')");
        $empId = mysqli_fetch_assoc($conn->query("SELECT max(employeeId) as employeeId from employee"));
        foreach($empAccess as $section){
            $result = $conn->query("INSERT INTO employeeaccesssection(sectionId, employeeId) VALUES ($section, ".$empId['employeeId'].")");
        }
    }
}
if($result){
    echo '<script>window.location.href = "../index.php?page=employeeList"</script>';
}
