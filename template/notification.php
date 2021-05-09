<?php
include ('database.php');
$today = new DateTime(date('Y-m-d'));
$lastDate = new DateTime(date('Y-m-d'));
$lastDate->add(new DateInterval('P1D'));
$notificationTime = new DateTime(date('Y-m-d H:i:s'));
$todayF = $today->format('Y-m-d');
$lastDateF = $lastDate->format('Y-m-d');
$result = $conn->query("SELECT passportNum, creationDate, fName, lName, mobNum, finalMedicalReport, lastNotificationDate FROM passport WHERE finalMedicalReport BETWEEN '$todayF' AND '$lastDateF'");
$notification = "";
while($finalReport = mysqli_fetch_assoc($result)){
    $finalMedicalReport = new DateTime($finalReport['finalMedicalReport']);
    $finalDiff = $today->diff($finalMedicalReport);
    if($finalReport['lastNotificationDate'] == '0000-00-00 00:00:00'){        
        if($finalDiff->d == 1){
            $notification .= 'Medical Report Due tommorow: '.$finalReport['passportNum']."<br>";
        }else{
            $notification .= 'Medical Report Due today: '.$finalReport['passportNum']."<br>";
        }
        $notificationTimeF = $notificationTime->format('Y-m-d H:i:s');
        $result_notified = $conn->query("UPDATE passport set lastNotificationDate = '$notificationTimeF' where passportNum = '".$finalReport['passportNum']."' AND creationDate = '".$finalReport['creationDate']."'");   
    }else{
        $lastNofitificationDate = new DateTime($finalReport['lastNotificationDate']);
        $notificationDiff = $notificationTime->diff($lastNofitificationDate);
        if($notificationDiff->h >= 4){
            if($finalDiff->d == 1){
                $notification .= 'Medical Report Due tommorow: '.$finalReport['passportNum']."<br>";
            }else{
                $notification .= 'Medical Report Due today: '.$finalReport['passportNum']."<br>";
            }
            $notificationTimeF = $notificationTime->format('Y-m-d H:i:s');
            $result_notified = $conn->query("UPDATE passport set lastNotificationDate = '$notificationTimeF' where passportNum = '".$finalReport['passportNum']."' AND creationDate = '".$finalReport['creationDate']."'");
        }
    }    
}
$result = $conn->query("SELECT passportNum, passportCreationDate, flightDate, lastNotified FROM ticket WHERE flightDate BETWEEN '$todayF' AND '$lastDateF' ");
if($result){
    $notification .= '<hr>';
    while($flightDate = mysqli_fetch_assoc($result)){
        $flightDateTime = new DateTime($flightDate['flightDate']);
        $flightDiff = $today->diff($flightDateTime);
        if($flightDate['lastNotified'] == '0000-00-00 00:00:00'){
            $notification .= "Ticket Due in ".$flightDiff->d." Days : ".$flightDate['passportNum']."<br>";
            $notificationTimeF = $notificationTime->format('Y-m-d H:i:s');
            $result_notified = $conn->query("UPDATE ticket set lastNotified = '$notificationTimeF' where passportNum = '".$flightDate['passportNum']."' AND passportCreationDate = '".$flightDate['passportCreationDate']."'");   
        }else{
            $lastNofitificationDate = new DateTime($flightDate['lastNotified']);
            $notificationDiff = $notificationTime->diff($lastNofitificationDate);
            if($notificationDiff->h >= 4){
                $notification .= "Ticket Due in ".$flightDiff->d." Days : ".$flightDate['passportNum']."\n";
                $notificationTimeF = $notificationTime->format('Y-m-d H:i:s');
                $result_notified = $conn->query("UPDATE ticket set lastNotified = '$notificationTimeF' where passportNum = '".$flightDate['passportNum']."' AND passportCreationDate = '".$flightDate['passportCreationDate']."'");   
            }
        }    
    }
}

echo $notification;

