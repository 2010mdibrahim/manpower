<?php
include ('database.php');
$agentId = $_POST['agent'];
$qry = "SELECT COUNT(visaId) as totalVisa FROM visaInfo WHERE visaIssuAgent = $agentId";
$result = mysqli_query($conn,$qry);
$visa = mysqli_fetch_assoc($result);
$countVisa = $visa['totalVisa'];
for($i = 1; $i<=$countVisa; $i++){
    if(!empty($_POST['amount#'.$i])){
        $amount = $_POST['amount#'.$i];
    }else{
        $amount = 0;
    }
    if(!empty($_POST['paidAmount#'.$i])){
        $paidAmount = $_POST['paidAmount#'.$i];
    }else{
        $paidAmount = 0;
    }
    $visaId = $_POST['visaId#'.$i];
    $qry = "SELECT visaPayId, amount,paidAmount, COUNT(visaPayId) as totalVisa FROM visapayment WHERE visaId = $visaId and agentId = $agentId";
    $result = mysqli_query($conn,$qry);
    $existingVisa = mysqli_fetch_assoc($result);
    $admin = $_SESSION['email'];
    $date = date("Y-m-d");
    if($existingVisa['totalVisa'] > 0){
        $visaPayID = $existingVisa['visaPayId'];
        $oldAmount = $existingVisa['amount'];
        $newAmount = $amount + $oldAmount;
        $oldPayAmount = $existingVisa['paidAmount'];
        $newPaidAmount = $oldPayAmount + $paidAmount;
        $qry = "update visapayment set amount = $newAmount, paidAmount = $newPaidAmount where visaPayId = $visaPayID";
        $result = mysqli_query($conn,$qry);
        if(!$result){
            echo "<script> window.alert('Failed Updating')</script>";
            echo "<script> window.location.href='../index.php?page=addVisaPayment'</script>";
        }
    }else{
        $qry = "INSERT INTO visapayment(visaId, amount, paidAmount, agentId,status,updatedBy,updatedOn) 
                    VALUES ($visaId,$amount,$paidAmount,$agentId,1,'$admin','$date')";
        $result = mysqli_query($conn,$qry);
        if(!$result){
            echo "<script> window.alert('Failed Insertion')</script>";
            echo "<script> window.location.href='../index.php?page=addVisaPayment'</script>";
        }
    }
}
echo "<script> window.alert('Saved')</script>";
echo "<script> window.location.href='../index.php?page=addVisaPayment'</script>";


