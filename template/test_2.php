<?php
// var_dump($_FILES['two']);
// Scanned passport file directory set - upload code inside result true if statement;
// if (($_FILES['traningCardFile']['name'] != "")){
//     // Where the file is going to be stored
//     $trainingCard_target_dir = "uploads/trainingCard/";
//     $file = $_FILES['traningCardFile']['name'];
//     $path = pathinfo($file);
//     $trainingCard_ext = $path['extension'];
//     $trainingCard_temp_name = $_FILES['traningCardFile']['tmp_name'];
//     $trainingCard_path_filename_ext = $base_dir.$trainingCard_target_dir."trainingCard"."_".$passportNum."_".str_replace(":", "", $date).".".$trainingCard_ext;
// }
foreach ( $_FILES as $name ) {
    var_dump($name);
    // print_r(count($name));
    // print_r($name[0]."<br>");
    // $count = count($name);
    // for($i = 0; $i < $count ; $i++){
        // $target_dir = "uploads/visa/";
        // $temp_name = $name['tmp_name'][$i];
        // $path = pathinfo($name['name'][$i]);
        // $ext = $path['extension'];
        // $path_filename_ext = $base_dir.$target_dir."visaFile_".$i."_".$processingId."_".".".$ext;
        // $data_path = $target_dir."visaFile_".$i."_".$processingId."_".".".$ext;
        // print_r($data_path."<br>");
        // $result = $conn -> query("INSERT INTO optionalfiles(passportNum, passportCreationDate, optionalFile) VALUES ('$passportNum',$cre)");
        // if($result){
        //     move_uploaded_file($temp_name,$path_filename_ext);
        // }else{
        //     echo mysqli_error($conn);
        // }
        
    // }
}
foreach($_FILES['two']['tmp_name'] as $key => $tmp_name)
{
    $file_name = $key.$_FILES['documents']['name'][$key];
    $file_size =$_FILES['documents']['size'][$key];
    $file_tmp =$_FILES['documents']['tmp_name'][$key];
    $file_type=$_FILES['documents']['type'][$key];  
    // move_uploaded_file($file_tmp,"galleries/".time().$file_name);
}