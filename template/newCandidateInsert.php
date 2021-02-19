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
print_r($dob);
$admin = $_SESSION['email'];
$date = date("Y-m-d H:i:s");
// print_r()
$existingPass = mysqli_fetch_assoc($conn->query("select count(passportNum) as passCount from passport where passportNum = '$passportNum'"));
if($existingPass['passCount'] > 0){
    echo "<script>window.alert('Passport Already Exists')</script>";
    echo "<script> window.location.href='../index.php?page=newCandidate'</script>";
}else{
//    $qry = "INSERT INTO passport(passportNum, fName, lName, mobNum, gender, issueDate, expiryDate, departureDate, arrivalDate, policeClearance, country, musanadEntry, passportPhoto, comment, updatedBy, updatedOn)
//             VALUES ('$passportNum', '$fName', '$lName', '$mobNum', '$gender', '$issuD', '$expD', '$departureDate', '$arrivalDate', '$policeVerification', '$country', '$photo', '$comment', '$admin', '$date')";
//     mysqli_query($conn,"START TRANSACTION");
    $result = $conn->query("INSERT INTO passport(passportNum, fName, lName, mobNum, dob, gender, issueDate, expiryDate, departureDate,
                     arrivalDate, policeClearance, passportPhoto, agentEmail, country, comment, updatedBy, updatedOn)
                    VALUES('$passportNum','$fName','$lName','$mobNum','$dob','$gender','$issuD','$expD','$departureDate','$arrivalDate',
                    '$policeVerification','$photo', '$agentEmail','$country','$comment','$admin','$date')");
    if($result){
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



