<?php
include ('database.php');
if(isset($_POST["insert"]))
{
    $mofaCode = $_POST['mofaCode'];
    $mofaStage = $_POST['mofaStage'];
    $mofaRemark = $conn->real_escape_string($_POST['mofaRemark']);
    $passNo = $_POST['passNo'];
    $admin = $_SESSION['email'];
    $date = date("Y-m-d");
    $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
    $query = "INSERT INTO mofa(mofaCode, mofaStage, passNo, mofaEvi, mofaRemark, status, updatedBy, updatedOn) 
                VALUES ('$mofaCode','$mofaStage','$passNo','$file','$mofaRemark',1,'$admin','$date')";
    if(mysqli_query($conn, $query))
    {
        echo '<script>alert("MOFA Added")</script>';
        echo "<script> window.location.href='../index.php?page=selectPassport'</script>";
    }else{
        echo '<script>alert("MOFA Error")</script>';
    }
}