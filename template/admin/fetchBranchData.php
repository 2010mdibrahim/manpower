<?php
include ('../database.php');
if(isset($_POST['get_option'])){
    $companyId = $_POST['get_option'];
    $qry = "select branchId, branchName from branch where branchId not in 
              (select branch.branchId from branch 
                  inner join hasbranch on hasbranch.branchId = branch.branchId where hasbranch.companyId = $companyId)";
    $result = mysqli_query($conn,$qry);
    while($branch = mysqli_fetch_assoc($result)){
        $departmentId = $branch['branchId'];
        echo "<option value=$departmentId>".$branch['branchName']."</option>";
    }
    exit;
}
