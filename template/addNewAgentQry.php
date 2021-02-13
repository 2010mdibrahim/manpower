<?php
include ('database.php');
if(!empty($_POST['alter'])){
    $alter = $_POST['alter'];
}else{
    $alter = '';
}
if(!empty($_POST['agentId'])){
    $agentId = $_POST['agentId'];
}else{
    $agentId = '';
}
$admin = $_SESSION['email'];
$agentName = $_POST['agentName'];
$company = $_POST['company'];
$openAmount = $_POST['openAmount'];
$agentType = $_POST['agentType'];
$address = $_POST['address'];
$country= $_POST['country'];
$city = $_POST['city'];
$phnNumber = $_POST['phnNumber'];
$agentEmail = $_POST['agentEmail'];
$date = date("Y-m-d");
if($alter == 'delete') {
    $qry = "delete from agent where agentId = $agentId";
    $result = mysqli_query($conn, $qry);
    if ($result) {
        echo "<script>window.alert('Deleted')</script>";
        echo "<script> window.location.href='../index.php?page=agentList'</script>";
    } else {
        echo "<script>window.alert('Error')</script>";
    }
}else {
    if ($alter == 'update') {
        $qry = "UPDATE agent SET agentName='$agentName',company='$company',openBalance=$openAmount,agentType='$agentType'
               ,address='$address',country='$country',city='$city',phone='$phnNumber',email='$agentEmail',updatePerson='$admin',updatedOn='$date' 
                    WHERE agentId=$agentId";
        $result = mysqli_query($conn, $qry);
        if ($result) {
            echo "<script>window.alert('Updated')</script>";
            echo "<script> window.location.href='../index.php?page=agentList'</script>";
        } else {
            echo "<script>window.alert('Update Error')</script>";
        }
    } else {
        $qry = "INSERT INTO agent (agentName, company, openBalance, agentType, address, country, city, phone, email, status, updatePerson, updatedOn) 
        VALUES ('$agentName','$company',$openAmount,'$agentType','$address','$country','$city','$phnNumber','$agentEmail',1,'$admin','$date')";
        $result = mysqli_query($conn, $qry);
        if ($result) {
            echo "<script>window.alert('Inserted')</script>";
            echo "<script> window.location.href='../index.php?page=agentList'</script>";
        } else {
            echo "<script>window.alert('Error')</script>";
        }
    }
}

