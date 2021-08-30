<?php
include("class/sendSms.class.php");
$massage = $_POST['massage'];
$numbers = explode(',',$_POST['numbers']);
$phn_number = '';
if(count($numbers) == 1){
    $phn_number .= '&number=%2B88'.$numbers[0];				
}else{
    foreach($numbers as $number){
        $phn_number .= '&number[]=%2B88'.$number;				
    }
}
$send = new SendSms();
echo $send->sendSmsExecute($phn_number, $massage);
// echo "<script> window.location.href='../index.php?page=sendSms'</script>";