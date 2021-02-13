<?php
include ('../database.php');
if(isset($_POST['get_option'])){
    $sponsorId = $_POST['get_option'];
    $qry = "select visaId, name from visainfo where visaSponsorId = $sponsorId";
    $result = mysqli_query($conn,$qry);
    while($row = mysqli_fetch_assoc($result))
    {
        $visaId = $row['visaId'];
        $visaName = $row['name'];
        echo "<option value='$visaId'>".$visaName."</option>";
    }

}