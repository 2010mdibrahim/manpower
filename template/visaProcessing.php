<?php
include ('database.php');
$mode = $_POST['mode'];
$visaNo = $_POST['visaNo'];
if ($mode == 'empRqstMode') {
    $empVal = $_POST['empRqst'];
    if($empVal == 'no'){
        $result = $conn -> query("UPDATE visa set empRqst = '$empVal', foreignMole = '$empVal', okala = '$empVal', mufa = '$empVal', visaStamping = '$empVal', finger = '$empVal' where visaNo = '$visaNo'");
    }else{
        $result = $conn -> query("UPDATE visa set empRqst = '$empVal' where visaNo = '$visaNo'");
    }    
    if($result){
        echo "<script> window.location.href='../index.php?page=visaList'</script>";
    }else{
        echo "<script>window.alert('Error')</script>";
    }
}else if($mode == 'foreignMoleMode'){
    $foreignMole = $_POST['foreignMole'];
    if($foreignMole == 'no'){
        $result = $conn -> query("UPDATE visa set foreignMole = '$foreignMole', okala = '$foreignMole', mufa = '$foreignMole', visaStamping = '$foreignMole', finger = '$foreignMole' where visaNo = '$visaNo'");
    }else{
        $result = $conn -> query("UPDATE visa set foreignMole = '$foreignMole' where visaNo = '$visaNo'");
    }    
    if($result){
        echo "<script> window.location.href='../index.php?page=visaList'</script>";
    }else{
        echo "<script>window.alert('Error')</script>";
    }
}else if($mode == 'okalaMode'){
    $okala = $_POST['okala'];
    if($okala == 'no'){
        $result = $conn -> query("UPDATE visa set okala = '$okala', mufa = '$okala', visaStamping = '$okala', finger = '$okala' where visaNo = '$visaNo'");
    }else{
        $result = $conn -> query("UPDATE visa set okala = '$okala' where visaNo = '$visaNo'");
    }    
    if($result){
        echo "<script> window.location.href='../index.php?page=visaList'</script>";
    }else{
        echo "<script>window.alert('Error')</script>";
    }
}else if($mode == 'mufaMode'){
    $mufa = $_POST['mufa'];
    if($mufa == 'no'){
        $result = $conn -> query("UPDATE visa set mufa = '$mufa', visaStamping = '$mufa', finger = '$mufa' where visaNo = '$visaNo'");
    }else{
        $result = $conn -> query("UPDATE visa set mufa = '$mufa' where visaNo = '$visaNo'");
    }
    
    if($result){
        echo "<script> window.location.href='../index.php?page=visaList'</script>";
    }else{
        echo "<script>window.alert('Error')</script>";
    }
}else if($mode == 'visaStamingMode'){
    $stamping = $_POST['stamping'];
    if($stamping == 'no'){
        $result = $conn -> query("UPDATE visa set visaStamping = '$stamping', finger = '$stamping' where visaNo = '$visaNo'");
    }else{
        $result = $conn -> query("UPDATE visa set visaStamping = '$stamping' where visaNo = '$visaNo'");
    }
    
    if($result){
        echo "<script> window.location.href='../index.php?page=visaList'</script>";
    }else{
        echo "<script>window.alert('Error')</script>";
    }
}else if($mode == 'fingerMode'){
    $finger = $_POST['finger'];
    $result = $conn -> query("UPDATE visa set finger = '$finger' where visaNo = '$visaNo'");
    if($result){
        echo "<script> window.location.href='../index.php?page=visaList'</script>";
    }else{
        echo "<script>window.alert('Error')</script>";
    }
}