<?php
include ('database.php');
if(isset($_POST['passportNum'])){
    $passportNum = $_POST['passportNum'];
    $gender = mysqli_fetch_assoc($conn -> query("SELECT gender from passport where passportNum = '$passportNum'"));
    $result = $conn -> query("SELECT sponsorName, jobType, visaGenderType from sponsorvisalist where visaGenderType = '".strtolower($gender['gender'])."' and visaAmount > 0 group by sponsorName");
    echo "<option>Select Sponsor Name</option>";
    while($sponsor = mysqli_fetch_assoc($result)){
        $val = $sponsor['sponsorName']."-".$sponsor['jobType']."-".$sponsor['visaGenderType'];
        echo "<option value='$val'>".$sponsor['sponsorName']." - ".$sponsor['jobType']."</option>";
    }
}