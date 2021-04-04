<?php
include ('database.php');
$test = '';
$gender = $_POST['gender'];
$jobType = $_POST['jobType'];
$result = $conn->query("SELECT passportNum, creationDate, fName, lName from passport where finalMedical = 'yes' AND passport.finalMedicalStatus = 'fit' AND passport.testMedicalStatus = 'fit' AND gender = '$gender' AND jobId = $jobType");
$html = '<option value="noCandidate"> Select Candidate </option>';
while($candidate = mysqli_fetch_assoc($result)){
    $html .= '<option value="'.$candidate['passportNum'].'_'.$candidate['creationDate'].'">'.$candidate['fName'].' '.$candidate['lName'].' - '.$candidate['passportNum'].'</option>';
}
echo $html;
