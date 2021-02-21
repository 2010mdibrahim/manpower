<?php
include ('database.php');
if(isset($_POST['mode'])){
    $mode = $_POST['mode'];
    if($mode == 'testMedical'){
        $visaMedical = $_POST['visaMedical'];
        $path_filename_ext = '';
        $temp_name = '';
        $target_dir = '';
        $ext = '';
        if (($_FILES['testMedical']['name'] != "")){
            // Where the file is going to be stored
            $base_dir = "C:/xampp/htdocs/mahfuza/";
            $target_dir = "uploads/medical/";
            $file = $_FILES['testMedical']['name'];
            $path = pathinfo($file);
            $ext = $path['extension'];
            $temp_name = $_FILES['testMedical']['tmp_name'];
            $path_filename_ext = $base_dir.$target_dir."testMedical"."-".$visaMedical.".".$ext;
        }
        $testPath = $target_dir."testMedical"."-".$visaMedical.".".$ext;
        $result = $conn->query("UPDATE visa set testMedical = 'yes', testMedicalFile = '$testPath' where visaNo = '$visaMedical'");
        if($result){
            if (($_FILES['testMedical']['name'] != "")){
                move_uploaded_file($temp_name,$path_filename_ext);
            }
            echo "<script>window.alert('Inserted')</script>";
            echo "<script> window.location.href='../index.php?page=visaList'</script>";
        }else{
            echo "<script>window.alert('Failed')</script>";
            echo "<script> window.location.href='../index.php?page=visaList'</script>";
        }        
    }else if($mode == 'finalMedical'){
        $visaMedical = $_POST['visaMedicalFinal'];
        $path_filename_ext = '';
        $temp_name = '';
        $target_dir = '';
        $ext = '';
        if (($_FILES['finalMedical']['name'] != "")){
            // Where the file is going to be stored
            $base_dir = "C:/xampp/htdocs/mahfuza/";
            $target_dir = "uploads/medical/";
            $file = $_FILES['finalMedical']['name'];
            $path = pathinfo($file);
            $ext = $path['extension'];
            $temp_name = $_FILES['finalMedical']['tmp_name'];
            $path_filename_ext = $base_dir.$target_dir."finalMedical"."-".$visaMedical.".".$ext;
        }
        $testPath = $target_dir."finalMedical"."-".$visaMedical.".".$ext;
        $result = $conn->query("UPDATE visa set finalMedical = 'yes', finalMedicalFile = '$testPath' where visaNo = '$visaMedical'");
        if($result){
            if (($_FILES['finalMedical']['name'] != "")){
                move_uploaded_file($temp_name,$path_filename_ext);
            }
            echo "<script>window.alert('Inserted')</script>";
            echo "<script> window.location.href='../index.php?page=visaList'</script>";
        }else{
            echo "<script>window.alert('Failed')</script>";
            echo "<script> window.location.href='../index.php?page=visaList'</script>";
        } 
    }

}