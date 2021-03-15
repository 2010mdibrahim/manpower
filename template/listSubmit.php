<?php
include ('database.php');
if(isset($_POST['mode'])){    
    $mode = $_POST['mode'];
    if($mode == 'policeVerification'){
        $passportNum_info = explode("_",$_POST['modalPassportPolice']);
        $passportNum = $passportNum_info[0];
        $passportCreationDate = $passportNum_info[1];
        if (($_FILES['policeClearance']['name'] != "")){
            $target_dir = "uploads/policeVerification/";
            $file = $_FILES['policeClearance']['name'];
            $path = pathinfo($file);
            $ext = $path['extension'];
            $temp_name = $_FILES['policeClearance']['tmp_name'];
            $path_filename_ext = $base_dir.$target_dir."policeVerification"."_".$passportNum."_".str_replace(":", "", $passportCreationDate).".".$ext;
        }
        $fileName = $target_dir."policeVerification"."_".$passportNum."_".str_replace(":", "", $passportCreationDate).".".$ext;
        $result = $conn->query("UPDATE passport set policeClearanceFile = '$fileName', policeClearance = 'yes' where passportNum = '$passportNum' AND creationDate = '$passportCreationDate'");
        if($result){
            if (($_FILES['policeClearance']['name'] != "")){
                move_uploaded_file($temp_name,$path_filename_ext);
            }
            echo "<script>window.alert('Inserted')</script>";
            echo "<script> window.location.href='../index.php?page=listCandidate'</script>";
        }else{
            echo "<script>window.alert('Failed')</script>";
            echo "<script> window.location.href='../index.php?page=listCandidate'</script>";
        }
    }else if($mode == 'trainingCardMode'){
        $passportNum = $_POST['passportNumModalTraining'];
        $path_filename_ext = '';
        $temp_name = '';
        $target_dir = '';
        $ext = '';
        if (($_FILES['trainingCard']['name'] != "")){
            // Where the file is going to be stored
            $base_dir = "C:/xampp/htdocs/mahfuza/";
            $target_dir = "uploads/trainingCard/";
            $file = $_FILES['trainingCard']['name'];
            $path = pathinfo($file);
            $ext = $path['extension'];
            $temp_name = $_FILES['trainingCard']['tmp_name'];
            $path_filename_ext = $base_dir.$target_dir."trainingCard"."-".$passportNum.".".$ext;
        }
        $fileName = $target_dir."trainingCard"."-".$passportNum.".".$ext;
        $result = $conn->query("UPDATE passport set trainingCardFile = '$fileName', trainingCard = 'yes' where passportNum = '$passportNum'");
        if($result){
            if (($_FILES['trainingCard']['name'] != "")){
                move_uploaded_file($temp_name,$path_filename_ext);
            }
            echo "<script>window.alert('Updated')</script>";
            echo "<script> window.location.href='../index.php?page=listCandidate#$passportNum'</script>";
        }else{
            echo "<script>window.alert('Failed')</script>";
            echo "<script> window.location.href='../index.php?page=listCandidate'</script>";
        }
    }else if($mode = 'photoMode'){
        $passportNum = $_POST['passportNumModalPhoto'];
        $path_filename_ext = '';
        $temp_name = '';
        $target_dir = '';
        $ext = '';
        if (($_FILES['photo']['name'] != "")){
            // Where the file is going to be stored
            $base_dir = "C:/xampp/htdocs/mahfuza/";
            $target_dir = "uploads/photo/";
            $file = $_FILES['photo']['name'];
            $path = pathinfo($file);
            $ext = $path['extension'];
            $temp_name = $_FILES['photo']['tmp_name'];
            $path_filename_ext = $base_dir.$target_dir."photo"."-".$passportNum.".".$ext;
        }
        $fileName = $target_dir."photo"."-".$passportNum.".".$ext;
        $result = $conn->query("UPDATE passport set passportPhotoFile = '$fileName', passportPhoto = 'yes' where passportNum = '$passportNum'");
        if($result){
            if (($_FILES['photo']['name'] != "")){
                move_uploaded_file($temp_name,$path_filename_ext);
            }
            echo "<script>window.alert('Updated')</script>";
            echo "<script> window.location.href='../index.php?page=listCandidate#$passportNum'</script>";
        }else{
            echo "<script>window.alert('Failed')</script>";
            echo "<script> window.location.href='../index.php?page=listCandidate'</script>";
        }
    }
}