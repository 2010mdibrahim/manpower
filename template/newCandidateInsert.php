<?php
include ('database.php');
$fName = $_POST['fName'];
$lName = $_POST['lName'];
$fathName = $_POST['fathName'];
$mbNo = $_POST['mbNo'];
$dob = $_POST['dob'];
$pob = $_POST['pob'];
$profId = $_POST['professionId'];

// Address Information
$add = $_POST['add'];
$count = $_POST['count'];
$state = $_POST['state'];
$city = $_POST['city'];

// Passport Information
$passNo = $_POST['passNo'];
$issuPlace = $_POST['issuP'];
$issuDate = $_POST['issuD'];
$expDate = $_POST['expD'];
$type = $_POST['type'];
$qry = "select count(mob) as mobCount from candidate where mob = '$mbNo'";
$result = mysqli_query($conn,$qry);
$existingMob = mysqli_fetch_assoc($result);
$qry = "select count(passNo) as passCount from passport where passNo = '$passNo'";
$result = mysqli_query($conn,$qry);
$existingPass = mysqli_fetch_assoc($result);
if($existingMob['mobCount'] > 0){
    echo "<script>window.alert('Mobile Already Exists')</script>";
    echo "<script> window.location.href='../index.php?page=newCandidate'</script>";
}else if($existingPass['passCount'] > 0){
    echo "<script>window.alert('Passport Already Exists')</script>";
    echo "<script> window.location.href='../index.php?page=newCandidate'</script>";
}else{
//    $qry = "INSERT INTO candidate (fName, lName, fathName, mob, dob, pob, profId, addrs, count, state, city)
//            VALUES ('$fName','$lName','$fathName','$mbNo','$dob','$pob',$profId,'$add','$count','$state','$city')";
    mysqli_query($conn,"START TRANSACTION");

    $a1 = mysqli_query($conn,"INSERT INTO candidate (fName, lName, fathName, mob, dob, pob, profId, addrs, count, state, city) VALUES ('$fName','$lName','$fathName','$mbNo','$dob','$pob',$profId,'$add','$count','$state','$city')");
    $qry = "select max(candidateId) as lastCandidate from candidate";
    $result = mysqli_query($conn, $qry);
    $tmp = mysqli_fetch_assoc($result);
    $lastId = $tmp['lastCandidate'];
    $a2 = mysqli_query($conn,"INSERT INTO passport (passNo, issuPlace, issuDate, expDate, type, candidateId) VALUES ('$passNo','$issuPlace','$issuDate','$expDate','$type',$lastId)");
    if ($a1 and $a2) {
        mysqli_query($conn,"COMMIT");
        echo "<script>window.alert('Saved')</script>";
        echo "<script> window.location.href='../index.php?page=listCandidate'</script>";
    } else {
        mysqli_query($conn,"ROLLBACK");
        echo "<script>window.alert('Error')</script>";
        echo "<script> window.location.href='../index.php?page=newCandidate'</script>";
    }
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
}



