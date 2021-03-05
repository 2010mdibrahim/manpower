<?php
include ('database.php');
$alter = $_POST['alter'];
$passportNum = $_POST['passportNum'];
if($alter == 'delete'){
    $result = $conn -> query("DELETE FROM passport WHERE passportNum = '$passportNum'");
    if($result){
        echo "<script>window.alert('Deleted')</script>";
        echo "<script> window.location.href='../index.php?page=listCandidate'</script>";
    }else{
        echo "<script>window.alert('Error')</script>";
        echo "<script> window.location.href='../listCandidate.php'</script>";
    }
}else{
    $currentPassport = $_POST['currentPassport'];
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
    $curdate = date("Y/m/d h:i:s");
    $date = date("Y-m-d h:i:s", strtotime('+3 hours', strtotime($curdate)));
    $update = date("Y/m/d");

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
    }

    if (($_FILES['policeVerificationFile']['name'] != "")){
        $policeFile = $target_dir."policeVerification"."_".$passportNum.".".$ext;
        $result = $conn->query("UPDATE passport set policeClearance = 'yes', policeClearanceFile = '$policeFile' where passportNum = '$passportNum'");
        if (($_FILES['policeVerificationFile']['name'] != "")){
            move_uploaded_file($temp_name,$path_filename_ext);
        }
    }

    if (($_FILES['photoFile']['name'] != "")){
        $photoFile = $target_dir_photo."photo"."_".$passportNum.".".$photo_ext; 
        $result = $conn->query("UPDATE passport set passportPhoto = 'yes', passportPhotoFile = '$photoFile' where passportNum = '$passportNum'");
        if (($_FILES['photoFile']['name'] != "")){
            move_uploaded_file($photo_temp_name,$photo_path_filename_ext);
        }
    }

    if (($_FILES['passportScan']['name'] != "")){
        $passportFile = $passport_target_dir."passport"."_".$passportNum.".".$passport_ext; 
        $result = $conn->query("UPDATE passport set passportScannedCopy = '$photoFile' where passportNum = '$passportNum'");
    } 

    $qry = "UPDATE passport SET passportNum = '$passportNum', fName='$fName',lName='$lName',mobNum='$mobNum',dob='$dob',gender='$gender',issueDate='$issuD',validity='$validityYear',departureDate='$departureDate',arrivalDate='$arrivalDate',country='$country',comment='$comment',updatedBy='$admin',updatedOn='$date' where passport.passportNum='$currentPassport'";
    $result = mysqli_query($conn,$qry);
    if($result){

        echo "<script>window.alert('Updated')</script>";
        echo "<script> window.location.href='../index.php?page=listCandidate'</script>";
    }else{
        echo "<script>window.alert('Error')</script>";
        echo "<script> window.location.href='../index.php'</script>";
    }

}



