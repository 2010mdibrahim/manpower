<?php
include ("database.php");
if(isset($_POST['manpower'])){
    $officeName = $_POST['officeName'];
    $comment = $_POST['comment'];
    $admin = $_SESSION['email'];
    $date = date("Y-m-d");
    $existingOffice = $conn -> query("SELECT count(manpowerOfficeName) as officeCount from manpoweroffice where manpowerOfficeName = '$officeName'");
    if($existingOffice['officeCount'] == 0){
        $result = $conn->query("INSERT INTO manpoweroffice(manpowerOfficeName, comment, updatedBy, updatedOn) 
                                VALUES ('$officeName', '$comment', '$admin', '$date')");
        if($result){
            echo "<script>window.alert('Saved')</script>";
            // echo "<script> window.location.href='../index.php?page=allVisaList'</script>";
        }else{
            echo "<script>window.alert('Error')</script>";
            // echo "<script> window.location.href='../index.php?page=allVisaList'</script>";
        }                       
    }else{
        echo "<script>window.alert('Office Name already exists')</script>";
        echo "<script> window.location.href='../index.php?page=allVisaList'</script>";
    } 
}
?>