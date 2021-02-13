<?php
include ('database.php');
if(isset($_POST['get_option']))
{
    $candidateId = $_POST['get_option'];
    $qry = "select passNo from passport where candidateId = $candidateId";
    $result = mysqli_query($conn, $qry);
    $output = '';
    while($row = mysqli_fetch_assoc($result))
    {
        $output .= '<option value="'.$row["passNo"].'">'.$row["passNo"].'</option>';
    }
    echo $output;
}