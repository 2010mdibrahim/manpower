<?php
include ('database.php');
$gender = $_POST['gender'];
$jobType = $_POST['jobType'];
$result = $conn->query("SELECT passportNum, creationDate, fName, lName from passport where finalMedical = 'yes' AND finalMedicalStatus = 'fit' AND testMedicalStatus = 'fit' and gender = '$gender' and jobId = $jobType");
$html = '<option value=""> Select Candidate </option>';
while($candidate = mysqli_fetch_assoc($result)){
    $html .= '<option value="'.$candidate['passportNum'].'_'.$candidate['creationDate'].'_'.$candidate['fName'].' '.$candidate['lName'].'">'.$candidate['fName'].' '.$candidate['lName'].' - '.$candidate['passportNum'].'</option>';
}
echo $html;
