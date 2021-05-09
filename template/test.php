<?php
$date1 = '2021-07-11';
$date2 = '2021-05-09';
$result_medical = $conn->query("SELECT passportNum, creationDate, fName, lName, mobNum, finalMedicalReport, lastNotificationDate FROM passport WHERE finalMedicalReport");
while($finalReport = mysqli_fetch_assoc($result_medical)){
    if($finalReport['finalMedicalReport'] > $date2){
        echo $finalReport['finalMedicalReport'].' is latest than '.$date2.'<br>';
    }else{
        echo $date2.' is latest than '.$finalReport['finalMedicalReport'].'<br>';
    }
}
