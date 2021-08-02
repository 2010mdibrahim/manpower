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
if(isset($_POST['sponsor'])){
    $sponsorNid = $_POST['sponsorNid'];
    $visaNo = $_POST['visaNo'];    
    $issueDate = $_POST['issueDate'];
    $visaAmount = $_POST['visaAmount'];
    $jobType = $_POST['jobType'];
    $gender = $_POST['gender'];
    $comment = $conn->real_escape_string($_POST['comment']);
    $admin = $_SESSION['email'];
    $date = date("Y-m-d");
    $curdate = date("Y-m-d H:i:s");
    if(isset($_POST['alter'])){
        $alter = $_POST['alter'];
    }else{
        $alter = '';
    }
    if($alter == 'update'){
        $result = $conn->query("UPDATE sponsorvisalist set sponsorNID = '$sponsorNid', issueDate = '$issueDate', visaAmount = $visaAmount, visaGenderType = '$gender', jobId = $jobType, comment = \"$comment\", updatedBy = '$admin', updatedOn = '$date' where sponsorVisa = '$visaNo'");
        if($result){
            echo "<script>window.alert('Updated')</script>";
            echo "<script> window.location.href='../index.php?page=allVisaList'</script>";
        }else{
            echo "<script>window.alert('Not Entered')</script>";
            echo "<script> window.location.href='../index.php?page=allVisaList'</script>";
        }
    }else{             
        $i = 0;
        while($i < count($visaNo)){
            $validate = mysqli_fetch_assoc($conn->query("SELECT count(sponsorNID) as sponsorCount from sponsorvisalist where sponsorVisa = '".$visaNo[$i]."'"));
            if($validate['sponsorCount'] == 0){
                if(isset($_POST['assignedCandidate'])){
                    $info = explode('_',$_POST['assignedCandidate']);
                    $passportNum = $info[0];
                    $creationDate = $info[1];
                    $visaAmount = intval($visaAmount[$i]) - 1;
                    $result = $conn->query("INSERT INTO sponsorvisalist (`sponsorVisa`, issueDate, `visaAmount`, `visaGenderType`, `jobId`, `sponsorNID`, `comment`, `updatedBy`, `updatedOn`) VALUES ('$visaNo[$i]', '$issueDate[$i]', $visaAmount, '".strtolower($gender[$i])."', $jobType[$i], '$sponsorNid', \"$comment\", '$admin', '$date')");
                    $result = $conn->query("INSERT into processing (passportNum, passportCreationDate, sponsorVisa, updatedBy, updatedOn, creationDate, comment, okala, mufa, medicalUpdate, visaStamping, finger, trainingCard, manpowerCard) values ('$passportNum', '$creationDate', '$visaNo[$i]', '$admin', '$date', '$curdate', '', 'no', 'no', 'no', 'no', 'no', 'no', 'no')");
                }else{
                    $result = $conn->query("INSERT INTO sponsorvisalist (`sponsorVisa`, issueDate, `visaAmount`, `visaGenderType`, `jobId`, `sponsorNID`, `comment`, `updatedBy`, `updatedOn`) VALUES ('$visaNo[$i]', '$issueDate[$i]', $visaAmount[$i], '".strtolower($gender[$i])."', $jobType[$i], '$sponsorNid', \"$comment\", '$admin', '$date')");
                }
            }else{
                echo "<script>window.alert('Exists')</script>";
                echo "<script> window.location.href='../index.php?page=allVisaList'</script>";
            }
            $i++;
        }          
        if($result){
            echo "<script>window.alert('Entered')</script>";
            echo "<script> window.location.href='../index.php?page=allVisaList'</script>";
        }else{
            echo "<script>window.alert('Not Entered')</script>";
            echo "<script> window.location.href='../index.php?page=visaSponsor'</script>";
        }
    }
}
?>