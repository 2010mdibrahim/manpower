<?php
include ('database.php');
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Candidate", $_SESSION['sections'])){
            header("Location: ../index.php");
            exit();
        }        
    }
}
$info = explode('_',$_POST['info']);
$passportNum = $info[0];
$creationDate = $info[1];
$processingId = $info[2];
if(isset($_POST['finish'])){
    $status = 'finish';
    $today = date('Y-m-d');
    $payMode = 'paid';
    $candidateExpense = mysqli_fetch_assoc($conn->query("SELECT (SELECT sum(advanceAmount) from advance where advance.comissionId = agentcomission.comissionId) as advanceSum, sum(candidateexpense.amount) as candidateExpenseSum, agentcomission.amount, agentcomission.comissionId from agentcomission LEFT JOIN candidateexpense on candidateexpense.passportNum = agentcomission.passportNum AND candidateexpense.passportCreationDate = agentcomission.passportCreationDate where agentcomission.passportNum = '$passportNum' AND agentcomission.passportCreationDate = '$creationDate'"));
    $comissionSumAmount = (is_null($candidateExpense['candidateExpenseSum'])) ? 0 : $candidateExpense['candidateExpenseSum'];
    $advanceSumAmount = (is_null($candidateExpense['advanceSum'])) ? 0 : $candidateExpense['advanceSum'];
    $amount = $candidateExpense['amount'] - ($comissionSumAmount + $advanceSumAmount);
    $result = $conn->query("UPDATE processing set pending = 2 where passportNum = '$passportNum' AND passportCreationDate = '$creationDate'");
    $result = $conn->query("UPDATE agentcomission set payMode = '$payMode', paidAmount = $amount where comissionId = ".$candidateExpense['comissionId']);
    $result = $conn->query("INSERT INTO passportcompleted SELECT * FROM passport WHERE passportNum = '$passportNum' AND creationDate = '$creationDate'");
    $result = $conn->query("INSERT INTO processingcompleted SELECT * FROM processing WHERE processingId = $processingId");
    if($result){
        if($result){
            if($result){
                $result = $conn->query("INSERT INTO completedagentcomission SELECT * FROM agentcomission WHERE passportNum = '$passportNum' AND passportCreationDate = '$creationDate'");
                $result = $conn->query("INSERT INTO completedcandidateexpense SELECT * FROM candidateexpense WHERE passportNum = '$passportNum' AND passportCreationDate = '$creationDate'");
                $result = $conn->query("INSERT INTO completedticket SELECT * FROM ticket WHERE passportNum = '$passportNum' AND passportCreationDate = '$creationDate'");
                $result = $conn->query("INSERT INTO completedadvance SELECT * FROM advance WHERE comissionId = ".$candidateExpense['comissionId']);
                // $result = $conn->query("DELETE from passport where passportNum = '$passportNum' AND creationDate = '$creationDate'");
            }
        }
    }
    if($result){
        echo "<script> window.location.href='../index.php?page=pendingListCandidate'</script>";
    }else{
        echo mysqli_error($conn);
    }
}else if(isset($_POST['return'])){
    $status = 'return';
    $today = date('Y-m-d');
    $payMode = 'paid';
    $candidateExpense = mysqli_fetch_assoc($conn->query("SELECT sum(candidateexpense.amount) as candidateExpenseSum, agentcomission.amount, agentcomission.comissionId from agentcomission LEFT JOIN candidateexpense on candidateexpense.passportNum = agentcomission.passportNum AND candidateexpense.passportCreationDate = agentcomission.passportCreationDate where agentcomission.passportNum = '$passportNum' AND agentcomission.passportCreationDate = '$creationDate'"));
    $comissionSumAmount = (is_null($candidateExpense['candidateExpenseSum'])) ? 0 : $candidateExpense['candidateExpenseSum'];
    $amount = $candidateExpense['amount'] - $comissionSumAmount;
    $result = $conn->query("UPDATE processing set pending = 3 where passportNum = '$passportNum' AND passportCreationDate = '$creationDate'");
    $result = $conn->query("UPDATE agentcomission set payMode = '$payMode', paidAmount = $amount where comissionId = ".$candidateExpense['comissionId']);
    $result = $conn->query("INSERT INTO passportcompleted SELECT * FROM passport WHERE passportNum = '$passportNum' AND creationDate = '$creationDate'");
    $result = $conn->query("INSERT INTO processingcompleted SELECT * FROM processing WHERE processingId = $processingId");
    if($result){
        if($result){
            if($result){
                $result = $conn->query("INSERT INTO completedagentcomission SELECT * FROM agentcomission WHERE passportNum = '$passportNum' AND passportCreationDate = '$creationDate'");
                $result = $conn->query("INSERT INTO completedcandidateexpense SELECT * FROM candidateexpense WHERE passportNum = '$passportNum' AND passportCreationDate = '$creationDate'");
                $result = $conn->query("INSERT INTO completedticket SELECT * FROM ticket WHERE passportNum = '$passportNum' AND passportCreationDate = '$creationDate'");
                $result = $conn->query("INSERT INTO completedadvance SELECT * FROM advance WHERE comissionId = ".$candidateExpense['comissionId']);
                // $result = $conn->query("DELETE from passport where passportNum = '$passportNum' AND creationDate = '$creationDate'");
            }
        }
    }
    if($result){
        echo "<script> window.location.href='../index.php?page=pendingListCandidate'</script>";
    }else{
        echo mysqli_error($conn);
    }
}