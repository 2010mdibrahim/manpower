<?php 
include ("database.php");
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Agent", $_SESSION['sections'])){
            if (headers_sent()) {
                die("No Access");
            }else{
                header("Location: ../index.php");
                exit();
            } 
        }        
    }
}
if(isset($_POST['alter'])){
    $alter = $_POST['alter'];
}else{
    $alter = '';
}
if(isset($_POST['agentExpenseId'])){
    $agentExpenseId = $_POST['agentExpenseId'];
}else{
    $agentExpenseId = '';
}
$agentEmail = $_POST['agentEmail'];
if($alter == 'delete'){
    $result = $conn->query("DELETE from agentexpense WHERE agentExpenseId = $agentExpenseId");
    if($result){
        echo "<script> window.location.href='../index.php?page=showAgentExpenseList&ag=".base64_encode($agentEmail)."'</script>";
    }else{
        echo "<script> window.location.href='../index.php?page=allVisaList'</script>";
    }
}else{
    $fullAmount = $_POST['fullAmount'];
    $purpose = $_POST['purpose'];   
    $expenseMode = $_POST['payMode'];      
    $comment = $_POST['comment'];
    $paydate = $_POST['paydate'];
    $admin = $_SESSION['email'];
    $date = date("Y-m-d");
    $creatDate = date("Y-m-d H:i:s");
    if(isset($_POST['adjustAmount'])){
        $adjustAmount = $_POST['adjustAmount'];
    }else{
        $adjustAmount = 0;
    }
    if($alter == 'update'){
        $result = $conn->query("UPDATE agentexpense SET expensePurposeAgent='$purpose', expenseMode = '$expenseMode', fullAmount=$fullAmount,payDate='$paydate',agentEmail='$agentEmail',comment='$comment',updatedBy='$admin',updatedNo='$date' WHERE agentExpenseId=$agentExpenseId");
        if($result){
            echo "<script> window.location.href='../index.php?page=showAgentExpenseList&ag=".base64_encode($agentEmail)."'</script>";
        }else{
            echo "<script>window.alert('Error')</script>";
            print_r(mysqli_error(mysqli_error($conn)));
        }
    }else{
        $result = $conn->query("INSERT INTO agentexpense (expensePurposeAgent, expenseMode, fullAmount, payDate, agentEmail, creationDate, comment, updatedBy, updatedNo) VALUES ('$purpose', '$expenseMode', '$fullAmount', '$paydate', '$agentEmail', '$creatDate', '$comment', '$admin', '$date')");        
        if($result){
            // echo "<script>window.alert('Added')</script>";
        echo "<script> window.location.href='../index.php?page=showAgentExpenseList&ag=".base64_encode($agentEmail)."'</script>";
        }else{
            echo "<script>window.alert('Error')</script>";
            echo "<script> window.location.href='../index.php?page=allVisaList'</script>";
        }
    }        
}  