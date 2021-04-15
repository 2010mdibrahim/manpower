<?php
class SendSms{
    function sendSms($number, $message_body){
        $phnP_n = strlen($number);		
        if($phnP_n == '14'){
            $number = substr($number,'4');
        }else if($phnP_n == '11'){
            $number = substr($number,'1');
        }else{
            $number = $number;
        }	
        $apikey = 'e61022bacbd3b3213716f2295b70de8e44992fb9';  
        $device = '1|0';
        $api_params = '?key='.$apikey.$number.'&message='.urlencode($message_body).'&devices='.$device;  
        $smsGatewayUrl = "https://sms.bapbeta.com/services/send.php";  
        $smsgatewaydata = $smsGatewayUrl.$api_params;
        $url = $smsgatewaydata;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch); 
        echo $output;
    }
}