<?php

function sendsms($number, $message_body){
    global $mysqli;
    $phnP_n = strlen($number);    
    if($phnP_n == '14'){
      $number = substr($number,'4');
    }else if($phnP_n == '11'){
      $number = substr($number,'1');
    }else{
      $number = $number;
    }  
    $apikey = 'e61022bacbd3b3213716f2295b70de8e44992fb9';  
    $device = '17|1';
    $api_params = '?key='.$apikey.'&number=%2B880'.$number.'&message='.urlencode($message_body).'&devices='.$device;  
    $smsGatewayUrl = "https://sms.bapbeta.com/services/send.php";  
    $smsgatewaydata = $smsGatewayUrl.$api_params;
    $url = $smsgatewaydata;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, false);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);                         
    if(!empty($output)){
      $mysqli->query("INSERT INTO sms_logs VALUES('','".$mysqli->real_escape_string($number)."','".$mysqli->real_escape_string($message_body)."','".$mysqli->real_escape_string(date("l"))."','".$mysqli->real_escape_string(date("h:i:s"))."','".$mysqli->real_escape_string(date("a"))."','".$mysqli->real_escape_string(date("d/m/Y"))."')");
       //echo $output =  file_get_contents($smsgatewaydata); 
      return true;
    }else{
      return false;
    }
}