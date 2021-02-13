<?php
include ('../database.php');
if(isset($_POST['get_option'])){
    $sponsorId = $_POST['get_option'];
    $qry = "select type from visainfo where visaSponsorId = $sponsorId group by type";
    $result = mysqli_query($conn,$qry);
    while($row = mysqli_fetch_assoc($result))
    {
        $type = $row['type'];
        echo "<option>".$type."</option>";
    }

}