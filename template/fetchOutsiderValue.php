<?php
include ('database.php');
$outsidePassportId = $_POST['outsidePassportId'];
$outsider = mysqli_fetch_assoc($conn->query("SELECT * from outsidepassport where outsidePassportId = $outsidePassportId"));
$response = array(
    "name" => $outsider['name'],
    "mobNum" => $outsider['mobNum'],
    "passportNum" => $outsider['passportNum'],
    "issuDate" => $outsider['issuDate']
);
echo json_encode($response);