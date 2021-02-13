<?php
include ('database.php');
$alter = $_POST['alter'];
$visaId = $_POST['visaId'];
if($alter == 'update'){
    $name = $_POST['name'];
    $date = $_POST['date'];
    $type = $_POST['type'];
    $pos = $_POST['pos'];
    $bSal = $_POST['bSalary'];
    $tSal = $_POST['tSalary'];
    $sponsorId = $_POST['sponsorId'];
    $agent = $_POST['agent'];
    $admin = $_SESSION['email'];
    $updatedDate = date("Y-m-d");
    $qry = "UPDATE visainfo SET name='$name',date='$date',type='$type',position='$pos',bSalary=$bSal,tSalary=$tSal
                  ,visaIssuAgent=$agent,visaSponsorId=$sponsorId,updatedBy='$admin',updatedOn='$updatedDate'
                        WHERE visaId=$visaId";
    $result = mysqli_query($conn,$qry);
    if($result)
    {
        echo "<script> window.alert('Updated')</script>";
        echo "<script> window.location.href='../index.php?page=visaList'</script>";
    }
    else{
        echo 'something went wrong!';
    }
}else{
    $qry = "delete from visainfo WHERE visainfo.visaId=$visaId";
    $rslt = mysqli_query($conn,$qry);
    if($rslt)
    {
        echo "<script> window.alert('Deleted')</script>";
        echo "<script> window.location.href='../index.php?page=visaList'</script>";
    }
    else{
        echo 'something went wrong!';
    }
}
