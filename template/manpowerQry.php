<?php
include ("database.php");
if(isset($_POST['manpower'])){
    if(isset($_POST['alter'])){
        $alter = $_POST['alter'];
    }else{
        $alter = '';
    }
    $officeName = $_POST['officeName'];
    if($alter == 'delete'){
        $result = $conn -> query("DELETE from manpoweroffice where manpowerOfficeName = '$officeName'");
        if($result){
            echo "<script>window.alert('Deleted')</script>";
            echo "<script> window.location.href='../index.php?page=manpowerList'</script>";
        }else{
            echo "<script>window.alert('Error')</script>";
            echo "<script> window.location.href='../index.php?page=manpowerList'</script>";
        } 
    }else{        
        $comment = $_POST['comment'];
        $admin = $_SESSION['email'];
        $date = date("Y-m-d");
        $existingOffice = mysqli_fetch_assoc($conn -> query("SELECT count(manpowerOfficeName) as officeCount from manpoweroffice where manpowerOfficeName = '$officeName'"));
        if($existingOffice['officeCount'] == 0){
            $result = $conn->query("INSERT INTO manpoweroffice(manpowerOfficeName, comment, updatedBy, updatedOn) 
                                    VALUES ('$officeName', '$comment', '$admin', '$date')");
            if($result){
                echo "<script>window.alert('Saved')</script>";
                echo "<script> window.location.href='../index.php?page=manpowerList'</script>";
            }else{
                echo "<script>window.alert('Error')</script>";
                echo "<script> window.location.href='../index.php?page=manpowerList'</script>";
            }                       
        }else{
            echo "<script>window.alert('Office Name already exists')</script>";
            echo "<script> window.location.href='../index.php?page=manpowerList'</script>";
        }
    }     
}
?>