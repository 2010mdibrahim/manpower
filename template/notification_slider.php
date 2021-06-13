<?php
include ('database.php');
$notifications = $conn->query("SELECT passport.fName, passport.lName, notifications.* from notifications inner join passport on passport.id = notifications.passport_id where employee_id = '".$_SESSION['employee_id']."' limit 50");
$html =    '<ul class="list-group">';
$i = 0;
while($notification = mysqli_fetch_assoc($notifications)){
    $html .= '<li class="list-group-item"><div class="row"><div class="col-md-10">'.$notification['notification'].' - '.$notification['fName'].' '.$notification['lName'].'</div><div class="col-md-2"><span style="float:right"><small>'.$notification['notification_date'].'</small></span></div></div></li>';
    $i++;
}
while($i<50){
    $html .= '<li class="list-group-item">This is test: '.$i.'</li>';
    $i++;
}
if($i >= 49){
    $html .= '<li class="list-group-item text-center" style="cursor: pointer"><a href="?page=all_notification">Show All</a></li>';
}

$html .=   '</ul>';
$notifications = $conn->query("SELECT * from notifications where employee_id = '".$_SESSION['employee_id']."' limit 50");
// $_SESSION['notification_count'] = 0;
echo $html;