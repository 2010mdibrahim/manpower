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
    $delegateOfficeId = $_POST['delegateOfficeId'];
    $sponsorName = $_POST['sponsorName'];
    $admin = $_SESSION['email'];
    $comment = $_POST['comment'];
    $date = date("Y-m-d");    
    if ($alter == 'update') {
        $result = $conn->query("UPDATE sponsor SET sponsorName = '$sponsorName', comment = '$comment', updatedBy='$admin',updatedOn='$date', delegateOfficeId = $delegateOfficeId WHERE sponsorNID = '$sponsorNid'");
        if ($result) {
            echo "<script>window.alert('Updated')</script>";
            echo "<script> window.location.href='../index.php?page=sponsorList'</script>";
        } else {
            echo "<script>window.alert('Error')</script>";
            print_r(mysqli_error($conn));
        }
    } else {
        $delegateId = $_POST['delegateId'];
        $curdate = date("Y/m/d H:i:s");
        $creationDate = date("Y-m-d h:i:s", strtotime('+3 hours', strtotime($curdate)));
        $sponsorCount = mysqli_fetch_assoc($conn -> query("SELECT count(sponsorNID) as sponsorCount from sponsor where sponsorNID = '$sponsorNid'"));
        if($sponsorCount['sponsorCount'] == 0){
            $result = $conn->query("INSERT INTO sponsor(sponsorNID, sponsorName, comment, delegateOfficeId, updatedBy, updatedOn, creationDate) VALUES ('$sponsorNid', '$sponsorName','$comment', $delegateOfficeId,'$admin','$date','$creationDate')");
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
