<?php
include ('database.php');
if(!empty($_POST['alter'])){
    $alter = $_POST['alter'];
}else{
    $alter = '';
}
$sponsorNid = $_POST['sponsorNid'];
if($alter == 'delete') {
    $result = $conn->query("DELETE from sponsor where sponsorNID = '$sponsorNid'");
    if ($result) {
        echo "<script>window.alert('Deleted')</script>";
        echo "<script> window.location.href='../index.php?page=sponsorList'</script>";
    } else {
        echo "<script>window.alert('Error')</script>";
        echo "<script> window.location.href='../index.php?page=sponsorList'</script>";
    }
}else{
    $delegateId = $_POST['delegateId'];
    $sponsorName = $_POST['sponsorName'];
    $admin = $_SESSION['email'];
    $comment = $_POST['comment'];
    $date = date("Y-m-d");    
    if ($alter == 'update') {
        $result = $conn->query("UPDATE sponsor SET sponsorName = '$sponsorName', comment = '$comment', updatedBy='$admin',updatedOn='$date', delegateId = $delegateId WHERE sponsorNID = '$sponsorNid'");
        if ($result) {
            echo "<script>window.alert('Updated')</script>";
            echo "<script> window.location.href='../index.php?page=sponsorList'</script>";
        } else {
            echo "<script>window.alert('Error')</script>";
            echo "<script> window.location.href='../index.php?page=sponsorList'</script>";
        }

    } else {
        $creationDate = date("Y-m-d h:i:s");
        $sponsorCount = mysqli_fetch_assoc($conn -> query("SELECT count(sponsorNID) as sponsorCount from sponsor where sponsorNID = '$sponsorNid'"));
        if($sponsorCount['sponsorCount'] == 0){
            $result = $conn->query("INSERT INTO sponsor(sponsorNID, sponsorName, comment, delegateId, updatedBy, updatedOn, creationDate) VALUES ('$sponsorNid', '$sponsorName','$comment', $delegateId,'$admin','$date','$creationDate')");
            if ($result) {
                echo "<script>window.alert('Inserted')</script>";
                echo "<script> window.location.href='../index.php?page=sponsorList'</script>";
            } else {
                echo "<script>window.alert('Error')</script>";
            }
        }else{
                echo "<script>window.alert('Sponsor Already Exists')</script>";
                echo "<script> window.location.href='../index.php?page=sponsorList'</script>";
        }
    }

}
