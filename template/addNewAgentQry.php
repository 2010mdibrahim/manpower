<?php
include ('database.php');
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Agent", $_SESSION['sections'])){
            if (headers_sent()) {
                die("No Access");
            }else{
                header("Location: ../index.php");
                exit();
            } 
        }        
    }
}
if(!empty($_POST['alter'])){
    $alter = $_POST['alter'];
}else{
    $alter = '';
}
$agentEmail = $_POST['agentEmail'];
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
        $photo_target_dir = "uploads/agent/agentPhoto/";
        $file = $_FILES['agentImage']['name'];
        $path = pathinfo($file);
        $photo_ext = $path['extension'];
        $photo_temp_name = $_FILES['agentImage']['tmp_name'];
        $photo_path_filename_ext = $base_dir.$photo_target_dir."photo_".$agentEmail.".".$photo_ext;
    }
    if (($_FILES['agentPassport']['name'] != "")){
        // Where the file is going to be stored
        $passport_target_dir = "uploads/agent/agentPassport/";
        $file = $_FILES['agentPassport']['name'];
        $path = pathinfo($file);
        $passport_ext = $path['extension'];
        $passport_temp_name = $_FILES['agentPassport']['tmp_name'];
        $passport_path_filename_ext = $base_dir.$passport_target_dir."passport_".$agentEmail.".".$passport_ext;
    }
    if (($_FILES['agentPolice']['name'] != "")){
        // Where the file is going to be stored
        $police_target_dir = "uploads/agent/agentPolice/";
        $file = $_FILES['agentPolice']['name'];
        $path = pathinfo($file);
        $police_ext = $path['extension'];
        $police_temp_name = $_FILES['agentPolice']['tmp_name'];
        $police_path_filename_ext = $base_dir.$police_target_dir."police_".$agentEmail.".".$police_ext;
    }
    if ($alter == 'update') {        
        
        $qry = $conn->query("UPDATE agent SET agentName='$agentName',agentPhone='$agentPhone', comment='$comment' ,updatedBy='$admin',updatedOn='$date' WHERE agentEmail='$agentEmail'");
        if (($_FILES['agentImage']['name'] != "")){        
            $photo = $photo_target_dir."photo_".$agentEmail.".".$photo_ext;
            $qry = $conn->query("UPDATE agent SET agentPhoto = '$photo' WHERE agentEmail='$agentEmail'");
            if($qry){
                move_uploaded_file($photo_temp_name,$photo_path_filename_ext);
            }
        }
        if (($_FILES['agentPassport']['name'] != "")){
            $passport = $passport_target_dir."passport_".$agentEmail.".".$passport_ext;
            $qry = $conn->query("UPDATE agent SET agentPassport = '$passport' WHERE agentEmail='$agentEmail'");
            if($qry){
                move_uploaded_file($passport_temp_name,$passport_path_filename_ext);
            }
        }
        if (($_FILES['agentPolice']['name'] != "")){
            $police = $police_target_dir."police_".$agentEmail.".".$police_ext;
            $qry = $conn->query("UPDATE agent SET agentPoliceClearance = '$police' WHERE agentEmail='$agentEmail'");
            if($qry){
                move_uploaded_file($police_temp_name,$police_path_filename_ext);
            }
        }   

        if ($qry) {
            echo "<script>window.alert('Updated')</script>";
            echo "<script> window.location.href='../index.php?page=agentList'</script>";
        } else {
            echo "<script>window.alert('Update Error')</script>";
        }
    } else {
        $photo = $photo_target_dir."photo_".$agentEmail.".".$photo_ext;
        $passport = $passport_target_dir."passport_".$agentEmail.".".$passport_ext;
        $police = $police_target_dir."police_".$agentEmail.".".$police_ext;
        $creatDate = date("Y-m-d h:i:s");
        $qry = "INSERT INTO agent (agentEmail, agentName, agentPhone, agentPhoto, agentPassport, agentPoliceClearance, comment, updatedBy, updatedOn, creationDate)
                VALUES ('$agentEmail','$agentName','$agentPhone','$photo','$passport','$police','$comment','$admin','$date','$creatDate')";
        $result = mysqli_query($conn, $qry);
        if ($result) {
            if (($_FILES['agentImage']['name'] != "")){
                print_r("entered");
                move_uploaded_file($photo_temp_name,$photo_path_filename_ext);
            }
            if (($_FILES['agentPassport']['name'] != "")){
                move_uploaded_file($passport_temp_name,$passport_path_filename_ext);
            }
            if (($_FILES['agentPolice']['name'] != "")){
                move_uploaded_file($police_temp_name,$police_path_filename_ext);
            }
            echo "<script>window.alert('Inserted')</script>";
            echo "<script> window.location.href='../index.php?page=agentList'</script>";
        } else {
            echo "<script>window.alert('Email Already Exists')</script>";
            echo "<script> window.location.href='../index.php?page=addNewAgent'</script>";
        }
    }
}

