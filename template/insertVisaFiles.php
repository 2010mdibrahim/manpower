<?php
include ('database.php');
$processingId = $_POST['processingId'];
foreach ( $_FILES as $name ) {
    $count = count($name['name']);
    for($i = 0; $i < $count ; $i++){
        $target_dir = "uploads/visa/";
        $temp_name = $name['tmp_name'][$i];
        $path = pathinfo($name['name'][$i]);
        $ext = $path['extension'];
        $path_filename_ext = $base_dir.$target_dir."visaFile_".$i."_".$processingId."_".".".$ext;
        $data_path = $target_dir."visaFile_".$i."_".$processingId."_".".".$ext;
        $result = $conn -> query("INSERT into visaFile (visaFile, processingId) values ('$data_path',$processingId)");
        if($result){
            move_uploaded_file($temp_name,$path_filename_ext);
        }else{
            echo mysqli_error($conn);
        }
    }
}
echo "<script> window.location.href='../index.php?page=svf&p=".base64_encode($processingId)."'</script>";