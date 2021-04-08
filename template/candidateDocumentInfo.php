<?php
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Candidate", $_SESSION['sections'])){
            if (headers_sent()) {
                die("No Access");
            }else{
                header("Location: ../index.php");
                exit();
            } 
        }        
    }
}
$passportNum = base64_decode($_GET['p']);
$creationDate = base64_decode($_GET['cd']);
$candidate = mysqli_fetch_assoc($conn->query("SELECT fName, lName, passportPhoto, passportPhotoFile, passportScannedCopy,oldVisa, oldVisaFile, departureSeal,departureSealFile,arrivalSeal,arrivalSealFile from passport where passportNum = '$passportNum' AND creationDate = '$creationDate'"));
?>

<style>
.box{
    display: flex;
    justify-content: center;
    align-items: center;
}
.card{
    width: 50%;
    margin: 2%;
}
</style>

<div class="box">
    <div class="card">
        <div class="card-header text-center"> Passport Information </div>
        <div class="card-body text-center">
            <p><?php echo $candidate['fName']." ".$candidate['lName'] ?></p>
            <div class="row">
                <?php if($candidate['passportPhoto'] == 'yes'){?>
                    <div class="col-sm">
                        <img src="<?php echo $candidate['passportPhotoFile'];?>" alt="No photo" height="100" width="100">
                    </div>
                <?php }else{ ?>
                    <div class="col-sm">
                        <p style="color: red;">No Photo Uploaded</p>
                    </div>
                <?php } ?>
            </div>
        </div>
        <hr>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-3">
                    <h5 for="passport">Passport</h5>
                </div>
                <div class="col-sm-9 text-center" >
                    <a href="<?php echo $candidate['passportScannedCopy'];?>" target="_blank"><img style="align-content: center;" src="<?php echo $candidate['passportScannedCopy'];?>" alt="" height="100" width="100"></a>
                </div>
            </div>       
        </div>
        <?php if($candidate['departureSeal'] != 'no'){ ?>
        <hr>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <h5 for="passport">Departure Seal</h5>
                    </div>
                    <div class="col-sm-9 text-center" >
                        <a href="<?php echo $candidate['departureSealFile'];?>" target="_blank"><img style="align-content: center;" src="<?php echo $candidate['departureSealFile'];?>" alt="" height="100" width="100"></a>
                    </div>
                </div>        
            </div>
            <hr>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <h5 for="passport">Arrival Seal </h5>
                    </div>
                    <div class="col-sm-9 text-center" >
                        <a href="<?php echo $candidate['arrivalSealFile'];?>" target="_blank"><img style="align-content: center;" src="<?php echo $candidate['arrivalSealFile'];?>" alt="" height="100" width="100"></a>
                    </div>
                </div>        
            </div>
        <?php } ?>        
    </div>    
</div>