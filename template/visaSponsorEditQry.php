<?php
include ("database.php");
if(!isset($_SESSION['sections'])){
  header("Location: ../index.php");
  exit();
}else{
  if(!in_array("All", $_SESSION['sections'])){
      if(!in_array("Sponsor", $_SESSION['sections'])){
        if (headers_sent()) {
          die("No Access");
        }else{
                header("Location: ../index.php");
                exit();
        } 
      }        
  }
}
if(isset($_POST['sponsorVisaEdit'])){
  if(isset($_POST['alter'])){
    $alter = $_POST['alter'];
  }else{
    $alter = '';
  }
  
  $sponsorVisa = $_POST['sponsorVisa'];
  if($alter == 'delete'){   
    $result = $conn->query("DELETE from sponsorvisalist where sponsorVisa = '$sponsorVisa'");

    if($result){
      echo "<script> window.alert('Deleted')</script>";
      echo "<script> window.location.href='../index.php?page=allVisaList'</script>";
    }else{
        echo "<script> window.alert('Failed')</script>";
        echo "<script> window.location.href='../index.php?page=allVisaList'</script>";
    }
  }else{
    $addAmount = $_POST['addAmount'];
    $existAmount = $_POST['visaAmount'];
    $newAmount = $addAmount + $existAmount;

    $result = $conn->query("UPDATE sponsorvisalist set visaAmount = $newAmount where sponsorVisa = '$sponsorVisa'");

    if($result){
      echo "<script> window.alert('Updated')</script>";
      echo "<script> window.location.href='../index.php?page=allVisaList'</script>";
    }else{
        echo "<script> window.alert('Failed')</script>";
        echo "<script> window.location.href='../index.php?page=allVisaList'</script>";
    }
  }
}