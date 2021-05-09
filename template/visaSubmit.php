<?php
include ('database.php');
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("VISA", $_SESSION['sections'])){
            if (headers_sent()) {
                die("No Access");
            }else{
                header("Location: ../index.php");
                exit();
            } 
        }        
    }
}
if(isset($_POST['mode'])){
    $mode = $_POST['mode'];
    if($mode == 'testMedical'){
        $passport_info = explode("_",$_POST['passportMedical']);
        $passportMedical = $passport_info[0];
        $passportCreationDate = $passport_info[1];
        if (($_FILES['testMedical']['name'] != "")){
            // Where the file is going to be stored
            $target_dir = "uploads/medical/";
            $file = $_FILES['testMedical']['name'];
            $path = pathinfo($file);
            $ext = $path['extension'];
            $temp_name = $_FILES['testMedical']['tmp_name'];
            $path_filename_ext = $base_dir.$target_dir."testMedical"."_".$passportMedical."_".str_replace(":", "", $passportCreationDate).".".$ext;
        }
        $testPath = $target_dir."testMedical"."_".$passportMedical."_".str_replace(":", "", $passportCreationDate).".".$ext;
        $result = $conn->query("UPDATE passport set testMedical = 'yes', testMedicalFile = '$testPath' where passportNum = '$passportMedical' AND creationDate = '$passportCreationDate'");
        if($result){
            if (($_FILES['testMedical']['name'] != "")){
                move_uploaded_file($temp_name,$path_filename_ext);
            }
            // echo "<script>window.alert('Inserted')</script>";
            echo "<script> window.location.href='../index.php?page=listCandidate'</script>";
        }else{
            echo "<script>window.alert('Failed')</script>";
            echo "<script> window.location.href='../index.php?page=listCandidate'</script>";
        }        
    }else if($mode == 'finalMedical'){
        $passportMedicalFinal_info = explode("_",$_POST['passportMedicalFinal']);
        $passportMedicalFinal = $passportMedicalFinal_info[0];
        $passportCreationDate = $passportMedicalFinal_info[1];
        $finalMedicalDate = $_POST['finalMedicalDate'];
        if (($_FILES['finalMedical']['name'] != "")){
            // Where the file is going to be stored
            $target_dir = "uploads/medical/";
            $file = $_FILES['finalMedical']['name'];
            $path = pathinfo($file);
            $ext = $path['extension'];
            $temp_name = $_FILES['finalMedical']['tmp_name'];
            $path_filename_ext = $base_dir.$target_dir."finalMedical"."_".$passportMedicalFinal."_".str_replace(":", "", $passportCreationDate).".".$ext;
            $testPath = $target_dir."finalMedical"."_".$passportMedicalFinal."_".str_replace(":", "", $passportCreationDate).".".$ext;
            $result = $conn->query("UPDATE passport set finalMedical = 'yes', finalMedicalFile = '$testPath' where passportNum = '$passportMedicalFinal' AND creationDate = '$passportCreationDate'");
        }
        $result = $conn->query("UPDATE passport set finalMedical = 'yes', finalMedicalReport = '$finalMedicalDate' where passportNum = '$passportMedicalFinal' AND creationDate = '$passportCreationDate'");
        if($result){
            if (($_FILES['finalMedical']['name'] != "")){
                move_uploaded_file($temp_name,$path_filename_ext);
            }
            // echo "<script>window.alert('Inserted')</script>";
            echo "<script> window.location.href='../index.php?page=listCandidate'</script>";
        }else{
            echo "<script>window.alert('Failed')</script>";
            echo "<script> window.location.href='../index.php?page=listCandidate'</script>";
        } 
    }
}