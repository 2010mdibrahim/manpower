<?php
include ('database.php');
$notifications = $conn->query("SELECT passport.fName, passport.lName, passport.finalMedicalStatus, passport.testMedicalStatus, notifications.* from notifications inner join passport on passport.id = notifications.passport_id LEFT JOIN processing on processing.passportNum = passport.passportNum AND processing.passportCreationDate = passport.creationDate where processing.pending not in (2,3) ORDER BY notifications.id desc limit 50");
print_r(mysqli_error($conn));
$html =    '<ul class="list-group">';
$i = 0;
while($notification = mysqli_fetch_assoc($notifications)){
    if(strpos($notification['notification'], 'Medical') !== false){
        if($notification['finalMedicalStatus'] != 'unfit' AND $notification['testMedicalStatus'] != 'unfit'){
            $html .= '<li class="list-group-item"><div class="row"><div class="col-md-10">'.$notification['notification'].' - '.$notification['fName'].' '.$notification['lName'].'</div><div class="col-md-2"><span style="float:right"><small>'.$notification['notification_date'].'</small></span></div></div></li>';
        }
    }
    $i++;
}
if($i >= 49){
    $html .= '<li class="list-group-item text-center" style="cursor: pointer"><a href="?page=all_notification">Show All</a></li>';
}else if($i == 0){
    $html .= '<li class="list-group-item text-center" style="cursor: pointer">No Notification</li>';
}
$html .=   '</ul>';
$notifications = $conn->query("SELECT * from notifications where employee_id = '".$_SESSION['employee_id']."' limit 50");
// $_SESSION['notification_count'] = 0;
echo $html;