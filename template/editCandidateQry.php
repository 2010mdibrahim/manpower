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
$alter = $_POST['alter'];
$passportNum = $_POST['passportNum'];
if($alter == 'delete'){
    $creationDate = $_POST['creationDate'];    
    if(isset($_POST['completed'])){
        $result = $conn -> query("DELETE FROM passportcompleted WHERE passportNum = '$passportNum' AND creationDate = '$creationDate'");
    }else{
        $result = $conn -> query("DELETE FROM passport WHERE passportNum = '$passportNum' AND creationDate = '$creationDate'");
    } 
    if($result){
        echo "<script>window.alert('Deleted')</script>";
        if(isset($_POST['completed'])){
            echo "<script> window.location.href='../index.php?page=completeListCandidate'</script>";
        }else{
            echo "<script> window.location.href='../index.php?page=listCandidate'</script>";
        } 
    }else{
        echo "<script>window.alert('Error')</script>";
        echo "<script> window.location.href='../listCandidate.php'</script>";
    }
}else{
    $currentPassport = $_POST['currentPassport'];
    $currentCreationDate = $_POST['currentCreationDate'];
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $gender = $_POST['gender'];
    $mobNum = $_POST['mobNum'];
    $passportNum= $_POST['passportNum'];
    $issuD = $_POST['issuD'];
    $country = $_POST['country'];
    $validityYear = $_POST['validityYear'];
    if(isset($_POST['departureDate'])){
        $departureDate = $_POST['departureDate'];
    }else{
        $departureDate = '';
    }
    if(isset($_POST['arrivalDate'])){
        $arrivalDate = $_POST['arrivalDate'];
    }else{
        $arrivalDate = '';
    }
    $policeVerification = $_POST['policeVerification'];
    $photo = $_POST['passportPhoto'];
    $validityYear = $_POST['validityYear'];
    $manpowerOfficeName = $_POST['manpower'];
    $jobType = $_POST['jobType'];

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
    $update = date("Y-m-d");

    // Scanned police verification file directory set - upload code inside result true if statement
    if (($_FILES['policeVerificationFile']['name'] != "")){
        // Where the file is going to be stored
        $target_dir = "uploads/policeVerification/";    
        $file = $_FILES['policeVerificationFile']['name'];
        $path = pathinfo($file);
        $ext = $path['extension'];
        $temp_name = $_FILES['policeVerificationFile']['tmp_name'];
        $path_filename_ext = $base_dir.$target_dir."policeVerification"."_".$passportNum."_".str_replace(":", "", $currentCreationDate).".".$ext;
        $policeFile = $target_dir."policeVerification"."_".$passportNum."_".str_replace(":", "", $currentCreationDate).".".$ext;
        $result = $conn->query("UPDATE passport set policeClearance = 'yes', policeClearanceFile = '$policeFile' where passportNum = '$passportNum' AND creationDate = '$currentCreationDate'");
        if ($result){
            move_uploaded_file($temp_name,$path_filename_ext);
        }
    }

    // Scanned photo file directory set - upload code inside result true if statement
    if (($_FILES['photoFile']['name'] != "")){
        // Where the file is going to be stored
        $target_dir_photo = "uploads/photo/";
        $file_photo = $_FILES['photoFile']['name'];
        $path_photo = pathinfo($file_photo);
        $photo_ext = $path_photo['extension'];
        $photo_temp_name = $_FILES['photoFile']['tmp_name'];
        $photo_path_filename_ext = $base_dir.$target_dir_photo."photo"."_".$passportNum."_".str_replace(":", "", $currentCreationDate).".".$photo_ext;
        $photoFile = $target_dir_photo."photo"."_".$passportNum."_".str_replace(":", "", $currentCreationDate).".".$photo_ext; 
        $result = $conn->query("UPDATE passport set passportPhoto = 'yes', passportPhotoFile = '$photoFile' where passportNum = '$passportNum' AND creationDate = '$currentCreationDate'");
        if ($result){
            move_uploaded_file($photo_temp_name,$photo_path_filename_ext);
        }
    }


    // Scanned passport file directory set - upload code inside result true if statement;
    if (($_FILES['passportScan']['name'] != "")){
        // Where the file is going to be stored
        $passport_target_dir = "uploads/passport/";
        $file = $_FILES['passportScan']['name'];
        $path = pathinfo($file);
        $passport_ext = $path['extension'];
        $passport_temp_name = $_FILES['passportScan']['tmp_name'];
        $passport_path_filename_ext = $base_dir.$passport_target_dir."passport"."_".$passportNum."_".str_replace(":", "", $currentCreationDate).".".$passport_ext;
        $passportFile = $passport_target_dir."passport"."_".$passportNum."_".str_replace(":", "", $currentCreationDate).".".$passport_ext; 
        $result = $conn->query("UPDATE passport set passportScannedCopy = '$passportFile' where passportNum = '$passportNum' AND creationDate = '$currentCreationDate'");
        if ($result){
            move_uploaded_file($photo_temp_name,$photo_path_filename_ext);
        }
    }

    // Scanned passport file directory set - upload code inside result true if statement;
    if (($_FILES['departureSealFile']['name'] != "")){
        // Where the file is going to be stored
        $departureSeal_target_dir = "uploads/departureSeal/";
        $file = $_FILES['departureSealFile']['name'];
        $path = pathinfo($file);
        $departureSeal_ext = $path['extension'];
        $departureSeal_temp_name = $_FILES['departureSealFile']['tmp_name'];
        $departureSeal_path_filename_ext = $base_dir.$departureSeal_target_dir."departureSeal"."_".$passportNum."_".str_replace(":", "", $currentCreationDate).".".$departureSeal_ext;
        $departureSealFile = $departureSeal_target_dir."departureSeal"."_".$passportNum."_".str_replace(":", "", $currentCreationDate).".".$departureSeal_ext;
        $result = $conn->query("UPDATE passport set departureSealFile = '$departureSealFile', departureSeal = 'yes' where passportNum = '$passportNum' AND creationDate = '$currentCreationDate'");
        if ($result){
            move_uploaded_file($departureSeal_temp_name,$departureSeal_path_filename_ext);
        }
    }

    // Scanned passport file directory set - upload code inside result true if statement;
    if (($_FILES['arrivalSealFile']['name'] != "")){
        // Where the file is going to be stored
        $arrivalSeal_target_dir = "uploads/arrivalSeal/";
        $file = $_FILES['arrivalSealFile']['name'];
        $path = pathinfo($file);
        $arrivalSeal_ext = $path['extension'];
        $arrivalSeal_temp_name = $_FILES['arrivalSealFile']['tmp_name'];
        $arrivalSeal_path_filename_ext = $base_dir.$arrivalSeal_target_dir."arrivalSeal"."_".$passportNum."_".str_replace(":", "", $currentCreationDate).".".$arrivalSeal_ext;
        $arrivalSealFile = $arrivalSeal_target_dir."arrivalSeal"."_".$passportNum."_".str_replace(":", "", $currentCreationDate).".".$arrivalSeal_ext;
        $result = $conn->query("UPDATE passport set arrivalSealFile = '$arrivalSealFile', arrivalSeal = 'yes' where passportNum = '$passportNum' AND creationDate = '$currentCreationDate'");
        if ($result){
            move_uploaded_file($arrivalSeal_temp_name,$arrivalSeal_path_filename_ext);
        }
    }

    // Scanned passport file directory set - upload code inside result true if statement;
    if (($_FILES['fullPhotoFile']['name'] != "")){
        // Where the file is going to be stored
        $arrivalSeal_target_dir = "uploads/photo/";
        $file = $_FILES['fullPhotoFile']['name'];
        $path = pathinfo($file);
        $arrivalSeal_ext = $path['extension'];
        $arrivalSeal_temp_name = $_FILES['fullPhotoFile']['tmp_name'];
        $arrivalSeal_path_filename_ext = $base_dir.$arrivalSeal_target_dir."fullPhotoFile"."_".$passportNum."_".str_replace(":", "", $currentCreationDate).".".$arrivalSeal_ext;
        $arrivalSealFile = $arrivalSeal_target_dir."fullPhotoFile"."_".$passportNum."_".str_replace(":", "", $currentCreationDate).".".$arrivalSeal_ext;
        $result = $conn->query("UPDATE passport set fullPhotoFile = '$arrivalSealFile' where passportNum = '$passportNum' AND creationDate = '$currentCreationDate'");
        if ($result){
            move_uploaded_file($arrivalSeal_temp_name,$arrivalSeal_path_filename_ext);
        }
    }
    $qry = "UPDATE passport SET passportNum = '$passportNum', jobId = $jobType, fName='$fName',lName='$lName',mobNum='$mobNum',dob='$dob',gender='$gender',issueDate='$issuD',validity='$validityYear',country='$country',comment='$comment',updatedBy='$admin',updatedOn='$update', manpowerOfficeName = '$manpowerOfficeName', departureDate = '$departureDate', arrivalDate = '$arrivalDate', agentEmail = '$agentEmail' where passport.passportNum='$currentPassport' AND passport.creationDate = '$currentCreationDate'";
    $result = mysqli_query($conn,$qry);
    $currentAgent = $_POST['currentAgent'];
    if($currentAgent != $agentEmail){
        $result = $conn->query("UPDATE candidateexpense set agentEmail = '$agentEmail' where passportNum = '$passportNum' AND passportCreationDate = '$currentCreationDate'");
    }
    if($result){
        echo "<script> window.location.href='../index.php?page=listCandidate'</script>";
    }else{
        echo "<script>window.alert('Error')</script>";
        echo "<script> window.location.href='../index.php'</script>";
    }

}



