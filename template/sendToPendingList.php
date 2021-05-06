<?php
include ('database.php');
$passportNum = $_POST['passportNum'];
$passportCreationDate = $_POST['passportCreationDate'];
$ticketDate = mysqli_fetch_assoc($conn->query("SELECT flightDate from ticket where passportNum = '$passportNum' AND passportCreationDate = '$passportCreationDate'"));
$pendingTill = new DateTime($ticketDate['flightDate']);
$pendingTill->add(new DateInterval("P3M"));
$result = $conn->query("UPDATE processing set pending = 1, pendingTill = '".$pendingTill->format('Y-m-d')."' where processing.passportNum = '$passportNum' AND processing.passportCreationDate = '$passportCreationDate'");
