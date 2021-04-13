<?php
include ('database.php');
$candidateList = $_POST['candidateList'];
$delegatePayDate = $_POST['delegatePayDate'];
$maxDelegateComissionIdQry = mysqli_fetch_assoc($conn->query("SELECT max(delegateComissionInformationId) as delegateComissionInformationId from delegatecomissioninformation"));
if(is_null($maxDelegateComissionIdQry)){
    $maxDelegateComissionId = 1;
}else{
    $maxDelegateComissionId = (int)$maxDelegateComissionIdQry['delegateComissionInformationId'] + 1;
}
if (($_FILES['delegateSlip']['name'] != "")){
    // Where the file is going to be stored
    $target_dir = "uploads/delegateSlip/";    
    $file = $_FILES['delegateSlip']['name'];
    $path = pathinfo($file);
    $ext = $path['extension'];
    $temp_name = $_FILES['delegateSlip']['tmp_name'];
    $path_filename_ext = $base_dir.$target_dir."delegateSlip"."_".$maxDelegateComissionId.".".$ext;
    $delegateSlipFile = $target_dir."delegateSlip"."_".$maxDelegateComissionId.".".$ext;
}else{
    $delegateSlipFile = '';
}
$result = $conn->query("INSERT into delegatecomissioninformation (comissionPayDate, comissionSlip) values ('$delegatePayDate', '$delegateSlipFile')");
if($result){
    move_uploaded_file($temp_name,$path_filename_ext);
}
foreach($candidateList as $candidate){
    $candidate_split = explode('_',$candidate);
    $passportNum = $candidate_split[0];
    $creationDate = $candidate_split[1];
    $result = $conn->query("UPDATE passport set delegateComissionPaid = 'paid', delegateComissionInformationId = $maxDelegateComissionId where passportNum = '$passportNum' AND creationDate = '$creationDate'");
}
if($result){
    echo "<script> window.location.href='../index.php?page=delegateList'</script>";
}else{
    print_r(mysqli_error($conn));
}