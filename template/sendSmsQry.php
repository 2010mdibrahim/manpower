<?php
include("class/sendSms.class.php");
$massage = $_POST['massage'];
$numbers = explode(',',$_POST['numbers']);
$phn_number = '';
echo count($numbers);
if(count($numbers) == 1){
    $phn_number .= '&number=%2B88'.$number;				
}else{
    foreach($numbers as $number){
        $phn_number .= '&number[]=%2B88'.$number;				
    }
}
$Send = new SendSms();
$Send->sendSms($phn_number, $massage);
echo "<script> window.location.href='../index.php?page=sendSms'</script>";