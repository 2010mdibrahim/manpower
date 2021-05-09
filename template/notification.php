<?php
include ('database.php');
if(isset($_SESSION['email'])){
    $today = new DateTime(date('Y-m-d'));
    $lastDate = new DateTime(date('Y-m-d'));
    $lastDate->add(new DateInterval('P1D'));
    $notificationTime = new DateTime(date('Y-m-d H:i:s'));
    $todayF = $today->format('Y-m-d');
    $lastDateF = $lastDate->format('Y-m-d');
    $result_medical = $conn->query("SELECT passportNum, creationDate, fName, lName, mobNum, finalMedicalReport, lastNotificationDate FROM passport WHERE finalMedicalReport BETWEEN '$todayF' AND '$lastDateF'");
    $notification = "";
    if($result_medical){
            while($finalReport = mysqli_fetch_assoc($result_medical)){
                if($finalReport['finalMedicalReport'] < $today){
                    $finalMedicalReport = new DateTime($finalReport['finalMedicalReport']);
                    $finalDiff = $today->diff($finalMedicalReport);
                    if($finalReport['lastNotificationDate'] == '0000-00-00 00:00:00'){        
                        if($finalDiff->d == 1){
                            $notification .= 'Medical Report Due tommorow: '.$finalReport['passportNum']."<br>";
                        }else{
                            $notification .= 'Medical Report Due today: '.$finalReport['passportNum']."<br>";
                        }
                        $notificationTimeF = $notificationTime->format('Y-m-d H:i:s');
                        // $result_notified = $conn->query("UPDATE passport set lastNotificationDate = '$notificationTimeF' where passportNum = '".$finalReport['passportNum']."' AND creationDate = '".$finalReport['creationDate']."'");   
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
                            // $result_notified = $conn->query("UPDATE passport set lastNotificationDate = '$notificationTimeF' where passportNum = '".$finalReport['passportNum']."' AND creationDate = '".$finalReport['creationDate']."'");
                        }
                    }
                }   
            }
    }    
    
    $result_ticket = $conn->query("SELECT passportNum, passportCreationDate, flightDate, lastNotified FROM ticket WHERE flightDate BETWEEN '$todayF' AND '$lastDateF' ");
    if($result_ticket){
        if($notification != ""){
            $notification .= '<hr>';
        }
        while($flightDate = mysqli_fetch_assoc($result_ticket)){
            $flightDateTime = new DateTime($flightDate['flightDate']);
            $flightDiff = $today->diff($flightDateTime);
            if($flightDate['lastNotified'] == '0000-00-00 00:00:00'){
                if($flightDiff->d == 0){
                    $notification .= "Ticket Due Today : ".$flightDate['passportNum']."<br>";
                }else{
                    $notification .= "Ticket Due in ".$flightDiff->d." Days : ".$flightDate['passportNum']."<br>";
                }
                $notificationTimeF = $notificationTime->format('Y-m-d H:i:s');
                $result_notified = $conn->query("UPDATE ticket set lastNotified = '$notificationTimeF' where passportNum = '".$flightDate['passportNum']."' AND passportCreationDate = '".$flightDate['passportCreationDate']."'");   
            }else{
                $lastNofitificationDate = new DateTime($flightDate['lastNotified']);
                $notificationDiff = $notificationTime->diff($lastNofitificationDate);
                if($notificationDiff->h >= 4){
                    if($flightDiff->d == 0){
                        $notification .= "Ticket Due Today : ".$flightDate['passportNum']."<br>";
                    }else{
                        $notification .= "Ticket Due in ".$flightDiff->d." Days : ".$flightDate['passportNum']."<br>";
                    }
                    $notificationTimeF = $notificationTime->format('Y-m-d H:i:s');
                    $result_notified = $conn->query("UPDATE ticket set lastNotified = '$notificationTimeF' where passportNum = '".$flightDate['passportNum']."' AND passportCreationDate = '".$flightDate['passportCreationDate']."'");   
                }
            }    
        }
    }
    
    echo $notification;
}else{
    echo "";
}

