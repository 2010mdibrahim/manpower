<?php
include ('database.php');
$fName = $_POST['fName'];
$lName = $_POST['lName'];
$gender = $_POST['gender'];
$mobNum = $_POST['mobNum'];
$passportNum= $_POST['passportNum'];
$issuD = $_POST['issuD'];
$country = $_POST['country'];
$expD = $_POST['expD'];
$departureDate = $_POST['departureDate'];
$arrivalDate = $_POST['arrivalDate'];
$policeVerification = $_POST['policeVerification'];
$photo = $_POST['photo'];
$agentEmail = $_POST['agentEmail'];
$comment = $_POST['comment'];
$dob = $_POST['dob'];
$admin = $_SESSION['email'];
$date = date("Y-m-d H:i:s");


$path_filename_ext = '';
$temp_name = '';
$target_dir = '';
$ext = '';
if (($_FILES['policeVerification']['name'] != "")){
    // Where the file is going to be stored
    $base_dir = "C:/xampp/htdocs/mahfuza/";
    $target_dir = "uploads/policeVerification/";
    $file = $_FILES['policeVerification']['name'];
    $path = pathinfo($file);
    $ext = $path['extension'];
    $temp_name = $_FILES['policeVerification']['tmp_name'];
    $path_filename_ext = $base_dir.$target_dir."policeVerification"."-".$passportNum.".".$ext;
}

$path_photofilename_ext = '';
$photo_temp_name = '';
$photo_target_dir = '';
$photo_ext = '';
if (($_FILES['photoFile']['name'] != "")){
    // Where the file is going to be stored
    $base_dir = "C:/xampp/htdocs/mahfuza/";
    $target_dir_photo = "uploads/photo/";
    $file_photo = $_FILES['photoFile']['name'];
    $path_photo = pathinfo($file_photo);
    $photo_ext = $path_photo['extension'];
    $photo_temp_name = $_FILES['photoFile']['tmp_name'];
    $path_photofilename_ext = $base_dir.$target_dir_photo."photo"."-".$passportNum.".".$photo_ext;
}
$existingPass = mysqli_fetch_assoc($conn->query("select count(passportNum) as passCount from passport where passportNum = '$passportNum'"));
if($existingPass['passCount'] > 0){
    echo "<script>window.alert('Passport Already Exists')</script>";
    echo "<script> window.location.href='../index.php?page=newCandidate'</script>";
}else{
    $policeFile = $target_dir."policeVerification"."-".$passportNum.".".$ext;
    $photoFile = $target_dir_photo."photo"."-".$passportNum.".".$photo_ext; 
    $result = $conn->query("INSERT INTO passport(passportNum, fName, lName, mobNum, dob, gender, issueDate, expiryDate, departureDate,
                     arrivalDate, policeClearance, policeClearanceFile, passportPhoto, passportPhotoFile, agentEmail, country,musanadReady, musanadEntry, comment, updatedBy, updatedOn, creationDate)
                    VALUES('$passportNum','$fName','$lName','$mobNum','$dob','$gender','$issuD','$expD','$departureDate','$arrivalDate',
                    '$policeVerification', '$policeFile', '$photo', '$photoFile', '$agentEmail','$country', 'no', 'no','$comment','$admin','$date', '$date')");
    if($result){
        if (($_FILES['policeVerification']['name'] != "")){
            move_uploaded_file($temp_name,$path_filename_ext);
        }
        if (($_FILES['photoFile']['name'] != "")){
            move_uploaded_file($photo_temp_name,$path_photofilename_ext);
        }
        echo "<script>window.alert('Inserted')</script>";
        echo "<script> window.location.href='../index.php?page=listCandidate'</script>";
    }else{
        echo "<script>window.alert('Failed')</script>";
        echo "<script> window.location.href='../index.php?page=newCandidate'</script>";
    }
}


    // $a1 = mysqli_query($conn,"INSERT INTO candidate (fName, lName, fathName, mob, dob, pob, profId, addrs, count, state, city) VALUES ('$fName','$lName','$fathName','$mbNo','$dob','$pob',$profId,'$add','$count','$state','$city')");
    // $qry = "select max(candidateId) as lastCandidate from candidate";
    // $result = mysqli_query($conn, $qry);
    // $tmp = mysqli_fetch_assoc($result);
    // $lastId = $tmp['lastCandidate'];
    // $a2 = mysqli_query($conn,"INSERT INTO passport (passNo, issuPlace, issuDate, expDate, type, candidateId) VALUES ('$passNo','$issuPlace','$issuDate','$expDate','$type',$lastId)");
    // if ($a1 and $a2) {
    //     mysqli_query($conn,"COMMIT");
    //     echo "<script>window.alert('Saved')</script>";
    //     echo "<script> window.location.href='../index.php?page=listCandidate'</script>";
    // } else {
    //     mysqli_query($conn,"ROLLBACK");
    //     echo "<script>window.alert('Error')</script>";
    //     echo "<script> window.location.href='../index.php?page=newCandidate'</script>";
    // }
//    try {
//        // First of all, let's begin a transaction
//        $qry->beginTransaction();
//
//        // A set of queries; if one fails, an exception should be thrown
//        $qry->query("INSERT INTO candidate (fName, lName, fathName, mob, dob, pob, profId, addrs, count, state, city) VALUES ('$fName','$lName','$fathName','$mbNo','$dob','$pob',$profId,'$add','$count','$state','$city')");
//        $last_id = $qry->insert_id;
//        $qry->query("INSERT INTO passport (passNo, issuPlace, issuDate, expDate, type, candidateId) VALUES ('$passNo','$issuPlace','$issuDate','$expDate','$type',$last_id)");
//        // If we arrive here, it means that no exception was thrown
//        // i.e. no query has failed, and we can commit the transaction
//        $qry->commit();
//        echo "<script>window.alert('Saved')</script>";
//        echo "<script> window.location.href='../index.php?page=newCandidate'</script>";
//    } catch (\Throwable $e) {
//        // An exception has been thrown
//        // We must rollback the transaction
//        $qry->rollback();
//
//        echo "<script>window.alert(".$e->getMessage().")</script>";
//        echo "<script> window.location.href='../index.php'</script>";
//    }
//    $rslt = mysqli_query($conn,$qry);
//    if($rslt){
//        $qry = "select candidateId from candidate where mob = $mbNo";
//        $result = mysqli_query($conn,$qry);
//        $candidate = mysqli_fetch_assoc($result);
//        $candidateId = $candidate['candidateId'];
//        $qry = "INSERT INTO passport VALUES ('$passNo','$issuPlace','$issuDate','$expDate','$type',$candidateId)";
//        $result = mysqli_query($conn,$qry);
//        echo "<script>window.alert('Saved')</script>";
//        echo "<script> window.location.href='../index.php?page=newCandidate'</script>";
//    }else{
//        echo "<script>window.alert('Error')</script>";
//        echo "<script> window.location.href='../index.php'</script>";
//    }
// }



