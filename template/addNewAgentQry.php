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

//$agentType = $_POST['agentType'];
//$address = $_POST['address'];
//$country= $_POST['country'];
//$city = $_POST['city'];
//$phnNumber = $_POST['phnNumber'];
//$agentEmail = $_POST['agentEmail'];
//$date = date("Y-m-d");
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
    $admin = $_SESSION['email'];
    $agentName = $_POST['agentName'];
    $agentEmail = $_POST['agentEmail'];
    $agentPhone = $_POST['agentPhone'];
    $comment = $_POST['comment'];
    $date = date("Y-m-d");
    $path_filename_ext = '';
    $temp_name = '';
    $target_dir = '';
    $ext = '';
    if (($_FILES['agentImage']['name'] != "")){
        // Where the file is going to be stored
        $base_dir = "C:/xampp/htdocs/mahfuza/";
        $target_dir = "uploads/";
        $file = $_FILES['agentImage']['name'];
        $path = pathinfo($file);
        $ext = $path['extension'];
        $temp_name = $_FILES['agentImage']['tmp_name'];
        $path_filename_ext = $base_dir.$target_dir.$agentEmail.".".$ext;
    }
    if ($alter == 'update') {        
        $photo = $target_dir.$agentEmail.'.'.$ext;
        if (($_FILES['agentImage']['name'] != "")){
            $qry = "UPDATE agent SET agentEmail='$agentEmail',agentName='$agentName',agentPhone='$agentPhone',agentPhoto ='$photo', comment='$comment'
               ,updatedBy='$admin',updatedOn='$date'
                WHERE agentEmail='$agentEmail'";
        }else{
            $qry = "UPDATE agent SET agentEmail='$agentEmail',agentName='$agentName',agentPhone='$agentPhone', comment='$comment'
               ,updatedBy='$admin',updatedOn='$date'
                WHERE agentEmail='$agentEmail'";
        }
        
        $result = mysqli_query($conn, $qry);
        if ($result) {
            if (($_FILES['agentImage']['name'] != "")){
                move_uploaded_file($temp_name,$path_filename_ext);
            }
            echo "<script>window.alert('Updated')</script>";
            echo "<script> window.location.href='../index.php?page=agentList'</script>";
        } else {
            echo "<script>window.alert('Update Error')</script>";
        }
    } else {
        $photo = $target_dir.$agentEmail.'.'.$ext;
        $qry = "INSERT INTO agent (agentEmail, agentName, agentPhone, agentPhoto, comment, updatedBy, updatedOn)
                VALUES ('$agentEmail','$agentName','$agentPhone','$photo','$comment','$admin','$date')";
        $result = mysqli_query($conn, $qry);
        if ($result) {
            if (($_FILES['agentImage']['name']!="")){
                move_uploaded_file($temp_name,$path_filename_ext);
            }
            echo "<script>window.alert('Inserted')</script>";
            echo "<script> window.location.href='../index.php?page=agentList'</script>";
        } else {
            echo "<script>window.alert('Email Already Exists')</script>";
            echo "<script> window.location.href='../index.php?page=addNewAgent'</script>";
        }
    }
}

