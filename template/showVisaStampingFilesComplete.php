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
$candidate_info = mysqli_fetch_assoc($conn->query("SELECT passportcompleted.fName, passportcompleted.lName, processingcompleted.visaStampingDate from processingcompleted inner join passportcompleted on processingcompleted.passportNum = passportcompleted.passportNum AND processingcompleted.passportCreationDate = passportcompleted.creationDate where processingcompleted.processingId = $processingId"));
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
    <div class="card">
        <div class="card-header text-center"> VISA Stamping Documents </div>
        <div class="card-body text-center">
            <p style="font-size: 18px;">Candidate name: <span style="font-size: 23px;"><?php echo $candidate_info['fName']." ".$candidate_info['lName']; ?></span></p>
        </div>
        <hr>
        <div class="card-body text-center">
            <p style="font-size: 18px;">Stamping Date: <span style="font-size: 23px;"><button class="btn btn-info" style="font-size: 15px; padding: 0.5%;" value="<?php echo $processingId; ?>" onclick="sendDateData(this.value)"><?php echo $candidate_info['visaStampingDate']; ?></button></span></p>
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
                <div class="col-sm-8 text-center" >
                    <a href="<?php echo $visaFile['visaFile']; ?>" target="_blank"><img style="align-content: center;" src="<?php echo $visaFile['visaFile'];?>" alt="" height="100" width="100"></a>
                </div>
            </div>       
        </div>
        <?php } ?>       
    </div>    
</div>

<script>

function sendData(visaId){
    visaId = visaId.split('_');
    $('#visaFileId').val(visaId[0]);
    $('#processingId').val(visaId[1]);
    $('#file_serial').val(visaId[2]);
};

function sendDateData(processingId){
    $('#processingIdDate').val(processingId);
};
window.onload = function() {
    $('#visaNav').addClass('active');
};
$('#visaNav').addClass('active');
</script>