<?php 
include ("database.php");
if(isset($_POST['agent'])){
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
    if($alter == 'delete'){
        $result = "DELETE from agentexpense WHERE agentExpenseId='$agentExpenseId'";
        if($result){
            echo "<script>window.alert('Deleted')</script>";
            echo "<script> window.location.href='../index.php?page=expenseAgentList'</script>";
        }else{
            echo "<script>window.alert('Error')</script>";
            echo "<script> window.location.href='../index.php?page=allVisaList'</script>";
        }
    }else{
        $agentEmail = $_POST['agentEmail'];
        $fullAmount = $_POST['fullAmount'];
        $advance = $_POST['advance'];
        $purpose = $_POST['purpose'];        
        $comment = $_POST['comment'];
        $admin = $_SESSION['email'];
        $date = date("Y-m-d");
        $creatDate = date("Y-m-d H:i:s");
        $paydate = $_POST['paydate'];
        if(isset($_POST['adjustAmount'])){
            $adjustAmount = $_POST['adjustAmount'];
        }else{
            $adjustAmount = 0;
        }
        if($alter == 'update'){
            $advance = intval($advance) + intval($adjustAmount);
            $result = $conn->query("UPDATE agentexpense SET expensePurposeAgent='$purpose',fullAmount=$fullAmount,paidAmount=$advance,payDate='$paydate',agentEmail='$agentEmail',comment='$comment',updatedBy='$admin',updatedNo='$date' WHERE agentExpenseId=$agentExpenseId");
            if($result){
                echo "<script>window.alert('Updated')</script>";
                echo "<script> window.location.href='../index.php?page=expenseAgentList'</script>";
            }else{
                echo "<script>window.alert('Error')</script>";
                echo "<script> window.location.href='../index.php?page=allVisaList'</script>";
            }
        }else{
            $result = $conn->query("INSERT INTO agentexpense (expensePurposeAgent, fullAmount, paidAmount, payDate, agentEmail, creationDate, comment, updatedBy, updatedNo) 
                                    VALUES ('$purpose', '$fullAmount', '$advance', '$paydate', '$agentEmail', '$creatDate', '$comment', '$admin', '$date')");
            
            if($result){
                echo "<script>window.alert('Added')</script>";
                echo "<script> window.location.href='../index.php?page=expenseAgentList'</script>";
            }else{
                echo "<script>window.alert('Error')</script>";
                echo "<script> window.location.href='../index.php?page=allVisaList'</script>";
            }
        }        
    }                              
}