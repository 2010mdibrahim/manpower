<?php 
include ('database.php');
if(isset($_POST['addDelegate'])){
    if(isset($_POST['alter'])){
        $alter = $_POST['alter'];
    }else{
        $alter = '';
    }

    if(isset($_POST['delegateId'])){
        $delegateId = $_POST['delegateId'];
    }else{
        $delegateId = '';
    }

    if($alter == 'delete'){
        $result = $conn->query("DELETE from delegate where delegateId = $delegateId");
        if ($result) {
            echo "<script>window.alert('Deleted')</script>";
            echo "<script> window.location.href='../index.php?page=delegateList'</script>";
        } else {
            echo "<script>window.alert('Error')</script>";
        }
    }else{
        $delegateName = $_POST['delegateName'];
        $delegateOffice = $_POST['delegateOffice'];
        $delegateCountry = $_POST['delegateCountry'];
        $delegateState = $_POST['delegateState'];
        $comment = $_POST['comment'];
       
        $date = date("Y-m-d");
        $admin = $_SESSION['email'];
        if($alter == 'update'){
            $result = $conn->query("UPDATE delegate SET delegateName='$delegateName',country='$delegateCountry',delegateState='$delegateState',office='$delegateOffice',updatedBy='$admin',updatedOn='$date',comment='$comment' where delegateId = $delegateId");
            if ($result) {
                echo "<script>window.alert('Updated')</script>";
                echo "<script> window.location.href='../index.php?page=delegateList'</script>";
            } else {
                echo "<script>window.alert('Error')</script>";
            }
        }else{
            $creationDate = date("Y-m-d h:s:i");
            $exists = mysqli_fetch_assoc($conn->query("SELECT count(delegateId) as countId from delegate where delegateName = '$delegateName' AND country = '$delegateCountry' AND delegateState = '$delegateState'"));
            if($exists['countId'] == 0){
                $result = $conn->query("INSERT INTO delegate(delegateName, country, delegateState, office, creationDate, updatedBy, updatedOn, comment) VALUES ('$delegateName','$delegateCountry','$delegateState', '$delegateOffice', '$creationDate', '$admin', '$date', '$comment')");
                if ($result) {
                    echo "<script>window.alert('Added')</script>";
                    echo "<script> window.location.href='../index.php?page=delegateList'</script>";
                } else {
                    echo "<script>window.alert('Error')</script>";
                }
            }else{
                echo "<script>window.alert('Delegate For This State Already Exists')</script>";
                echo "<script> window.location.href='../index.php?page=addNewDelegate'</script>";
            }
        }
        
    }
    
}