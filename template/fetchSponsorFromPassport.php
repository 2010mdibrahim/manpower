<?php
include ('database.php');
if(isset($_POST['passportNum'])){
    $passportNum = $_POST['passportNum'];
    $gender = mysqli_fetch_assoc($conn -> query("SELECT gender from passport where passportNum = '$passportNum'"));
    $result = $conn -> query("SELECT jobs.jobType, sponsor.sponsorName, sponsorvisalist.sponsorVisa, sponsorvisalist.sponsorNID, sponsorvisalist.visaAmount from sponsorvisalist inner join jobs using(jobId) INNER JOIN sponsor USING (sponsorNID) WHERE visaGenderType = '".strtolower($gender['gender'])."' and visaAmount > 0 order by sponsorNID");
    echo "<option value='notSet'> ----- Select Sponsor Name ------- </option>";
    while($sponsor = mysqli_fetch_assoc($result)){
        $val = $sponsor['sponsorVisa']."-".$sponsor['visaAmount'];
        echo "<option value='".$val."'>".$sponsor['sponsorName']." - ".$sponsor['jobType']."</option>";
    }
}