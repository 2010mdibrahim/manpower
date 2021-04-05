<?php
include ('database.php');
$jobId = $_POST['jobId'];
$result = $conn->query("SELECT manpowerjobprocessing.jobId, manpoweroffice.manpowerOfficeName from manpoweroffice INNER JOIN manpowerjobprocessing using (manpowerOfficeId) where manpowerjobprocessing.jobId = $jobId");
$html = '<option value="">----- Select Office ------</option>';
while($manpower = mysqli_fetch_assoc($result)){
    $html .= '<option>'.$manpower['manpowerOfficeName'].'</option>';
}
echo $html;