<?php
include ('database.php');
$alter = $_POST['alter'];
$optionalFileId = $_POST['optionalFileId'];
$passportNum = $_POST['passportNum'];
$creationDate = $_POST['creationDate'];
if($alter == 'delete'){
    $result = $conn->query("DELETE from optionalfiles where optionalFileId = $optionalFileId");
}else{
    if (($_FILES['optionalFile']['name'] != "")){
        // Where the file is going to be stored
        $target_dir = "uploads/optionalFile/";    
        $file = $_FILES['optionalFile']['name'];
        $path = pathinfo($file);
        $ext = $path['extension'];
        $temp_name = $_FILES['optionalFile']['tmp_name'];
        $path_filename_ext = $base_dir.$target_dir."optionalFile_".$optionalFileId.".".$ext;
        $data_path = $target_dir."optionalFile_".$optionalFileId.".".$ext;
        $result = $conn->query("UPDATE optionalfiles set optionalFile = '$data_path' where optionalFileId = $optionalFileId");
        if ($result){
            move_uploaded_file($temp_name,$path_filename_ext);
        }
    }    
}
if($result){
    echo "<script> window.location.href='../index.php?page=cI&p=".base64_encode($passportNum)."&cd=".base64_encode($creationDate)."'</script>";
}