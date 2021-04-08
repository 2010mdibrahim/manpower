<?php
include ('database.php');
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Sponsor", $_SESSION['sections'])){
            if (headers_sent()) {
                die("No Access");
            }else{
                header("Location: ../index.php");
                exit();
            } 
        }        
    }
}
if(!empty($_POST['alter'])){
    $alter = $_POST['alter'];
}else{
    $alter = '';
}
$sponsorNid = $_POST['sponsorNid'];
if($alter == 'delete') {
    $result = $conn->query("DELETE from sponsor where sponsorNID = '$sponsorNid'");
    if ($result) {
        echo "<script>window.alert('Deleted')</script>";
        echo "<script> window.location.href='../index.php?page=sponsorList'</script>";
    } else {
        echo "<script>window.alert('Error')</script>";
        echo "<script> window.location.href='../index.php?page=sponsorList'</script>";
    }
}else{
    $sponsorPhone = $_POST['sponsorPhone'];
    $delegateOfficeId = $_POST['delegateOfficeId'];
    $sponsorName = $_POST['sponsorName'];
    $admin = $_SESSION['email'];
    $comment = $_POST['comment'];
    $date = date("Y-m-d");    
    if ($alter == 'update') {
        $currentSponsorNid = $_POST['currentSponsorNid'];
        $result = $conn->query("UPDATE sponsor SET sponsorNID = '$sponsorNid', sponsorName = '$sponsorName', sponsorPhone = '$sponsorPhone', comment = '$comment', updatedBy='$admin',updatedOn='$date', delegateOfficeId = $delegateOfficeId WHERE sponsor.sponsorNID = '$currentSponsorNid'");
        if ($result) {
            echo "<script>window.alert('Updated')</script>";
            echo "<script> window.location.href='../index.php?page=sponsorList'</script>";
        } else {
            echo "<script>window.alert('Error')</script>";
            print_r(mysqli_error($conn));
        }
    } else {
        $delegateId = $_POST['delegateId'];
        $curdate = date("Y/m/d H:i:s");
        $creationDate = date("Y-m-d h:i:s", strtotime('+3 hours', strtotime($curdate)));
        $sponsorCount = mysqli_fetch_assoc($conn -> query("SELECT count(sponsorNID) as sponsorCount from sponsor where sponsorNID = '$sponsorNid'"));
        if($sponsorCount['sponsorCount'] == 0){
            $result = $conn->query("INSERT INTO sponsor(sponsorNID, sponsorName, sponsorPhone, comment, delegateOfficeId, updatedBy, updatedOn, creationDate) VALUES ('$sponsorNid', '$sponsorName', '$sponsorPhone', '$comment', $delegateOfficeId,'$admin','$date','$creationDate')");
            $addVisaFlag = $_POST['addVisaFlag'];
            $addCandidateFlag  = $_POST['addCandidateFlag'];
            if($addVisaFlag == 'yes'){
                $visaNo = $_POST['visaNo'];    
                $issueDate = $_POST['issueDate'];
                $visaAmount = $_POST['visaAmount'];
                $jobType = $_POST['jobType'];
                $gender = $_POST['gender'];
                $i = 0;
                while($i < count($visaNo)){
                    $validate = mysqli_fetch_assoc($conn->query("SELECT count(sponsorNID) as sponsorCount from sponsorvisalist where sponsorVisa = '".$visaNo[$i]."'"));
                    if($validate['sponsorCount'] == 0){
						$info = explode('_',$_POST['assignedCandidate']);
                            if($addCandidateFlag == 'yes'){
								if($info[0] != 'noCandidate'){
									$passportNum = $info[0];
									$creationDate = $info[1];
									$visaAmount = intval($visaAmount[$i]) - 1;
									$result = $conn->query("INSERT INTO sponsorvisalist (`sponsorVisa`, issueDate, `visaAmount`, `visaGenderType`, `jobId`, `sponsorNID`, `comment`, `updatedBy`, `updatedOn`) VALUES ('$visaNo[$i]', '$issueDate[$i]', $visaAmount, '".strtolower($gender[$i])."', $jobType[$i], '$sponsorNid', '$comment', '$admin', '$date')");
									$result = $conn->query("INSERT into processing (passportNum, passportCreationDate, sponsorVisa, updatedBy, updatedOn, creationDate, comment, okala, mufa, medicalUpdate, visaStamping, finger, trainingCard, manpowerCard) values ('$passportNum', '$creationDate', '$visaNo[$i]', '$admin', '$date', '$curdate', '', 'no', 'no', 'no', 'no', 'no', 'no', 'no')");
								}else{
									$result = $conn->query("INSERT INTO sponsorvisalist (`sponsorVisa`, issueDate, `visaAmount`, `visaGenderType`, `jobId`, `sponsorNID`, `comment`, `updatedBy`, `updatedOn`) VALUES ('$visaNo[$i]', '$issueDate[$i]', $visaAmount[$i], '".strtolower($gender[$i])."', $jobType[$i], '$sponsorNid', '$comment', '$admin', '$date')");
								}
                            }else{
                                $result = $conn->query("INSERT INTO sponsorvisalist (`sponsorVisa`, issueDate, `visaAmount`, `visaGenderType`, `jobId`, `sponsorNID`, `comment`, `updatedBy`, `updatedOn`) VALUES ('$visaNo[$i]', '$issueDate[$i]', $visaAmount[$i], '".strtolower($gender[$i])."', $jobType[$i], '$sponsorNid', '$comment', '$admin', '$date')");
                            }
                    }else{
                        echo "<script>window.alert('Exists')</script>";
                        echo "<script> window.location.href='../index.php?page=allVisaList'</script>";
                    }
                    $i++;
                } 
            }
            if ($result) {
                echo "<script> window.location.href='../index.php?page=sponsorList'</script>";
            } else {
                echo "<script>window.alert('Error')</script>";
            }
        }else{
                echo "<script>window.alert('Sponsor Already Exists')</script>";
                echo "<script> window.location.href='../index.php?page=sponsorList'</script>";
        }
    }

}
