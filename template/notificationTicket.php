<?php
include ('database.php');
$today = new DateTime(date('Y-m-d'));
$lastDate = new DateTime(date('Y-m-d'));
$lastDate->add(new DateInterval('P3D'));
$notificationTime = new DateTime(date('Y-m-d H:i:s'));
$todayF = $today->format('Y-m-d');
$lastDateF = $lastDate->format('Y-m-d');
$result = $conn->query("SELECT passportNum, passportCreationDate, flightDate, lastNotified FROM ticket WHERE flightDate BETWEEN '$todayF' AND '$lastDateF' ");
$notification = "";
while($flightDate = mysqli_fetch_assoc($result)){
    $flightDateTime = new DateTime($flightDate['flightDate']);
    $flightDiff = $today->diff($flightDateTime);
    if($flightDate['lastNotified'] == '0000-00-00 00:00:00'){ 
        $notification .= "Ticket Due in ".$flightDiff->d." Days : ".$flightDate['passportNum']."\n";
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
echo $notification;