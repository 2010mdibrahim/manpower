<?php
include ('database.php');
$result_count = mysqli_fetch_assoc($conn->query("SELECT count(ticketId) as count_ticket from ticket where ticket.notified != 'yes'"));
$result = $conn->query("SELECT passport.fName, passport.lName, ticket.flightDate, ticket.ticketId from ticket inner join passport on passport.passportNum = ticket.passportNum AND passport.creationDate = ticket.passportCreationDate where ticket.notified != 'yes'");
$today = new DateTime(date('Y-m-d'));
if($result_count['count_ticket'] > 0){
    echo"   <script>function showNotification() {
                icon = 'image-url';";
    while($ticket = mysqli_fetch_assoc($result)){
        $flightDate = new DateTime($ticket['flightDate']);
        $dateDiff = $flightDate->diff($today);
        if($dateDiff->d < 3){
            $update_notify = $conn->query("UPDATE ticket set notified = 'yes' where ticketId = ".$ticket['ticketId']);
            echo "var body = '".$ticket['fName']." ".$ticket['lName']." remaining day: ".$dateDiff->d."';";
            echo "var notification = new Notification('Ticket Alert', {body,icon});";
        }
    }
    echo "  } </script>";
}
?>