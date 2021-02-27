<?php
include ('database.php');
$mode = $_POST['mode'];
$passportNum = $_POST['passportNum'];
$sponsorVisa = $_POST['sponsorVisa'];
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
        $result = $conn -> query("UPDATE processing set medicalUpdate = '$updateMedical', foreignMole = '$foreignMole', okala = '$foreignMole', mufa = '$foreignMole', visaStamping = '$foreignMole', finger = '$foreignMole' where passportNum  = '$passportNum' AND sponsorVisa = '$sponsorVisa'");
    }else{
        $result = $conn -> query("UPDATE processing set foreignMole = '$foreignMole' where passportNum  = '$passportNum' AND sponsorVisa = '$sponsorVisa'");
    }    
    if($result){
        echo "<script> window.location.href='../index.php?page=visaList'</script>";
    }else{
        echo "<script>window.alert('Error')</script>";
    }
}else if($mode == 'okalaMode'){
    $okala = $_POST['okala'];
    if($okala == 'no'){
        $result = $conn -> query("UPDATE processing set medicalUpdate = '$updateMedical', okala = '$okala', mufa = '$okala', visaStamping = '$okala', finger = '$okala' where passportNum  = '$passportNum' AND sponsorVisa = '$sponsorVisa'");
    }else{
        $result = $conn -> query("UPDATE processing set okala = '$okala' where passportNum  = '$passportNum' AND sponsorVisa = '$sponsorVisa'");
    }    
    if($result){
        echo "<script> window.location.href='../index.php?page=visaList'</script>";
    }else{
        echo "<script>window.alert('Error')</script>";
    }
}else if($mode == 'mufaMode'){
    $mufa = $_POST['mufa'];
    if($mufa == 'no'){
        $result = $conn -> query("UPDATE processing set medicalUpdate = '$updateMedical', mufa = '$mufa', visaStamping = '$mufa', finger = '$mufa' where passportNum  = '$passportNum' AND sponsorVisa = '$sponsorVisa'");
    }else{
        $result = $conn -> query("UPDATE processing set mufa = '$mufa' where passportNum  = '$passportNum' AND sponsorVisa = '$sponsorVisa'");
    }
    
    if($result){
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
}else if($mode == 'stampingDateMode'){
    $stampingDate = $_POST['stampingDate'];
    $result = $conn -> query("UPDATE processing set visaStampingDate = '$stampingDate', visaStamping = 'yes' where passportNum  = '$passportNum' AND sponsorVisa = '$sponsorVisa'");    
    if($result){
        echo "<script> window.location.href='../index.php?page=visaList'</script>";
    }else{
        echo "<script>window.alert('Error')</script>";
    }
}else if($mode == 'trainingCardMode'){
    if (($_FILES['trainingCard']['name'] != "")){
        // Where the file is going to be stored
        $base_dir = "C:/xampp/htdocs/mahfuza/";
        $target_dir = "uploads/trainingCard/";
        $file = $_FILES['trainingCard']['name'];
        $path = pathinfo($file);
        $ext = $path['extension'];
        $temp_name = $_FILES['trainingCard']['tmp_name'];
        $path_filename_ext = $base_dir.$target_dir."trainingCard"."_".$passportNum.".".$ext;
    }
    $card_path = $target_dir."trainingCard"."_".$passportNum.".".$ext;
    $result = $conn -> query("UPDATE processing set trainingCardFile = '$card_path', trainingCard = 'yes' where passportNum  = '$passportNum' AND sponsorVisa = '$sponsorVisa'");    
    if($result){
        if (($_FILES['trainingCard']['name'] != "")){
            move_uploaded_file($temp_name,$path_filename_ext);
        }
        echo "<script> window.location.href='../index.php?page=visaList'</script>";
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
}