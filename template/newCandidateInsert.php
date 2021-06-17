<?php
include ('database.php');
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Candidate", $_SESSION['sections'])){
            if (headers_sent()) {
                die("No Access");
            }else{
                header("Location: ../index.php");
                exit();
            } 
        }        
    }
}
$includeCandidate = $_POST['includeCandidateFromAgent'];
$nid = $_POST['nid'];
$fName = $_POST['fName'];
$lName = $_POST['lName'];
$gender = $_POST['gender'];
$mobNum = $_POST['mobNum'];
$passportNum= $_POST['passportNum'];
$issuD = $_POST['issuD'];
$country = $_POST['country'];
$validityYear = $_POST['validityYear'];
$departureDate = $_POST['departureDate'];
$arrivalDate = $_POST['arrivalDate'];
$policeVerification = $_POST['policeVerification'];
$photo = $_POST['passportPhoto'];
$validityYear = $_POST['validityYear'];
$manpowerOfficeName = $_POST['manpower'];
$jobTypeInfo = explode('_',$_POST['jobType']);
$jobType = $jobTypeInfo[0];
if(isset($_POST['agentEmail'])){
    $agentEmail = $_POST['agentEmail'];
}else{
    $agentEmail = '';
}

if(isset($_POST['office'])){
    $office = $_POST['office'];
}else{
    $office = '';
}

$comment = $_POST['comment'];
$dob = $_POST['dob'];
$admin = $_SESSION['email'];
$date = date("Y-m-d H:i:s");
$update = date("Y-m-d");


// Scanned police verification file directory set - upload code inside result true if statement
if (($_FILES['policeVerification']['name'] != "")){
    // Where the file is going to be stored
    $target_dir = "uploads/policeVerification/";    
    $file = $_FILES['policeVerification']['name'];
    $path = pathinfo($file);
    $ext = $path['extension'];
    $temp_name = $_FILES['policeVerification']['tmp_name'];
    $path_filename_ext = $base_dir.$target_dir."policeVerification"."_".$passportNum."_".str_replace(":", "", $date).".".$ext;
    $policeFile = $target_dir."policeVerification"."_".$passportNum."_".str_replace(":", "", $date).".".$ext;
}else{
    $policeFile = '';
}

// Scanned photo file directory set - upload code inside result true if statement
if (($_FILES['photoFile']['name'] != "")){
    // Where the file is going to be stored
    $target_dir_photo = "uploads/photo/";
    $file_photo = $_FILES['photoFile']['name'];
    $path_photo = pathinfo($file_photo);
    $photo_ext = $path_photo['extension'];
    $photo_temp_name = $_FILES['photoFile']['tmp_name'];
    $photo_path_filename_ext = $base_dir.$target_dir_photo."photo"."_".$passportNum."_".str_replace(":", "", $date).".".$photo_ext;
    $photoFile = $target_dir_photo."photo"."_".$passportNum."_".str_replace(":", "", $date).".".$photo_ext; 
}else{
    $photoFile = '';
}


// Scanned passport file directory set - upload code inside result true if statement;
if (($_FILES['passportScan']['name'] != "")){
    // Where the file is going to be stored
    $passport_target_dir = "uploads/passport/";
    $file = $_FILES['passportScan']['name'];
    $path = pathinfo($file);
    $passport_ext = $path['extension'];
    $passport_temp_name = $_FILES['passportScan']['tmp_name'];
    $passport_path_filename_ext = $base_dir.$passport_target_dir."passport"."_".$passportNum."_".str_replace(":", "", $date).".".$passport_ext;
    $passportFile = $passport_target_dir."passport"."_".$passportNum."_".str_replace(":", "", $date).".".$passport_ext; 
}else{
    $passportFile = '';
}

// Scanned passport file directory set - upload code inside result true if statement;
if (($_FILES['departureSealFile']['name'] != "")){
    // Where the file is going to be stored
    $departureSeal_target_dir = "uploads/departureSeal/";
    $file = $_FILES['departureSealFile']['name'];
    $path = pathinfo($file);
    $departureSeal_ext = $path['extension'];
    $departureSeal_temp_name = $_FILES['departureSealFile']['tmp_name'];
    $departureSeal_path_filename_ext = $base_dir.$departureSeal_target_dir."departureSeal"."_".$passportNum."_".str_replace(":", "", $date).".".$departureSeal_ext;
    $departureSeal = 'yes';
    $departureSealFile = $departureSeal_target_dir."departureSeal"."_".$passportNum."_".str_replace(":", "", $date).".".$departureSeal_ext; 
}else{
    $departureSeal = 'no';
    $departureSealFile = '';
}

