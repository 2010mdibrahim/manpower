<?php
include ('database.php');
$passportNum = $_POST['passportNum'];
$creationDate = $_POST['creationDate'];
$maxIdQry = mysqli_fetch_assoc($conn->query("SELECT max(optionalFileId) as maxId from optionalfiles"));
if(is_null($maxIdQry['maxId'])){
    $maxId = 1;
}else{
    $maxId = (int)$maxIdQry['maxId'] + 1;
}
if($_FILES['optionalFile']['name'] != ''){
    foreach($_FILES['optionalFile']['tmp_name'] as $key => $tmp_name){
        $target_dir = 'uploads/optionalFile/';
        $file_name = $key.$_FILES['optionalFile']['name'][$key];
        $path = pathinfo($file_name);
        $ext = $path['extension'];
        $file_tmp =$_FILES['optionalFile']['tmp_name'][$key];
        $path_file_ext = $base_dir.$target_dir."optionalFile_".$maxId.".".$ext;
        $data_path = $target_dir."optionalFile_".$maxId.".".$ext;
        $result = $conn -> query("INSERT INTO optionalfiles(passportNum, passportCreationDate, optionalFile) VALUES ('$passportNum','$creationDate','$data_path')");
        move_uploaded_file($file_tmp,$path_file_ext);
        $maxId++;
    }
}
echo "<script> window.location.href='../index.php?page=cI&p=".base64_encode($passportNum)."&cd=".base64_encode($creationDate)."'</script>";
