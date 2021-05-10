<?php
include ('database.php');
$agentEmail = $_POST['agentEmail'];
$fullAmount = $_POST['fullAmount'];
$agentName = $_POST['agentName'];
$purpose = $_POST['purpose'];
if($purpose == 'other'){
    $purpose = $_POST['otherPurpose'];
}
$paydate = $_POST['paydate'];
$paymentMethod = $_POST['paymentMethod'];
$comment = $_POST['comment'];
$c_date = date('Y-m-d H:m:s');
$date = date('Y-m-d');
$admin = $_SESSION['email'];

$result = $conn->query("INSERT INTO agentexpense(expensePurposeAgent, expenseMode, fullAmount, payDate, agentEmail, comment, creationDate, updatedBy, updatedNo, candidateName, personal) VALUES ('$purpose', '$paymentMethod', $fullAmount, '$paydate', '$agentEmail', '$comment', '$c_date', '$admin', '$date', '$agentName', 'yes')");

if($result){
    if(isset($_POST['lastPage'])){
        echo "<script> window.location.href='../index.php?page=".$_POST['lastPage']."'</script>";
    }else{
        echo "<script> window.location.href='../index.php?page=showAgentExpenseList&ag=".base64_encode($agentEmail)."'</script>";
    }
}else{
    print_r(mysqli_error($conn));
}
