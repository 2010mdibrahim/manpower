<?php
include ('../database.php');
if(isset($_POST['val'])){
    $companyId = $_POST['val'];
    $qry = "select companyId, companyName from company where companyId != $companyId";
    $result = mysqli_query($conn, $qry);
    echo "<option>Company Name</option>";
    while($row = mysqli_fetch_assoc($result))
    {
        echo "<option value=".$row['companyId'].">".$row['companyName']."</option>";
    }
}
