<?php
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
 }else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("VISA", $_SESSION['sections'])){
            if (headers_sent()) {
                die("No Access");
            }else{
                    header("Location: ../index.php");
                    exit();
            } 
        }        
    }
 }
$processingId = base64_decode($_GET['p']);
$candidate_info = mysqli_fetch_assoc($conn->query("SELECT passport.fName, passport.lName, processing.visaStampingDate from processing inner join passport on processing.passportNum = passport.passportNum AND processing.passportCreationDate = passport.creationDate where processing.processingId = $processingId"));
$result = $conn->query("SELECT * from visafile where processingId = $processingId");
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
    <div class="modal fade" tabindex="-1" role="dialog" id="visaStampingDate">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/visaProcessing.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">VISA Stamping Date & VISA</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="processingId" id="processingIdDate">
                        <input type="hidden" name="mode" value="stampingMode">
                        <div class="form-group">
                            <input class="datepicker" autocomplete="off" type="text" name="stampingDate" placeholder="Update Visa Stamping Date">
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
    <!-- Stamping Modal Insert Card -->
    <div class="modal fade" tabindex="-1" role="dialog" id="visaStampingDiv">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/insertVisaFiles.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">VISA Stamping Date & VISA</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="processingId" id="processingIdModal">
                        <div class="form-group" id="visa_file_div">
                            <div class="form-group">
                                <input class="form-control-file" type="file" name="visaFile[]" multiple>
                            </div>
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
    <!-- Stamping Modal For Card Update -->
    <div class="modal fade" tabindex="-1" role="dialog" id="visaStampingEdit">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/visaProcessing.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">VISA File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="visaFileId" id="visaFileId">
                        <input type="hidden" name="file_serial" id="file_serial">
                        <input type="hidden" name="processingId" id="processingId">
                        <input type="hidden" name="mode" value="stampingMode">
                        <div class="form-group">
                            <input class="form-control-file" type="file" name="visaFile[]">
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
        <div class="card-header text-center"> VISA Stamping Documents </div>
        <div class="card-body text-center">
            <p style="font-size: 18px;">Candidate name: <span style="font-size: 23px;"><?php echo $candidate_info['fName']." ".$candidate_info['lName']; ?></span></p>
        </div>
        <hr>
        <div class="card-body text-center">
            <div class="row">
                <div class="col-sm">
                    <p style="font-size: 18px;">Stamping Date: <span style="font-size: 23px;"><button data-toggle="modal" data-target="#visaStampingDate" class="btn btn-info" style="font-size: 15px; padding: 0.5%;" value="<?php echo $processingId; ?>" onclick="sendDateData(this.value)"><?php echo $candidate_info['visaStampingDate']; ?></button></span></p>
                </div>
                <div class="col-sm">
                    <button class="btn btn-info" data-target="#visaStampingDiv" data-toggle="modal" value="<?php echo $processingId; ?>" onclick="stampingFile(this.value)">Add Staming File</button>
                </div>
            </div>
        </div>
        <hr>
        <?php 
        $i = 0 ;
        while($visaFile = mysqli_fetch_assoc($result)){
        ?>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-3">
                    <h5 for="passport">Document #<?php echo $i+1;?></h5>
                </div>
                <div class="col-sm-7 text-center" >
                    <a href="<?php echo $visaFile['visaFile']; ?>" target="_blank"><img style="align-content: center;" src="<?php echo $visaFile['visaFile'];?>" alt="" height="100" width="100"></a>
                </div>
                <div class="col-sm-2 text-center" >
                    <div class="row">
                        <div class="col-md-3">
                            <button data-target='#visaStampingEdit' data-toggle="modal" class="btn btn-sm btn-info" value="<?php echo $visaFile['visaFileId']."_".$visaFile['processingId']."_".$i++;?>" id="editVisaFile" onclick="sendData(this.value)"><span class="fas fa-redo"></span></button>
                        </div>
                        <div class="col-md-3">
                            <form action="template/visaProcessing.php" method="post">
                                <input type="hidden" name="processingId" value="<?php echo $visaFile['processingId'];?>">
                                <input type="hidden" name="mode" value="stampingMode">
                                <input type="hidden" name="alter" value="delete">
                                <input type="hidden" name="visaFileId" value="<?php echo $visaFile['visaFileId'];?>">
                                <button class="btn btn-sm btn-danger"><span class="fa fa-close"></span></button>
                            </form>
                        </div>                        
                    </div>
                </div>
            </div>       
        </div>
        <?php } ?>       
    </div>    
</div>

<script>
function stampingFile(processingId){
    $('#processingIdModal').val(processingId);
}

$('#add_visafile_div').click(function (){
    var visaFileDiv = document.createElement('DIV');
    visaFileDiv.setAttribute('class', 'form-group');
    var input = document.createElement('INPUT');
    input.setAttribute('type', 'file');
    input.setAttribute('name', 'visaFile[]');
    input.setAttribute('class', 'form-control-file');
    visaFileDiv.appendChild(input);
    $('#visa_file_div').append(visaFileDiv);    
});
$('#remove_visafile_div').click(function (){
    $('#visa_file_div').children().last().remove();  
});
function sendData(visaId){
    visaId = visaId.split('_');
    $('#visaFileId').val(visaId[0]);
    $('#processingId').val(visaId[1]);
    $('#file_serial').val(visaId[2]);
};

function sendDateData(processingId){
    $('#processingIdDate').val(processingId);
};
$('#visaNav').addClass('active');
</script>