<?php
include ('database.php');
$max_id = mysqli_fetch_assoc($conn->query("SELECT max(id) as max_id from delegate_comission_for_candidate"));
if (($_FILES['delegateSlip']['name'] != "")){
    // Where the file is going to be stored
    $target_dir = "uploads/delegateSlip/";    
    $file = $_FILES['delegateSlip']['name'];
    $path = pathinfo($file);
    $ext = $path['extension'];
    $temp_name = $_FILES['delegateSlip']['tmp_name'];
    $path_filename_ext = $base_dir.$target_dir."delegateSlip"."_".$max_id['max_id'].".".$ext;
    $delegateSlipFile = $target_dir."delegateSlip"."_".$max_id['max_id'].".".$ext;
}else{
    $delegateSlipFile = '';
}
$prev_comission = mysqli_fetch_assoc($conn->query("SELECT passport.delegateComission, sum(delegate_comission_for_candidate.amount) as `already_paid` from passport LEFT JOIN  delegate_comission_for_candidate on passport.id = delegate_comission_for_candidate.passport_id where passport.id = '".$_POST['passport_id']."'"));
// print_r(mysqli_error($conn));
$result = $conn->query("INSERT into delegate_comission_for_candidate (passport_id, amount, dollar_rate, document) values ('".$_POST['passport_id']."', '".$_POST['amount']."', '".$_POST['dollar_rate']."', '$delegateSlipFile')");
if(!is_null($prev_comission['already_paid'])){
    $alread_paid = $prev_comission['already_paid'];
}else{
    $alread_paid = 0;
}
if($prev_comission['delegateComission'] == ($alread_paid + $_POST['amount'])){
    $update = $conn->query("UPDATE passport set delegateComissionPaid = 'paid' where id = ".$_POST['passport_id']);
}
if($result){
    move_uploaded_file($temp_name,$path_filename_ext);
}
if($result){
    echo "<script> window.location.href='../index.php?page=delegateList'</script>";
}else{
    print_r(mysqli_error($conn));
}