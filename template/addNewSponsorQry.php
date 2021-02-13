<?php
include ('database.php');
if(!empty($_POST['alter'])){
    $alter = $_POST['alter'];
}else{
    $alter = '';
}
if(!empty($_POST['sponsorId'])){
    $sponsorId = $_POST['sponsorId'];
}else{
    $agentId = '';
}
if($alter == 'delete') {
    $qry = "delete from sponsor where sponsorId = $sponsorId";
    $result = mysqli_query($conn, $qry);
    if ($result) {
        echo "<script>window.alert('Deleted')</script>";
        echo "<script> window.location.href='../index.php?page=sponsorList'</script>";
    } else {
        echo "<script>window.alert('Error')</script>";
        echo "<script> window.location.href='../index.php?page=sponsorList'</script>";
    }
}else {
    $admin = $_SESSION['email'];
    $sponsorName = $_POST['sponsorName'];
    $address = $_POST['address'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $phnNumber = $_POST['phnNumber'];
    $sponsorEmail = $_POST['sponsorEmail'];
    $sponsorVisa = $_POST['sponsorVisa'];
    $sponsorNid = $_POST['sponsorNid'];
    $date = date("Y-m-d");
    $qry = "select count(sponsorVisa) as visaCount from sponsor where sponsorVisa = '$sponsorVisa'";
    $result = mysqli_query($conn,$qry);
    $existingVisa = mysqli_fetch_assoc($result);
    $qry = "select count(sponsorNID) as nidCount from sponsor where sponsorNID = '$sponsorNid'";
    $result = mysqli_query($conn,$qry);
    $existingNid = mysqli_fetch_assoc($result);
//    echo $existingVisa['visaCount'];
//    echo $existingNid['nidCount'];
    if ($alter == 'update') {
        $qry = "UPDATE sponsor SET sponsorName='$sponsorName',sponsorVisa = '$sponsorVisa', sponsorNid = '$sponsorNid',address='$address',country='$country'
             ,city='$city',phone='$phnNumber',email='$sponsorEmail',updatedBy='$admin',updatedOn='$date' WHERE sponsorId=$sponsorId";
        $result = mysqli_query($conn, $qry);
        if ($result) {
            echo "<script>window.alert('Updated')</script>";
            echo "<script> window.location.href='../index.php?page=sponsorList'</script>";
        } else {
            echo "<script>window.alert('Error')</script>";
        }

    } else {
        if($existingVisa['visaCount'] == 0 && $existingNid['nidCount'] == 0){
            $qry = "INSERT INTO sponsor(sponsorName, sponsorVisa, sponsorNID, address, country, city, phone, email, status, updatedBy, updatedOn)
            VALUES ('$sponsorName','$sponsorVisa', '$sponsorNid','$address','$country','$city','$phnNumber','$sponsorEmail',1,'$admin','$date')";
            $result = mysqli_query($conn, $qry);
            if ($result) {
                echo "<script>window.alert('Inserted')</script>";
                echo "<script> window.location.href='../index.php?page=sponsorList'</script>";
            } else {
                echo "<script>window.alert('Error')</script>";
            }
        }else{
            echo "<script>window.alert('Visa or NID already exists')</script>";
            echo "<script> window.location.href='../index.php?page=addNewSponsor'</script>";
        }
    }

}
