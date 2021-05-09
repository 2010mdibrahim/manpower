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
$mode = $_POST['mode'];
if(isset($_POST['passportNum'])){
    $passportNum = $_POST['passportNum'];
}else{
    $passportNum = '';
}
if(isset($_POST['sponsorVisa'])){
    $sponsorVisa = $_POST['sponsorVisa'];
}else{
    $sponsorVisa = '';
}
if(isset($_POST['processingId'])){
    $processingId = $_POST['processingId'];
}else{
    $processingId = '';
}
if ($mode == 'empRqstMode') {
    $empVal = $_POST['empRqst'];
    if($empVal == 'no'){
        $result = $conn -> query("UPDATE processing set medicalUpdate = '$updateMedical', empRqst = '$empVal', foreignMole = '$empVal', okala = '$empVal', mufa = '$empVal', visaStamping = '$empVal', finger = '$empVal' where passportNum  = '$passportNum' AND sponsorVisa = '$sponsorVisa'");
    }else{
        $result = $conn -> query("UPDATE processing set empRqst = '$empVal' where passportNum  = '$passportNum' AND sponsorVisa = '$sponsorVisa'");
    }    
    if($result){
        echo "<script> window.location.href='../index.php?page=visaList'</script>";
    }else{
        echo "<script>window.alert('Error')</script>";
    }
}else if($mode == 'foreignMoleMode'){
    $foreignMole = $_POST['foreignMole'];
    if($foreignMole == 'no'){
        $result = $conn -> query("UPDATE processing set medicalUpdate = '$foreignMole', foreignMole = '$foreignMole', okala = '$foreignMole', mufa = '$foreignMole', visaStamping = '$foreignMole', finger = '$foreignMole' where passportNum  = '$passportNum' AND sponsorVisa = '$sponsorVisa'");
    }else{
        $result = $conn -> query("UPDATE processing set foreignMole = '$foreignMole' where passportNum  = '$passportNum' AND sponsorVisa = '$sponsorVisa'");
    }    
    if($result){
        echo "<script> window.location.href='../index.php?page=visaList'</script>";
    }else{
        echo "<script>window.alert('Error')</script>";
    }
}else if($mode == 'okalaMode'){  
    if (($_FILES['okalaCard']['name'] != "")){
        // Where the file is going to be stored
        $target_dir = "uploads/okala/";
        $file = $_FILES['okalaCard']['name'];
        $path = pathinfo($file);
        $ext = $path['extension'];
        $temp_name = $_FILES['okalaCard']['tmp_name'];
        $okalaFile = $target_dir."okala"."_".$processingId.".".$ext;
        $path_filename_ext = $base_dir.$target_dir."okala"."_".$processingId.".".$ext;
    }
    $result = $conn -> query("UPDATE processing set okala = 'yes', okalaFile = '$okalaFile' where processingId = $processingId");
    if($result){
        if (($_FILES['okalaCard']['name'] != "")){
            move_uploaded_file($temp_name,$path_filename_ext);
        }
        echo "<script> window.location.href='../index.php?page=visaList'</script>";
    }else{
        echo "<script>window.alert('Error')</script>";
    }    
}else if($mode == 'mufaMode'){
    if (($_FILES['mufaCard']['name'] != "")){
        // Where the file is going to be stored
        $target_dir = "uploads/okala/";
        $file = $_FILES['mufaCard']['name'];
        $path = pathinfo($file);
        $ext = $path['extension'];
        $temp_name = $_FILES['mufaCard']['tmp_name'];
        $mufaFile = $target_dir."mufa"."_".$processingId.".".$ext;
        $path_filename_ext = $base_dir.$target_dir."mufa"."_".$processingId.".".$ext;
    }
    $result = $conn -> query("UPDATE processing set mufa = 'yes', mufaFile = '$mufaFile' where processingId = $processingId");
    if($result){
        if (($_FILES['mufaCard']['name'] != "")){
            move_uploaded_file($temp_name,$path_filename_ext);
        }
        echo "<script> window.location.href='../index.php?page=visaList'</script>";
    }else{
        echo "<script>window.alert('Error')</script>";
    }
}else if($mode == 'updateMedicalMode'){
    $updateMedical = $_POST['updateMedical'];
    if($updateMedical == 'no'){
        $result = $conn -> query("UPDATE processing set medicalUpdate = '$updateMedical', visaStamping = '$mufa', finger = '$mufa' where passportNum  = '$passportNum' AND sponsorVisa = '$sponsorVisa'");
    }else{
        $result = $conn -> query("UPDATE processing set medicalUpdate = '$updateMedical' where passportNum  = '$passportNum' AND sponsorVisa = '$sponsorVisa'");
    }
    
    if($result){
        echo "<script> window.location.href='../index.php?page=visaList'</script>";
    }else{
        echo "<script>window.alert('Error')</script>";
    }
}else if($mode == 'stampingMode'){
    if(isset($_POST['alter'])){ //delete
        $visaFileId = $_POST['visaFileId'];
        $result = $conn -> query("DELETE from visafile where visaFileId = $visaFileId");
        if($result){
            echo "<script> window.location.href='../index.php?page=svf&p=".base64_encode($processingId)."'</script>";
        }else{
            echo mysqli_error($conn);
        }
    }else{ //insert & update
        if(isset($_POST['stampingDate'])){
            $stampingDate = $_POST['stampingDate'];
            $result = $conn->query("UPDATE processing set visaStamping = 'yes', visaStampingDate = '$stampingDate' where processingId = $processingId");
            echo "<script> window.location.href='../index.php?page=svf&p=".base64_encode($processingId)."'</script>";
        }
        foreach ( $_FILES as $name ) {
            $count = count($name['name']);
            for($i = 0; $i < $count ; $i++){
                $target_dir = "uploads/visa/";
                $temp_name = $name['tmp_name'][$i];
                $path = pathinfo($name['name'][$i]);
                $ext = $path['extension'];
                $path_filename_ext = $base_dir.$target_dir."visaFile_".$i."_".$processingId."_".".".$ext;
                $data_path = $target_dir."visaFile_".$i."_".$processingId."_".".".$ext;
                if(isset($_POST['visaFileId'])){
                    $file_serial = $_POST['file_serial'];
                    $path_filename_ext = $base_dir.$target_dir."visaFile_".$file_serial."_".$processingId."_".".".$ext;
                    $data_path = $target_dir."visaFile_".$file_serial."_".$processingId."_".".".$ext;
                    $visaFileId = $_POST['visaFileId'];   
                    $result = $conn -> query("UPDATE visafile set visaFile = '$data_path' where visaFileId = $visaFileId");
                    if($result){
                        move_uploaded_file($temp_name,$path_filename_ext);
                        echo "<script> window.location.href='../index.php?page=svf&p=".base64_encode($processingId)."'</script>";
                    }else{
                        echo mysqli_error($conn);
                    }
                }else{
                    $result = $conn -> query("INSERT into visaFile (visaFile, processingId) values ('$data_path',$processingId)");
                    if($result){
                        move_uploaded_file($temp_name,$path_filename_ext);
                        echo "<script> window.location.href='../index.php?page=visaList'</script>";
                    }else{
                        echo mysqli_error($conn);
                    }
                }
                
            }
        }
    }
}else if($mode == 'trainingCardMode'){
    if(isset($_POST['from'])){
        $from = $_POST['from'];
    }else{
        $from = '';
    }
    if (($_FILES['trainingCard']['name'] != "")){
        // Where the file is going to be stored=
        $target_dir = "uploads/trainingCard/";
        $file = $_FILES['trainingCard']['name'];
        $path = pathinfo($file);
        $ext = $path['extension'];
        $temp_name = $_FILES['trainingCard']['tmp_name'];
        $path_filename_ext = $base_dir.$target_dir."trainingCard"."_".$passportNum.".".$ext;
    }
    $card_path = $target_dir."trainingCard"."_".$passportNum.".".$ext;
    $result = $conn -> query("UPDATE passport set trainingCardFile = '$card_path', trainingCard = 'yes' where passportNum  = '$passportNum'");    
    if($result){
        if (($_FILES['trainingCard']['name'] != "")){
            move_uploaded_file($temp_name,$path_filename_ext);
        }
        if($from == 'candidateList'){
            echo "<script> window.location.href='../index.php?page=listCandidate'</script>";
        }else{
            echo "<script> window.location.href='../index.php?page=visaList'</script>";
        }
        
    }else{
        echo "<script>window.alert('Error')</script>";
    }
}else if($mode == 'fingerMode'){
    $finger = $_POST['finger'];
    $result = $conn -> query("UPDATE processing set finger = '$finger' where passportNum  = '$passportNum' AND sponsorVisa = '$sponsorVisa'");
    
    if($result){
        echo "<script> window.location.href='../index.php?page=visaList'</script>";
    }else{
        echo "<script>window.alert('Error')</script>";
    }
}else if($mode == 'manpowerMode'){

    if (($_FILES['manpowerCard']['name'] != "")){
        // Where the file is going to be stored
        $target_dir = "uploads/trainingCard/";
        $file = $_FILES['manpowerCard']['name'];
        $path = pathinfo($file);
        $ext = $path['extension'];
        $temp_name = $_FILES['manpowerCard']['tmp_name'];
        $manpower = $target_dir."manpower"."_".$processingId.".".$ext;
        $path_filename_ext = $base_dir.$target_dir."manpower"."_".$processingId.".".$ext;
    }
    $result = $conn -> query("UPDATE processing set manpowerCardFile = '$manpower', manpowerCard = 'yes' where processingId = $processingId");    
    if($result){
        if (($_FILES['manpowerCard']['name'] != "")){
            move_uploaded_file($temp_name,$path_filename_ext);
        }
        echo "<script> window.location.href='../index.php?page=visaList'</script>";
    }else{
        echo "<script>window.alert('Error')</script>";
    }
}