<?php
include ('database.php');
$alter = $_POST['alter'];
$expenseheadId = $_POST['expenseheadId'];
$expenseHeaderName = $_POST['expenseHeader'];
if($alter == 'insert'){
    $qry = "insert into expenseHeader (expenseName) values ('$expenseHeaderName')";
    $result = mysqli_query($conn,$qry);
    if($result)
    {
        echo "<script> window.alert('Inserted')</script>";
        echo "<script> window.location.href='../index.php?page=expenseHeader'</script>";
    }
    else{
        echo 'something went wrong!';
    }
}else if($alter == 'update'){
    $qry = "update expenseHeader set expenseName = ('$expenseHeaderName') where expenseheadId = $expenseheadId";
    $result = mysqli_query($conn,$qry);
    if($result)
    {
        echo "<script> window.alert('Updated')</script>";
        echo "<script> window.location.href='../index.php?page=expenseHeader'</script>";
    }
    else{
        echo 'something went wrong!';
    }
}else{

}

