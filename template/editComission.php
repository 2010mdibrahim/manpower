<?php
include ('database.php');
$creationDate = $_POST['creationDate'];
$passportNum = $_POST['passportNum'];
$comissionId = $_POST['comissionId'];
$amount = $_POST['amount'];
if(isset($_POST['alter'])){
    $payMode = $_POST['payMode'];
    $processingId = $_POST['processingId'];
    $today = date('Y-m-d');
    $result = $conn->query("UPDATE agentcomission set payMode = '$payMode', payDate = '$today', paidAmount = $amount where comissionId = $comissionId");
    $result = $conn->query("INSERT INTO processingcompleted SELECT * FROM processing WHERE processingId = $processingId");
    if($result){
        $result = $conn->query("DELETE from processing where processingId = $processingId");
        if($result){
            $result = $conn->query("INSERT INTO passportcompleted SELECT * FROM passport WHERE passportNum = '$passportNum' AND creationDate = '$creationDate'");
            if($result){
                $result = $conn->query("INSERT INTO completedagentcomission SELECT * FROM agentcomission WHERE passportNum = '$passportNum' AND passportCreationDate = '$creationDate'");
                $result = $conn->query("INSERT INTO completedcandidateexpense SELECT * FROM candidateexpense WHERE passportNum = '$passportNum' AND passportCreationDate = '$creationDate'");
                $result = $conn->query("DELETE from passport where passportNum = '$passportNum' AND creationDate = '$creationDate'");
            }
        }
    }
    if($result){
        echo "<script> window.location.href='../index.php?page=visaList'</script>";
    }else{
        echo mysqli_error($conn);
    }
}else{
    $result = $conn->query("UPDATE agentcomission set amount = $amount where comissionId = $comissionId");
    if($result){
        echo "<script> window.location.href='../index.php?page=ce&pn=".base64_encode($passportNum)."&cd=".base64_encode($creationDate)."'</script>";
    }else{
        echo mysqli_error($conn);
    }
}
