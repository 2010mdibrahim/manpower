<?php
include ('database.php');
$today = new DateTime(date('Y-m-d'));
$lastDate = new DateTime(date('Y-m-d'));
$lastDate->add(new DateInterval('P1D'));
$notificationTime = new DateTime(date('Y-m-d H:i:s'));
$todayF = $today->format('Y-m-d');
$lastDateF = $lastDate->format('Y-m-d');
$result = $conn->query("SELECT passportNum, creationDate, fName, lName, mobNum, finalMedicalReport, lastNotificationDate FROM passport WHERE finalMedicalReport BETWEEN '$todayF' AND '$lastDateF'");
$diff = array();
$notification = "";
while($finalReport = mysqli_fetch_assoc($result)){
    $finalMedicalReport = new DateTime($finalReport['finalMedicalReport']);
    $finalDiff = $today->diff($finalMedicalReport);
    if($finalReport['lastNotificationDate'] == '0000-00-00 00:00:00'){        
        if($finalDiff->d == 1){
            $notification .= 'Due tommorow: '.$finalReport['fName']." ".$finalReport['lName']." - ".$finalReport['mobNum']."\n";
        }else{
            $notification .= 'Due today: '.$finalReport['fName']." ".$finalReport['lName']." - ".$finalReport['mobNum']."\n";
        }
        $notificationTimeF = $notificationTime->format('Y-m-d H:i:s');
        $result_notified = $conn->query("UPDATE passport set lastNotificationDate = '$notificationTimeF' where passportNum = '".$finalReport['passportNum']."' AND creationDate = '".$finalReport['creationDate']."'");   
    }else{
        $lastNofitificationDate = new DateTime($finalReport['lastNotificationDate']);
        $notificationDiff = $notificationTime->diff($lastNofitificationDate);
        if($notificationDiff->h >= 4){
            if($finalDiff->d == 1){
                $notification .= 'Due tommorow: '.$finalReport['fName']." ".$finalReport['lName']." - ".$finalReport['mobNum']."\n";
            }else{
                $notification .= 'Due today: '.$finalReport['fName']." ".$finalReport['lName']." - ".$finalReport['mobNum']."\n";
            }
            $notificationTimeF = $notificationTime->format('Y-m-d H:i:s');
            $result_notified = $conn->query("UPDATE passport set lastNotificationDate = '$notificationTimeF' where passportNum = '".$finalReport['passportNum']."' AND creationDate = '".$finalReport['creationDate']."'");
        }
    }
    
}
echo $notification;