// Scanned passport file directory set - upload code inside result true if statement;
if (($_FILES['arrivalSealFile']['name'] != "")){
    // Where the file is going to be stored
    $arrivalSeal_target_dir = "uploads/arrivalSeal/";
    $file = $_FILES['arrivalSealFile']['name'];
    $path = pathinfo($file);
    $arrivalSeal_ext = $path['extension'];
    $arrivalSeal_temp_name = $_FILES['arrivalSealFile']['tmp_name'];
    $arrivalSeal_path_filename_ext = $base_dir.$arrivalSeal_target_dir."arrivalSeal"."_".$passportNum."_".str_replace(":", "", $date).".".$arrivalSeal_ext;
    $arrivalSeal = 'yes'; 
    $arrivalSealFile = $arrivalSeal_target_dir."arrivalSeal"."_".$passportNum."_".str_replace(":", "", $date).".".$arrivalSeal_ext; 
}else{
    $arrivalSeal = 'no';
    $arrivalSealFile = '';
}

// Scanned passport file directory set - upload code inside result true if statement;
if (($_FILES['traningCardFile']['name'] != "")){
    // Where the file is going to be stored
    $trainingCard_target_dir = "uploads/trainingCard/";
    $file = $_FILES['traningCardFile']['name'];
    $path = pathinfo($file);
    $trainingCard_ext = $path['extension'];
    $trainingCard_temp_name = $_FILES['traningCardFile']['tmp_name'];
    $trainingCard_path_filename_ext = $base_dir.$trainingCard_target_dir."trainingCard"."_".$passportNum."_".str_replace(":", "", $date).".".$trainingCard_ext;
    $traningCard = 'yes'; 
    $traningCardFile = $trainingCard_target_dir."trainingCard"."_".$passportNum."_".str_replace(":", "", $date).".".$trainingCard_ext; 
}else{
    $traningCard = 'no';
    $traningCardFile = '';
}

