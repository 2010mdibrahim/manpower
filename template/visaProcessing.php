<?php
include ('database.php');
$mode = $_POST['mode'];
$passportNum = $_POST['passportNum'];
if(isset($_POST['sponsorVisa'])){
    $sponsorVisa = $_POST['sponsorVisa'];
}else{
    $sponsorVisa = '';
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
    if (($_FILES['okalaCard']['name'] != "")){
        // Where the file is going to be stored
        $base_dir = "C:/xampp/htdocs/mahfuza/";
        $target_dir = "uploads/okala/";
        $file = $_FILES['okalaCard']['name'];
        $path = pathinfo($file);
        $ext = $path['extension'];
        $temp_name = $_FILES['okalaCard']['tmp_name'];
        $okalaFile = $target_dir."okala"."_".$passportNum."_".$sponsorVisa.".".$ext;
        $path_filename_ext = $base_dir.$target_dir."okala"."_".$passportNum."_".$sponsorVisa.".".$ext;
    }
    $result = $conn -> query("UPDATE processing set okala = 'yes', okalaFile = '$okalaFile' where passportNum  = '$passportNum' AND sponsorVisa = '$sponsorVisa'");
    if($result){
        if (($_FILES['okalaCard']['name'] != "")){
            move_uploaded_file($temp_name,$path_filename_ext);
        }
        echo "<script> window.location.href='../index.php?page=visaList'</script>";
    }else{
        echo "<script>window.alert('Error')</script>";
    }    
}else if($mode == 'mufaMode'){
    $mufa = $_POST['mufa'];
    if (($_FILES['mufaCard']['name'] != "")){
        // Where the file is going to be stored
        $base_dir = "C:/xampp/htdocs/mahfuza/";
        $target_dir = "uploads/okala/";
        $file = $_FILES['mufaCard']['name'];
        $path = pathinfo($file);
        $ext = $path['extension'];
        $temp_name = $_FILES['mufaCard']['tmp_name'];
        $mufaFile = $target_dir."mufa"."_".$passportNum."_".$sponsorVisa.".".$ext;
        $path_filename_ext = $base_dir.$target_dir."mufa"."_".$passportNum."_".$sponsorVisa.".".$ext;
    }
    $result = $conn -> query("UPDATE processing set mufa = 'yes', mufaFile = '$mufaFile' where passportNum  = '$passportNum' AND sponsorVisa = '$sponsorVisa'");
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
    $stampingDate = $_POST['stampingDate'];
    if (($_FILES['visaFile']['name'] != "")){
        // Where the file is going to be stored
        $base_dir = "C:/xampp/htdocs/mahfuza/";
        $target_dir = "uploads/visa/";
        $file = $_FILES['visaFile']['name'];
        $path = pathinfo($file);
        $ext = $path['extension'];
        $temp_name = $_FILES['visaFile']['tmp_name'];
        $visaFile = $target_dir."visaFile"."_".$passportNum."_".$sponsorVisa.".".$ext;
        $path_filename_ext = $base_dir.$target_dir."visaFile"."_".$passportNum."_".$sponsorVisa.".".$ext;
    }
    $result = $conn -> query("UPDATE processing set visaFile = '$visaFile', visaStampingDate = '$stampingDate', visaStamping = 'yes' where passportNum  = '$passportNum' AND sponsorVisa = '$sponsorVisa'");    
    if($result){
        if (($_FILES['visaFile']['name'] != "")){
            move_uploaded_file($temp_name,$path_filename_ext);
        }
        echo "<script> window.location.href='../index.php?page=visaList'</script>";
    }else{
        echo "<script>window.alert('Error')</script>";
    }
}else if($mode == 'trainingCardMode'){
    if(isset($_POST['from'])){
        $from = $_POST['from'];
    }else{
        $from = '';
    }

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
    $result = $conn -> query("UPDATE passport set trainingCardFile = '$card_path', trainingCard = 'yes' where passportNum  = '$passportNum'");    
    if($result){
        if (($_FILES['trainingCard']['name'] != "")){
            move_uploaded_file($temp_name,$path_filename_ext);
        }
        if($from = 'candidateList'){
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
        $base_dir = "C:/xampp/htdocs/mahfuza/";
        $target_dir = "uploads/trainingCard/";
        $file = $_FILES['manpowerCard']['name'];
        $path = pathinfo($file);
        $ext = $path['extension'];
        $temp_name = $_FILES['manpowerCard']['tmp_name'];
        $manpower = $target_dir."manpower"."_".$passportNum."_".$sponsorVisa.".".$ext;
        $path_filename_ext = $base_dir.$target_dir."manpower"."_".$passportNum."_".$sponsorVisa.".".$ext;
    }
    print_r("UPDATE processing set manpowerCardFile = '$manpower', manpowerCard = 'yes' where passportNum  = '$passportNum' AND sponsorVisa = '$sponsorVisa'");
    $result = $conn -> query("UPDATE processing set manpowerCardFile = '$manpower', manpowerCard = 'yes' where passportNum  = '$passportNum' AND sponsorVisa = '$sponsorVisa'");    
    if($result){
        if (($_FILES['manpowerCard']['name'] != "")){
            move_uploaded_file($temp_name,$path_filename_ext);
        }
        echo "<script> window.location.href='../index.php?page=visaList'</script>";
    }else{
        echo "<script>window.alert('Error')</script>";
    }
}