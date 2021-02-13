<?php
include ('database.php');
if(isset($_POST['get_option']))
{
    $passNo = $_POST['get_option'];
    $qry = "select visaId from visainfo where passNo = '$passNo'";
    $result = mysqli_query($conn, $qry);
    echo "<option>".$passNo."</option>";
    while($row = mysqli_fetch_assoc($result))
    {
        echo "<option id='pass'>".$row['visaId']."</option>";
    }
    exit;
}