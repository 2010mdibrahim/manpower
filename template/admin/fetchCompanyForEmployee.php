<?php
include ('../database.php');
if(isset($_POST['val'])){
    $companyId = $_POST['val'];
    $qry = "select companyId, companyName from company where companyId = $companyId";
    $result = mysqli_query($conn, $qry);
    $company = mysqli_fetch_assoc($result);
    echo "<option value=".$company['companyId'].">".$company['companyName']."</option>";
}
