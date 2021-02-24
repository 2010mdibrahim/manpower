<?php
include ('database.php');
if(!empty($_POST['alter'])){
    $alter = $_POST['alter'];
}else{
    $alter = '';
}
$sponsorName = $_POST['sponsorName'];
if($alter == 'delete') {
    $qry = "DELETE from sponsor where sponsorName = '$sponsorName'";
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
    $comment = $_POST['comment'];
    $date = date("Y-m-d");    
    if ($alter == 'Update') {
        $result = $conn->query("UPDATE sponsor SET comment = '$comment', updatedBy='$admin',updatedOn='$date' WHERE sponsorName='$sponsorName'");
        if ($result) {
            echo "<script>window.alert('Updated')</script>";
            echo "<script> window.location.href='../index.php?page=sponsorList'</script>";
        } else {
            echo "<script>window.alert('Error')</script>";
            echo "<script> window.location.href='../index.php?page=sponsorList'</script>";
        }

    } else {
        $sponsorCount = mysqli_fetch_assoc($conn -> query("SELECT count(sponsorName) as sponsorCount from sponsor where sponsorName = '$sponsorName'"));
        if($sponsorCount['sponsorCount'] == 0){
            $result = $conn->query("INSERT INTO sponsor(sponsorName, comment, updatedBy, updatedOn) VALUES ('$sponsorName','$comment','$admin','$date')");
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
