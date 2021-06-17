<?php
include ('database.php');
if(isset($_SESSION['email'])){
    $save_notification = '';
    $employee_id = $_SESSION['employee_id'];
    $today = new DateTime(date('Y-m-d'));
    $lastDate = new DateTime(date('Y-m-d'));
    $lastDate->add(new DateInterval('P1D'));
    $today_upper_limit = new DateTime(date('Y-m-d'));
    $today_upper_limit->sub(new DateInterval('P3M'));;
    $today_upper_limit_string = $today_upper_limit->format('Y-m-d');
    $notificationTime = new DateTime(date('Y-m-d H:i:s'));
    $todayF = $today->format('Y-m-d');
    $lastDateF = $lastDate->format('Y-m-d');
    $result_medical = $conn->query("SELECT final_medical_insert, id, passportNum, creationDate, fName, lName, mobNum, finalMedicalReport, lastNotificationDate FROM passport WHERE finalMedicalReport BETWEEN '$today_upper_limit_string' AND '$lastDateF' AND `notification` = 'yes'");
    
    $notification = "";
    if($result_medical){
        while($finalReport = mysqli_fetch_assoc($result_medical)){
            if($finalReport['finalMedicalReport'] > $todayF){
                $finalMedicalReport = new DateTime($finalReport['finalMedicalReport']);
                $finalDiff = $today->diff($finalMedicalReport);
                if($finalReport['lastNotificationDate'] == '0000-00-00 00:00:00'){
                    if($finalDiff->d == 1){
                        $notification .= 'Medical Report Due tommorow: '.$finalReport['passportNum']."<br>";
                        $save_notification = 'Medical Report Due tommorow: '.$finalReport['passportNum'];
                    }else{
                        $notification .= 'Medical Report Due today: '.$finalReport['passportNum']."<br>";
                        $save_notification = 'Medical Report Due today: '.$finalReport['passportNum'];
                    }
                    $notificationTimeF = $notificationTime->format('Y-m-d H:i:s');
                    $result_notified = $conn->query("UPDATE passport set lastNotificationDate = '$notificationTimeF' where passportNum = '".$finalReport['passportNum']."' AND creationDate = '".$finalReport['creationDate']."'");   
                    $insert_to_notification = $conn->query("INSERT INTO `notifications`(`notification`, `notification_date`, `employee_id`, `notified`, `passport_id`) VALUES ('$save_notification', '".$notificationTime->format('Y-m-d H:i:s')."', '$employee_id', 'no', ".$finalReport['id'].")");
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
                // medical report date over notification
                $finalMedicalReport = new DateTime($finalReport['finalMedicalReport']);
                $finalMedicalReport->add(new DateInterval('P3M'));
                $finalDiff = $today->diff($finalMedicalReport);
                $lastNofitificationDate = new DateTime($finalReport['lastNotificationDate']);
                $notificationDiff = $notificationTime->diff($lastNofitificationDate);
                if($notificationDiff->h >= 4){
                    if($finalDiff->y == 0 AND $finalDiff->m == 0 AND $finalDiff->d < 14){
                        $notification .= 'Medical Report Warning: '.$finalReport['passportNum']."<br>";
                        $save_notification = 'Medical Report Warning: '.$finalReport['passportNum'];
                    }
                    $notificationTimeF = $notificationTime->format('Y-m-d H:i:s');
                    $result_notified = $conn->query("UPDATE passport set lastNotificationDate = '$notificationTimeF' where passportNum = '".$finalReport['passportNum']."' AND creationDate = '".$finalReport['creationDate']."'");
                    if($finalReport['final_medical_insert'] == 'no' AND $save_notification != ''){
                        $insert_to_notification = $conn->query("INSERT INTO `notifications`(`notification`, `notification_date`, `employee_id`, `passport_id`) VALUES ('$save_notification', '".$notificationTime->format('Y-m-d H:i:s')."', '$employee_id', ".$finalReport['id'].")");
                        $update = $conn->query("UPDATE passport set final_medical_insert = 'yes' where passportNum = '".$finalReport['passportNum']."' AND creationDate = '".$finalReport['creationDate']."'");
                        $save_notification = '';
                    }
                }                    
            }
        }
    }    
    // print_r( "SELECT final_medical_insert, id, passportNum, creationDate, fName, lName, mobNum, finalMedicalReport, lastNotificationDate FROM passport WHERE finalMedicalReport BETWEEN '$today_upper_limit_string' AND '$lastDateF' AND `notification` = 'yes'" );
    // exit();
    $result_ticket = $conn->query("SELECT id, passportNum, passportCreationDate, flightDate, lastNotified FROM ticket WHERE flightDate BETWEEN '$todayF' AND '$lastDateF' AND `notification` = 'yes'");
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
                    $save_notification = "Ticket Due Today : ".$flightDate['passportNum'];
                }else{
                    $notification .= "Ticket Due in ".$flightDiff->d." Days : ".$flightDate['passportNum']."<br>";
                    $save_notification = "Ticket Due in ".$flightDiff->d." Days : ".$flightDate['passportNum'];
                }
                $notificationTimeF = $notificationTime->format('Y-m-d H:i:s');
                $result_notified = $conn->query("UPDATE ticket set lastNotified = '$notificationTimeF' where passportNum = '".$flightDate['passportNum']."' AND passportCreationDate = '".$flightDate['passportCreationDate']."'");   
                $insert_to_notification = $conn->query("INSERT INTO `notifications`(`notification`, `notification_date`, `employee_id`, `notified`, `passport_id`) VALUES ('$save_notification', '".$notificationTime->format('Y-m-d H:i:s')."', '$employee_id', 'no', ".$flightDate['id'].")");
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

    $result_visa = $conn->query("SELECT id, processing.lastNotificationDate, processing.processingId, passport.gender, passport.passportNum, processing.visaStampingDate FROM processing INNER JOIN passport on passport.passportNum = processing.passportNum AND passport.creationDate = processing.passportCreationDate WHERE visaStampingDate BETWEEN '$today_upper_limit_string' AND '$todayF'  AND processing.notification = 'yes'");
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
                $save_notification = 'VISA Date Over: '.$visa['passportNum'];
            }
            $notificationTimeF = $notificationTime->format('Y-m-d H:i:s');
            $result_notified = $conn->query("UPDATE processing set lastNotificationDate = '$notificationTimeF' where processingId = ".$visa['processingId']);   
            $insert_to_notification = $conn->query("INSERT INTO `notifications`(`notification`, `notification_date`, `employee_id`, `notified`, `passport_id`) VALUES ('$save_notification', '".$notificationTime->format('Y-m-d H:i:s')."', '$employee_id', 'no', ".$visa['id'].")");
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

