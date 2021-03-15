<?php
include ('database.php');
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
    $departureDate = $_POST['departureDate'];
    $arrivalDate = $_POST['arrivalDate'];
    $policeVerification = $_POST['policeVerification'];
    $photo = $_POST['passportPhoto'];
    $validityYear = $_POST['validityYear'];
    $manpowerOfficeName = $_POST['manpower'];

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
        $base_dir = "C:/xampp/htdocs/mahfuza/";
        $target_dir = "uploads/policeVerification/";    
        $file = $_FILES['policeVerificationFile']['name'];
        $path = pathinfo($file);
        $ext = $path['extension'];
        $temp_name = $_FILES['policeVerificationFile']['tmp_name'];
        $path_filename_ext = $base_dir.$target_dir."policeVerification"."_".$passportNum.".".$ext;
        $policeFile = $target_dir."policeVerification"."_".$passportNum.".".$ext;
        $result = $conn->query("UPDATE passport set policeClearance = 'yes', policeClearanceFile = '$policeFile' where passportNum = '$passportNum' AND creationDate = '$currentCreationDate'");
        if ($result){
            move_uploaded_file($temp_name,$path_filename_ext);
        }
    }

    // Scanned photo file directory set - upload code inside result true if statement
    if (($_FILES['photoFile']['name'] != "")){
        // Where the file is going to be stored
        $base_dir = "C:/xampp/htdocs/mahfuza/";
        $target_dir_photo = "uploads/photo/";
        $file_photo = $_FILES['photoFile']['name'];
        $path_photo = pathinfo($file_photo);
        $photo_ext = $path_photo['extension'];
        $photo_temp_name = $_FILES['photoFile']['tmp_name'];
        $photo_path_filename_ext = $base_dir.$target_dir_photo."photo"."_".$passportNum.".".$photo_ext;
        $photoFile = $target_dir_photo."photo"."_".$passportNum.".".$photo_ext; 
        $result = $conn->query("UPDATE passport set passportPhoto = 'yes', passportPhotoFile = '$photoFile' where passportNum = '$passportNum' AND creationDate = '$currentCreationDate'");
        if ($result){
            move_uploaded_file($photo_temp_name,$photo_path_filename_ext);
        }
    }


    // Scanned passport file directory set - upload code inside result true if statement;
    if (($_FILES['passportScan']['name'] != "")){
        // Where the file is going to be stored
        $base_dir = "C:/xampp/htdocs/mahfuza/";
        $passport_target_dir = "uploads/passport/";
        $file = $_FILES['passportScan']['name'];
        $path = pathinfo($file);
        $passport_ext = $path['extension'];
        $passport_temp_name = $_FILES['passportScan']['tmp_name'];
        $passport_path_filename_ext = $base_dir.$passport_target_dir."passport"."_".$passportNum.".".$passport_ext;
        $passportFile = $passport_target_dir."passport"."_".$passportNum.".".$passport_ext; 
        $result = $conn->query("UPDATE passport set passportScannedCopy = '$photoFile' where passportNum = '$passportNum' AND creationDate = '$currentCreationDate'");
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
        $departureSeal_path_filename_ext = $base_dir.$departureSeal_target_dir."departureSeal"."_".$passportNum.".".$departureSeal_ext;
        $departureFile = $departureSeal_target_dir."departureSeal"."_".$passportNum.".".$departureSeal_ext;
        $result = $conn->query("UPDATE passport set departureSeal = 'yes', departureSealFile = '$departureFile' where passportNum = '$passportNum' AND creationDate = '$currentCreationDate'");
        if($result){
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
        $arrivalSeal_path_filename_ext = $base_dir.$arrivalSeal_target_dir."arrivalSeal"."_".$passportNum.".".$arrivalSeal_ext;
        $arrivalFile = $arrivalSeal_target_dir."arrivalSeal"."_".$passportNum.".".$arrivalSeal_ext;
        $result = $conn->query("UPDATE passport set arrivalSeal = 'yes', arrivalSealFile = '$arrivalFile' where passportNum = '$passportNum' AND creationDate = '$currentCreationDate'");
        if($result){
            move_uploaded_file($arrivalSeal_temp_name,$arrivalSeal_path_filename_ext);
        }
    } 

    // Scanned passport file directory set - upload code inside result true if statement;
    if (($_FILES['oldVisaFile']['name'] != "")){
        // Where the file is going to be stored
        $oldVisa_target_dir = "uploads/oldVisa/";
        $file = $_FILES['oldVisaFile']['name'];
        $path = pathinfo($file);
        $oldVisa_ext = $path['extension'];
        $oldVisa_temp_name = $_FILES['oldVisaFile']['tmp_name'];
        $oldVisa_path_filename_ext = $base_dir.$oldVisa_target_dir."oldVisa"."_".$passportNum.".".$oldVisa_ext;
        $oldVisaFile = $oldVisa_target_dir."oldVisa"."_".$passportNum.".".$oldVisa_ext;
        $result = $conn->query("UPDATE passport set oldVisa = 'yes', oldVisaFile = '$oldVisaFile' where passportNum = '$passportNum' AND creationDate = '$currentCreationDate'");
        if($result){
            move_uploaded_file($oldVisa_temp_name,$oldVisa_path_filename_ext);
        }
    }

    $qry = "UPDATE passport SET passportNum = '$passportNum', fName='$fName',lName='$lName',mobNum='$mobNum',dob='$dob',gender='$gender',issueDate='$issuD',validity='$validityYear',departureDate='$departureDate',arrivalDate='$arrivalDate',country='$country',comment='$comment',updatedBy='$admin',updatedOn='$$update' where passport.passportNum='$currentPassport' AND passport.creationDate = '$currentCreationDate'";
    $result = mysqli_query($conn,$qry);
    if($result){

        echo "<script>window.alert('Updated')</script>";
        echo "<script> window.location.href='../index.php?page=listCandidate'</script>";
    }else{
        echo "<script>window.alert('Error')</script>";
        echo "<script> window.location.href='../index.php'</script>";
    }

}



