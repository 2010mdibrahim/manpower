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
$candidate = mysqli_fetch_assoc($conn->query("SELECT fullPhotoFile, fName, lName, passportPhoto, passportPhotoFile, passportScannedCopy,departureDate,arrivalDate, departureSeal,departureSealFile,arrivalSeal,arrivalSealFile, oldVisa, oldVisaFile from passport where passportNum = '$passportNum' AND creationDate = '$creationDate'"));
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
    <!-- Stamping Modal For Date -->
    <div class="modal fade" tabindex="-1" role="dialog" id="editDocument">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/deleteOptionalFile.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Reupload this file</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="text" name="passportNum" id="passportNum">
                        <input type="text" name="creationDate" id="creationDate">
                        <input type="hidden" name="optionalFileId" id="optionalFileId">
                        <input type="hidden" name="alter" value="update">
                        <div class="form-group">
                            <input class="form-control-file" type="file" name="optionalFile">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header text-center"> Passport Information </div>
        <div class="card-body text-center">
            <p><?php echo $candidate['fName']." ".$candidate['lName'] ?></p>
            <div class="row">
                <div class="col-sm">
                    <?php if($candidate['passportPhoto'] == 'yes'){?>
                        <div class="col-sm">
                            <a href="<?php echo $candidate['passportPhotoFile'];?>"><img src="<?php echo $candidate['passportPhotoFile'];?>" alt="No photo" height="100" width="auto"></a>
                        </div>
                    <?php }else{ ?>
                        <div class="col-sm">
                            <p style="color: red;">No Photo Uploaded</p>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-sm">
                    <?php if($candidate['fullPhotoFile'] == 'no'){?>
                        <div class="col-sm">
                            <p style="color: red;">No Full Photo Uploaded</p>
                        </div>
                    <?php }else{ ?>
                        <div class="col-sm">
                            <a href="<?php echo $candidate['fullPhotoFile'];?>"><img src="<?php echo $candidate['fullPhotoFile'];?>" alt="No photo" height="100" width="auto"></a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <hr>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-3">
                    <h5 for="passport">Passport</h5>
                </div>
                <div class="col-sm-9 text-center" >
                    <a href="<?php echo $candidate['passportScannedCopy'];?>" target="_blank"><img style="align-content: center;" src="<?php echo $candidate['passportScannedCopy'];?>" alt="" height="100" width="auto"></a>
                </div>
            </div>       
        </div>
        <?php if($candidate['departureSeal'] != 'no'){ ?>
            <hr>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <label for="">Departure Date</label>
                        <h5 for="passport"><?php echo ($candidate['departureDate'] == '0000-00-00') ? 'No Date' : $candidate['departureDate'];?></h5>
                    </div>
                    <div class="col-sm-9 text-center" >
                        <a href="<?php echo $candidate['departureSealFile'];?>" target="_blank"><img style="align-content: center;" src="<?php echo $candidate['departureSealFile'];?>" alt="" height="100" width="auto"></a>
                    </div>
                </div>        
            </div>
        <?php } ?>        
        <?php if($candidate['arrivalSeal'] != 'no'){ ?>
            <hr>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <label for="">Arrival Date</label>
                        <h5 for="passport"><?php echo ($candidate['arrivalDate'] == '0000-00-00') ? 'No Date' : $candidate['arrivalDate'];?></h5>
                    </div>
                    <div class="col-sm-9 text-center" >
                        <a href="<?php echo $candidate['arrivalSealFile'];?>" target="_blank"><img style="align-content: center;" src="<?php echo $candidate['arrivalSealFile'];?>" alt="" height="100" width="auto"></a>
                    </div>
                </div>        
            </div>
        <?php } ?>
        <?php
        $result = $conn->query("SELECT * from optionalfiles where passportNum = '$passportNum' AND passportCreationDate = '$creationDate'");
        if(!is_null($result)){
            while($optional = mysqli_fetch_assoc($result)){
        ?>
            <hr>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <label for="">Optional File</label>
                    </div>
                    <div class="col-sm-7 text-center" >
                        <a href="<?php echo $optional['optionalFile'];?>" target="_blank"><img style="align-content: center;" src="<?php echo $optional['optionalFile'];?>" alt="" height="100" width="auto"></a>
                    </div>
                    <div class="col-sm-2">
                        <div class="row">
                            <div class="col-md-3">
                                <button data-target='#editDocument' data-toggle="modal" class="btn btn-sm btn-info" value="<?php echo $optional['optionalFileId']."_".$optional['passportNum']."_".$optional['passportCreationDate'];?>" id="editVisaFile" onclick="editFile(this.value)"><span class="fas fa-redo"></span></button>
                            </div>
                            <div class="col-md-3">
                                <form action="template/deleteOptionalFile.php" method="post">
                                    <input type="hidden" name="passportNum" value="<?php echo $optional['passportNum'];?>">
                                    <input type="hidden" name="creationDate" value="<?php echo $optional['passportCreationDate'];?>">
                                    <input type="hidden" name="optionalFileId" value="<?php echo $optional['optionalFileId'];?>">
                                    <input type="hidden" name="alter" value="delete">
                                    <button class="btn btn-sm btn-danger"><span class="fa fa-close"></span></button>
                                </form>
                            </div>                        
                        </div>
                    </div>
                </div>        
            </div>
        <?php } 
        } ?> 
    </div>    
</div>
<script>
$('#candidateNav').addClass('active');
function editFile(info){
    info_split = info.split('_');
    $('#optionalFileId').val(info_split[0]);
    $('#passportNum').val(info_split[1]);
    $('#creationDate').val(info_split[2]);
}
</script>