// Scanned passport file directory set - upload code inside result true if statement;
if (($_FILES['fullPhotoFile']['name'] != "")){
    // Where the file is going to be stored
    $fullPhotoFile_target_dir = "uploads/photo/";
    $file = $_FILES['fullPhotoFile']['name'];
    $path = pathinfo($file);
    $fullPhotoFile_ext = $path['extension'];
    $fullPhotoFile_temp_name = $_FILES['fullPhotoFile']['tmp_name'];
    $fullPhotoFile_path_filename_ext = $base_dir.$fullPhotoFile_target_dir."fullPhotoFile"."_".$passportNum."_".str_replace(":", "", $date).".".$fullPhotoFile_ext;
    $fullPhotoFile = $fullPhotoFile_target_dir."fullPhotoFile"."_".$passportNum."_".str_replace(":", "", $date).".".$fullPhotoFile_ext;
}else{
    $fullPhotoFile = 'no';
}

    $existingPass = mysqli_fetch_assoc($conn->query("SELECT count(passportNum) as passCount from passport where passportNum = '$passportNum'"));
    

    // comission and comission advance
    $advance = $_POST['advance'];
    $comission = $_POST['comission'];

    if($_POST['experience'] == 'yes'){
        $experience = 'experienced';
    }else{
        $experience = 'new';
    }
    
    
    $result = $conn->query("INSERT INTO passport(passportNum, fName, lName, mobNum, dob, gender, issueDate, validity, experienceStatus, departureDate, arrivalDate, jobId, policeClearance, policeClearanceFile, passportPhoto, passportPhotoFile, passportScannedCopy, departureSeal, departureSealFile, arrivalSeal, arrivalSealFile, agentEmail, office, manpowerOfficeName, country, trainingCard, trainingCardFile, comment, updatedBy, updatedOn, creationDate, testMedicalStatus, finalMedicalStatus, fullPhotoFile) VALUES('$passportNum','$fName','$lName','$mobNum','$dob','$gender','$issuD',$validityYear, '$experience','$departureDate','$arrivalDate', $jobType,  '$policeVerification', '$policeFile', '$photo', '$photoFile', '$passportFile','$departureSeal','$departureSealFile','$arrivalSeal','$arrivalSealFile', '$agentEmail', '$office', '$manpowerOfficeName','$country', '$traningCard', '$traningCardFile', \"$comment\",'$admin','$date', '$date', 'fit', 'fit', '$fullPhotoFile')");
    $expCountry = $_POST['expCountry'];
    $maxIdQry = mysqli_fetch_assoc($conn->query("SELECT max(optionalFileId) as maxId from optionalfiles"));
    if(is_null($maxIdQry['maxId'])){
        $maxId = 1;
    }else{
        $maxId = (int)$maxIdQry['maxId'] + 1;
    }
    if($_FILES['optionalFile']['name'][0] != ''){
        foreach($_FILES['optionalFile']['tmp_name'] as $key => $tmp_name){
            $target_dir = 'uploads/optionalFile/';
            $file_name = $key.$_FILES['optionalFile']['name'][$key];
            $path = pathinfo($file_name);
            $ext = $path['extension'];
            $file_tmp =$_FILES['optionalFile']['tmp_name'][$key];
            $path_file_ext = $base_dir.$target_dir."optionalFile_".$maxId.".".$ext;
            $data_path = $target_dir."optionalFile_".$maxId.".".$ext;
            $result = $conn -> query("INSERT INTO optionalfiles(passportNum, passportCreationDate, optionalFile) VALUES ('$passportNum','$date','$data_path')");
            move_uploaded_file($file_tmp,$path_file_ext);
            $maxId++;
        }
    }
    foreach($expCountry as $countryName){
        $result = $conn->query("INSERT INTO passportexperiencedcountry(passportNum, passportCreationDate, country) VALUES ('$passportNum','$date','$countryName')");
    }
    if($result){
        $result = $conn->query("INSERT INTO agentcomission(amount, passportNum, passportCreationDate, agentEmail, creationDate, updatedBy, updatedOn) VALUES ($comission, '$passportNum', '$date', '$agentEmail', '$date', '$admin', '$date')");
        if($advance == 'yes'){
            $advance_amount = $_POST['advance_amount'];
            $payDate = $_POST['payDate'];
            $payMode = $_POST['payMode'];
            $comissionId = mysqli_fetch_assoc($conn->query("SELECT max(comissionId) as comissionId from agentcomission"));
            $result = $conn->query("INSERT INTO advance(advanceAmount, payDate, advancePayMode, comissionId, updatedBy, updatedOn, agentEmail) VALUES ($advance_amount, '$payDate', '$payMode', ".$comissionId['comissionId'].", '$admin', '$date', '$agentEmail')");
        }        
    }
    $onlyDate = date('Y-m-d');
    if($result){
        if($includeCandidate == 'yes'){
            $result = $conn->query("SELECT fullAmount, payDate, expensePurposeAgent, expenseMode, agentEmail, comment from agentexpense where candidateNID = '$nid' OR candidateBirthNumber = '$nid'");
            while($agentExpnse = mysqli_fetch_assoc($result)){
                $result_candidate_expense = $conn->query("INSERT INTO candidateexpense(amount, payDate, purpose, payMode, agentEmail, creationDate, updatedBy, updatedOn, comment,  passportNum, passportCreationDate) VALUES (".$agentExpnse['fullAmount'].", '".$agentExpnse['payDate']."', '".$agentExpnse['expensePurposeAgent']."', '".$agentExpnse['expenseMode']."', '".$agentExpnse['agentEmail']."', '$date', '$admin', '$onlyDate', '".$agentExpnse['comment']."', '$passportNum', '$date')");
            }
            if($result_candidate_expense){
                $result_delet_expense_from_agent = $conn->query("DELETE from agentexpense where candidateNID = '$nid' OR candidateBirthNumber = '$nid'");
            }
        }        
    }
    if($result){
        if (($_FILES['policeVerification']['name'] != "")){
            move_uploaded_file($temp_name,$path_filename_ext);
        }
        if (($_FILES['photoFile']['name'] != "")){
            move_uploaded_file($photo_temp_name,$photo_path_filename_ext);
        }
        if (($_FILES['passportScan']['name'] != "")){
            move_uploaded_file($passport_temp_name,$passport_path_filename_ext);
        }
        if (($_FILES['departureSealFile']['name'] != "")){
            move_uploaded_file($departureSeal_temp_name,$departureSeal_path_filename_ext);
        }
        if (($_FILES['arrivalSealFile']['name'] != "")){
            move_uploaded_file($arrivalSeal_temp_name,$arrivalSeal_path_filename_ext);
        }
        if (($_FILES['traningCardFile']['name'] != "")){
            move_uploaded_file($trainingCard_temp_name,$trainingCard_path_filename_ext);
        } 
        if (($_FILES['fullPhotoFile']['name'] != "")){
            move_uploaded_file($fullPhotoFile_temp_name,$fullPhotoFile_path_filename_ext);
        }       
        echo "<script> window.location.href='../index.php?page=listCandidate'</script>";
    }else{
        $err = mysqli_error($conn);
        echo "<script>window.alert('".$err."')</script>";
    }
