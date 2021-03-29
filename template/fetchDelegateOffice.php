<?php
include ('database.php');
$delegateId = $_POST['delegateId'];
$result = $conn->query("SELECT delegateOfficeId, officeName from delegateOffice where delegateId = $delegateId");
$html = '<option value="">Select Delegate Office</option>';
while($office = mysqli_fetch_assoc($result)){
    $html .= '<option value="'.$office['delegateOfficeId'].'">'.$office['officeName'].'</option>';
}
echo $html;