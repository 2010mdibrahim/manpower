<?php
include ('database.php');
$alter = $_POST['alter'];
$candidateId = $_POST['candidateId'];
if($alter == 'delete'){
    $qry = "DELETE FROM candidate WHERE candidate.candidateId = $candidateId";
    $rslt = mysqli_query($conn,$qry);
    if($rslt){
        echo "<script>window.alert('Deleted')</script>";
        echo "<script> window.location.href='../index.php?page=listCandidate'</script>";
    }else{
        echo "<script>window.alert('Error')</script>";
        echo "<script> window.location.href='../index.php'</script>";
    }
}else{
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $fathName = $_POST['fathName'];
    $mbNo = $_POST['mbNo'];
    $dob = $_POST['dob'];
    $pob = $_POST['pob'];
    $prof = $_POST['profId'];

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
    $qry = "UPDATE candidate SET fName='$fName',lName='$lName',fathName='$fathName',mob=$mbNo,dob='$dob',pob='$pob',profId=$prof,addrs='$add'
                 ,count='$count',state='$state',city='$city' WHERE candidateId = $candidateId";
    $rslt = mysqli_query($conn,$qry);
    if($rslt){
        echo "<script>window.alert('Updated')</script>";
        echo "<script> window.location.href='../index.php?page=listCandidate'</script>";
    }else{
        echo "<script>window.alert('Error')</script>";
        echo "<script> window.location.href='../index.php'</script>";
    }

}



