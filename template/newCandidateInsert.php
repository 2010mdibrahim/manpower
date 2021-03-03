<?php
include ('database.php');
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
$jobType = $_POST['jobType'];
$base_dir = "//10.100.105.200/g/xampp/htdocs/mahfuza/";

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
$date = date("Y/m/d H:i:s");
//$date = date("Y-m-d H:i:s", strtotime('-9 hours', strtotime($curdate)));
$update = date("Y/m/d");

// Scanned police verification file directory set - upload code inside result true if statement
if (($_FILES['policeVerification']['name'] != "")){
    // Where the file is going to be stored
    $target_dir = "uploads/policeVerification/";    
    $file = $_FILES['policeVerification']['name'];
    $path = pathinfo($file);
    $ext = $path['extension'];
    $temp_name = $_FILES['policeVerification']['tmp_name'];
    $path_filename_ext = $base_dir.$target_dir."policeVerification"."_".$passportNum.".".$ext;
}

// Scanned photo file directory set - upload code inside result true if statement
if (($_FILES['photoFile']['name'] != "")){
    // Where the file is going to be stored
    $target_dir_photo = "uploads/photo/";
    $file_photo = $_FILES['photoFile']['name'];
    $path_photo = pathinfo($file_photo);
    $photo_ext = $path_photo['extension'];
    $photo_temp_name = $_FILES['photoFile']['tmp_name'];
    $photo_path_filename_ext = $base_dir.$target_dir_photo."photo"."_".$passportNum.".".$photo_ext;
}


// Scanned passport file directory set - upload code inside result true if statement;
if (($_FILES['passportScan']['name'] != "")){
    // Where the file is going to be stored
    $passport_target_dir = "uploads/passport/";
    $file = $_FILES['passportScan']['name'];
    $path = pathinfo($file);
    $passport_ext = $path['extension'];
    $passport_temp_name = $_FILES['passportScan']['tmp_name'];
    $passport_path_filename_ext = $base_dir.$passport_target_dir."passport"."_".$passportNum.".".$passport_ext;
}

$existingPass = mysqli_fetch_assoc($conn->query("select count(passportNum) as passCount from passport where passportNum = '$passportNum'"));
if($existingPass['passCount'] > 0){
    echo "<script>window.alert('Passport Already Exists')</script>";
    echo "<script> window.location.href='../index.php?page=listCandidate'</script>";
}else{
    if (($_FILES['policeVerification']['name'] != "")){
        $policeFile = $target_dir."policeVerification"."_".$passportNum.".".$ext;
    }else{
        $policeFile = '';
    }

    if (($_FILES['photoFile']['name'] != "")){
        $photoFile = $target_dir_photo."photo"."_".$passportNum.".".$photo_ext; 
    }else{
        $photoFile = '';
    }

    if (($_FILES['passportScan']['name'] != "")){
        $passportFile = $passport_target_dir."passport"."_".$passportNum.".".$passport_ext; 
    }else{
        $passportFile = '';
    }   
    
    $result = $conn->query("INSERT INTO passport(passportNum, fName, lName, mobNum, dob, gender, issueDate, validity, departureDate, arrivalDate, jobId, policeClearance, policeClearanceFile, passportPhoto, passportPhotoFile, passportScannedCopy, agentEmail, office, manpowerOfficeName, country, comment, updatedBy, updatedOn, creationDate) VALUES('$passportNum','$fName','$lName','$mobNum','$dob','$gender','$issuD',$validityYear,'$departureDate','$arrivalDate', $jobType,  '$policeVerification', '$policeFile', '$photo', '$photoFile', '$passportFile', '$agentEmail', '$office', '$manpowerOfficeName','$country','$comment','$admin','$date', '$date')");
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
        echo "<script>window.alert('Inserted')</script>";
        echo "<script> window.location.href='../index.php?page=listCandidate'</script>";
    }else{
        $err = mysqli_error($conn);
        print_r($err);
        echo "<script>window.alert('".$err."')</script>";
        echo "<script> window.location.href='../index.php?page=newCandidate'</script>";
    }
}
