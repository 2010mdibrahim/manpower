<?php
include ('database.php');
if(isset($_POST['passportNum'])){
    $passport_info = explode("_",$_POST['passportNum']);
    $passportNum = $passport_info[0];
    $pass_info = mysqli_fetch_assoc($conn -> query("SELECT gender, country, jobId from passport where passportNum = '$passportNum'"));
    $result = $conn -> query("SELECT sponsor.sponsorName, jobs.jobType, delegate.country, sponsorvisalist.sponsorVisa, sponsorvisalist.visaAmount, sponsorvisalist.sponsorNID FROM sponsorvisalist INNER JOIN sponsor USING (sponsorNID) INNER JOIN delegate on sponsor.delegateId = delegate.delegateId INNER JOIN jobs USING (jobId) WHERE sponsorvisalist.jobId = ".$pass_info['jobId']." AND sponsorvisalist.visaGenderType = '".$pass_info['gender']."' AND delegate.country = '".$pass_info['country']."'");
    echo "<option value=''> ----- Select Sponsor Name ------- </option>";
    while($sponsor = mysqli_fetch_assoc($result)){
        $val = $sponsor['sponsorVisa']."-".$sponsor['visaAmount'];
        echo "<option value='".$val."'>".$sponsor['sponsorName']." - ".$sponsor['jobType']." - ".$sponsor['country']."</option>";
    }
}