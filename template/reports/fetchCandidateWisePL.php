<?php
include ('../database.php');
if(isset($_POST['get_option']))
{
    $candidateId = $_POST['get_option'];
    $qry = "select passNo from passport where candidateId = $candidateId";
    $result = mysqli_query($conn, $qry);
    while($row = mysqli_fetch_assoc($result))
    {
        $passNo = $row['passNo'];
        echo "<option id='pass' value='$passNo'>".$passNo."</option>";
    }
    exit;
}