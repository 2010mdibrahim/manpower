<?php
include ('database.php');
if(isset($_SESSION['email'])){
    $today = new DateTime(date('Y-m-d'));
    $lastDate = new DateTime(date('Y-m-d'));
    $lastDate->add(new DateInterval('P1D'));
    $today_upper_limit = new DateTime(date('Y-m-d'));
    $today_upper_limit->sub(new DateInterval('P3M'));;
    $today_upper_limit_string = $today_upper_limit->format('Y-m-d');
    $notificationTime = new DateTime(date('Y-m-d H:i:s'));
    $todayF = $today->format('Y-m-d');
    $lastDateF = $lastDate->format('Y-m-d');
    $result_medical = $conn->query("SELECT passportNum, creationDate, fName, lName, mobNum, finalMedicalReport, lastNotificationDate FROM passport WHERE finalMedicalReport BETWEEN '$today_upper_limit_string' AND '$lastDateF' AND `notification` = 'yes'");
    $notification = "";
    if($result_medical){
        while($finalReport = mysqli_fetch_assoc($result_medical)){
            if($finalReport['finalMedicalReport'] > $todayF){
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
            }else{
                $finalMedicalReport = new DateTime($finalReport['finalMedicalReport']);
                $finalMedicalReport->add(new DateInterval('P3M'));
                $finalDiff = $today->diff($finalMedicalReport);
                $lastNofitificationDate = new DateTime($finalReport['lastNotificationDate']);
                $notificationDiff = $notificationTime->diff($lastNofitificationDate);
                if($notificationDiff->h >= 4){
                    if($finalDiff->y == 0 AND $finalDiff->m == 0 AND $finalDiff->d < 14){
                        $notification .= 'Medical Report Date Over: '.$finalReport['passportNum']."<br>";
                    }
                    $notificationTimeF = $notificationTime->format('Y-m-d H:i:s');
                    $result_notified = $conn->query("UPDATE passport set lastNotificationDate = '$notificationTimeF' where passportNum = '".$finalReport['passportNum']."' AND creationDate = '".$finalReport['creationDate']."'");
                }                    
            }
        }
    }    
    
    $result_ticket = $conn->query("SELECT passportNum, passportCreationDate, flightDate, lastNotified FROM ticket WHERE flightDate BETWEEN '$todayF' AND '$lastDateF' AND `notification` = 'yes'");
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

    $result_visa = $conn->query("SELECT processing.lastNotificationDate, processing.processingId, passport.gender, passport.passportNum, processing.visaStampingDate FROM processing INNER JOIN passport on passport.passportNum = processing.passportNum AND passport.creationDate = processing.passportCreationDate WHERE visaStampingDate BETWEEN '$today_upper_limit_string' AND '$todayF'  AND processing.notification = 'yes'");
    if($notification != ""){
        $notification .= '<hr>';
    }
    while($visa = mysqli_fetch_assoc($result_visa)){        
        $stampingDate = new DateTime($visa['visaStampingDate']);
        if($visa['gender'] == 'male'){
            $stampingDate->add(new DateInterval('P3M'));
        }else{
            $stampingDate->add(new DateInterval('P2M'));
        }
        $stampingDateDiff = $stampingDate->diff($today);
        if($visa['lastNotificationDate'] == '0000-00-00 00:00:00'){        
            if($stampingDateDiff->y == 0 AND $stampingDateDiff->m == 0 AND $stampingDateDiff->d < 14 AND $today < $stampingDate){
                $notification .= 'VISA Date Over: '.$visa['passportNum']."<br>";
            }
            $notificationTimeF = $notificationTime->format('Y-m-d H:i:s');
            $result_notified = $conn->query("UPDATE processing set lastNotificationDate = '$notificationTimeF' where processingId = ".$visa['processingId']);   
        }else{
            $lastNofitificationDate = new DateTime($visa['lastNotificationDate']);
            $notificationDiff = $notificationTime->diff($lastNofitificationDate);
            if($notificationDiff->h >= 4){
                if($stampingDateDiff->y == 0 AND $stampingDateDiff->m == 0 AND $stampingDateDiff->d < 14 AND $today < $stampingDate){
                    $notification .= 'VISA Date Over: '.$visa['passportNum']."<br>";
                }
                $notificationTimeF = $notificationTime->format('Y-m-d H:i:s');
                $result_notified = $conn->query("UPDATE processing set lastNotificationDate = '$notificationTimeF' where processingId = ".$visa['processingId']);   
            }
        }
    }
    
    echo $notification;
}else{
    echo "";
}

