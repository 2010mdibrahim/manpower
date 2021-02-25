<?php
include ('database.php');
if(!empty($_POST['alter'])){
    $alter = $_POST['alter'];
}else{
    $alter = '';
}
$agentEmail = $_POST['agentEmail'];

//$agentType = $_POST['agentType'];
//$address = $_POST['address'];
//$country= $_POST['country'];
//$city = $_POST['city'];
//$phnNumber = $_POST['phnNumber'];
//$agentEmail = $_POST['agentEmail'];
//$date = date("Y-m-d");
if($alter == 'delete') {
    $qry = "DELETE from agent where agentEmail = '$agentEmail'";
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
    $agentPhone = $_POST['agentPhone'];
    $comment = $_POST['comment'];
    $date = date("Y-m-d");

    if (($_FILES['agentImage']['name'] != "")){
        // Where the file is going to be stored
        $base_dir = "C:/xampp/htdocs/mahfuza/";
        $photo_target_dir = "uploads/agent/agentPhoto/";
        $file = $_FILES['agentImage']['name'];
        $path = pathinfo($file);
        $photo_ext = $path['extension'];
        $photo_temp_name = $_FILES['agentImage']['tmp_name'];
        $photo_path_filename_ext = $base_dir.$photo_target_dir."photo_".$agentEmail.".".$photo_ext;
    }
    if (($_FILES['agentPassport']['name'] != "")){
        // Where the file is going to be stored
        $base_dir = "C:/xampp/htdocs/mahfuza/";
        $passport_target_dir = "uploads/agent/agentPassport/";
        $file = $_FILES['agentImage']['name'];
        $path = pathinfo($file);
        $passport_ext = $path['extension'];
        $passport_temp_name = $_FILES['agentImage']['tmp_name'];
        $passport_path_filename_ext = $base_dir.$passport_target_dir."passport_".$agentEmail.".".$passport_ext;
    }
    if (($_FILES['agentPolice']['name'] != "")){
        // Where the file is going to be stored
        $base_dir = "C:/xampp/htdocs/mahfuza/";
        $police_target_dir = "uploads/agent/agentPolice/";
        $file = $_FILES['agentImage']['name'];
        $path = pathinfo($file);
        $police_ext = $path['extension'];
        $police_temp_name = $_FILES['agentImage']['tmp_name'];
        $police_path_filename_ext = $base_dir.$police_target_dir."police_".$agentEmail.".".$police_ext;
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
                move_uploaded_file($photo_temp_name,$photo_path_filename_ext);
            }
            if (($_FILES['agentPassport']['name'] != "")){
                move_uploaded_file($passport_temp_name,$passport_path_filename_ext);
            }
            if (($_FILES['agentPolice']['name'] != "")){
                move_uploaded_file($police_temp_name,$police_path_filename_ext);
            }
            echo "<script>window.alert('Updated')</script>";
            // echo "<script> window.location.href='../index.php?page=agentList'</script>";
        } else {
            echo "<script>window.alert('Update Error')</script>";
        }
    } else {
        $photo = $photo_target_dir.$agentEmail."photo_".$photo_ext;
        $passport = $passport_target_dir."passport_".$agentEmail.".".$passport_ext;
        $police = $police_target_dir."police_".$agentEmail.".".$police_ext;
        $qry = "INSERT INTO agent (agentEmail, agentName, agentPhone, agentPhoto, agentPassport, agentPoliceClearance, comment, updatedBy, updatedOn)
                VALUES ('$agentEmail','$agentName','$agentPhone','$photo','$passport','$police','$comment','$admin','$date')";
        $result = mysqli_query($conn, $qry);
        if ($result) {
            if (($_FILES['agentImage']['name'] != "")){
                move_uploaded_file($photo_temp_name,$photo_path_filename_ext);
            }
            if (($_FILES['agentPassport']['name'] != "")){
                move_uploaded_file($passport_temp_name,$passport_path_filename_ext);
            }
            if (($_FILES['agentPolice']['name'] != "")){
                move_uploaded_file($police_temp_name,$police_path_filename_ext);
            }
            echo "<script>window.alert('Inserted')</script>";
            // echo "<script> window.location.href='../index.php?page=agentList'</script>";
        } else {
            echo "<script>window.alert('Email Already Exists')</script>";
            echo "<script> window.location.href='../index.php?page=addNewAgent'</script>";
        }
    }
}

