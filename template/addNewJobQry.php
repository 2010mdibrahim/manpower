<?php
include ('database.php');
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Jobs", $_SESSION['sections'])){
            if (headers_sent()) {
                die("No Access");
            }else{
                header("Location: ../index.php");
                exit();
            } 
        }        
    }
}
if(isset($_POST['jobs'])){
    if(isset($_POST['alter'])){
        $alter = $_POST['alter'];
    }else{
        $alter = '';
    }
    if($alter == 'delete'){
        $jobId = $_POST['jobId'];
        $result = $conn->query("DELETE from jobs where jobId = $jobId");

        if($result){
            // echo "<script>window.alert('Deleted')</script>";
            echo "<script> window.location.href='../index.php?page=jobs'</script>";
        }else{
            echo "<script>window.alert('Error')</script>";
            echo "<script> window.location.href='../index.php?page=jobs'</script>";
        }
    }else{
        $creditType = $_POST['creditType'];
        $jobType = $_POST['jobType'];
        $admin = $_SESSION['email'];
        $createDate = date("Y-m-d H:i:s");

        $result = $conn->query("INSERT into jobs (jobType, creditType, updatedBy, creationDate) values ('$jobType', '$creditType', '$admin', '$createDate')");

        if($result){
            // echo "<script>window.alert('Added')</script>";
            echo "<script> window.location.href='../index.php?page=jobs'</script>";
        }else{
            echo "<script>window.alert('Error')</script>";
            echo "<script> window.location.href='../index.php?page=jobs'</script>";
        }
    }
    
}