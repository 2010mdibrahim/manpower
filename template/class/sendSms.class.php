<?php
class SendSms{
    function sendSmsExecute($number, $message_body){
        $phnP_n = strlen($number);		
        if($phnP_n == '14'){
            $number = substr($number,'4');
        }else if($phnP_n == '11'){
            $number = substr($number,'1');
        }else{
            $number = $number;
        }	
        $apikey = '45260b1fd9db540482ae3b54252fd15767f0818f';  
        $device = '17|1';
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
        return $output;
    }
}