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
?>
<style>
    .btn{
        font-size: 11px;
    }
    .indicator{
        font-size: 16px;
        font-weight: bold;
    }
    .indicator.green{
        border: 5px #66bb6a solid;
    }
    .indicator.blue{
        border: 5px #42a5f5 solid;
    }
    .indicator.red{
        border: 5px #f44336 solid;
    }
    .indicator.black{
        border: 5px #424242 solid;
    }
    .indicator.hold{
        border: 5px #f9a825  solid;
    }
</style>
<div class="container-fluid" style="padding: 2%">

    <!-- Return or complete or hold -->
    <div class="modal fade" tabindex="-1" role="dialog" id="returnCandidate">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/returnCandidateQry.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Return Or Complete Or Hold</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="processingIdModalReturn" name="processingId">
                        <input type="hidden" name="href" value="visaList">
                        <div class="row justify-content-center">
                            <div class="col-sm">
                                <button type="submit" class="btn btn-success" value="complete" name="complete">Complete</button>
                            </div>
                            <div class="col-sm">
                                <button type="submit" class="btn btn-danger" value="return" name="return">Return</button>
                            </div>
                            <div class="col-sm" id="hold">
                            </div>
                        </div>                   
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Add delegate Comission -->
    <div class="modal fade" tabindex="-1" role="dialog" id="delegateComissionCandidate">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/addDelegateComission.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delegate Comission Amount</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="passportNum" id="passportNumDelegateExpenseInfo">
                        <input type="hidden" name="creationDate" id="creationDateDelegateExpenseInfo">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="delegateExpenseAmount">Delegate Comission</label>
                                    <input class="form-control" type="number" name="delegateExpenseAmount" id="delegateExpenseAmountModal" placeholder="Enter Delegate Comission" onkeyup="calculateBDT()">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dollarRate">Dollar Rate</label>
                                    <input class="form-control" type="number" name="dollarRate" id="dollarRateModal" placeholder="Dollar Rate" onkeyup="calculateBDT()" step="any">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="bdtAmount">Amount in BDT</label>
                                    <input class="form-control" type="number" name="bdtAmount" id="bdtAmountModal" placeholder="BDT" readonly>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="delegateModalButton"></button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Manpower Card Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="manpowerFileSubmit">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/visaProcessing.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Give Manpower Card</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="processingId" id="processingIdManpower">
                        <input type="hidden" name="passportNum" id="passportNumManpower">
                        <input type="hidden" name="sponsorVisa" id="sponsorVisaManpower">
                        <input type="hidden" name="manpowerCard" id="manpowerCard">
                        <input type="hidden" name="mode" value="manpowerMode">
                        <input class="form-control" type="file" name="manpowerCard">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Okala Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="okalaFileSubmit">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/visaProcessing.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Give Okala Card</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="processingId" id="processingIdOkala">
                        <input type="hidden" name="passportNum" id="passportNumOkala">
                        <input type="hidden" name="sponsorVisa" id="sponsorVisaOkala">
                        <input type="hidden" name="mode" value="okalaMode">
                        <input class="form-control" type="file" name="okalaCard">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Mufa Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="mufaFileSubmit">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/visaProcessing.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Give MUFA Card</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="processingId" id="processingIdMufa">
                        <input type="hidden" name="mode" value="mufaMode">
                        <input class="form-control" type="file" name="mufaCard">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Training Card Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="trainingCardFileSubmit">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/visaProcessing.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Give Training Card</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="passportNum" id="passportNumCard">
                        <input type="hidden" name="mode" value="trainingCardMode">
                        <input class="form-control" type="file" name="trainingCard">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Youtube -->
    <div class="modal fade" tabindex="-1" role="dialog" id="youtube">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/enterYoutube.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Youtube Link</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="processingId" id="processingIdModal">
                        <label for="youtube">Enter YouTube Link</label>
                        <input class="form-control" type="text" name="youtube" placeholder="Give Link">
                        
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- VISA exchange -->
    <div class="modal fade" tabindex="-1" role="dialog" id="visaExchange">
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

                        <input type="hidden" name="passportNum" id="passportNum">
                        <input type="hidden" name="sponsorVisa" id="sponsorVisa">
                        <input type="hidden" name="mode" value="stampingMode">
                        <div class="form-group">
                            <input class="datepicker" autocomplete="off" type="text" name="stampingDate">
                        </div>
                        <div>
                            <input class="form-control-file" type="file" name="visaFile">
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

    <!-- Stamping Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="visaStampingDiv">
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
                        <input type="hidden" name="processingId" id="processingIdModalThree">
                        <input type="hidden" name="mode" value="stampingMode">
                        <div class="form-group">
                            <input class="datepicker" autocomplete="off" type="text" name="stampingDate" placeholder="Enter Visa Stamping Date">
                        </div>
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
    <!-- Disable Candidate -->
    <div class="modal fade" tabindex="-1" role="dialog" id="disableCandidate">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/disableCandidate.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Disable Candidate</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="href" value="visaList">
                        <input type="hidden" name="passportNum" id="passportNumDisableModal">
                        <input type="hidden" name="creationDate" id="creationDateDisableModal">
                        <label for="reason">Reason For Disabling</label>
                        <input class="form-control" type="text" name="reason" placeholder="Enter Reason">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" name="disable">Disable</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Show Disable Candidate -->
    <div class="modal fade" tabindex="-1" role="dialog" id="disableCandidateReason">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/disableCandidate.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Disable Candidate</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="href" value="visaList">
                        <input type="hidden" name="passportNum" id="passportNumEnableModal">
                        <input type="hidden" name="creationDate" id="creationDateEnableModal">
                        <label for="reason">Reason For Disabling</label>
                        <p id="reasonModal"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" name="enable">Enable</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            <div class="section-header">
                <h2>All Visa Information</h2>
            </div>
            <div class="row justify-content-md-center text-center">
                <div class="col-md-1">
                    <div class="indicator hold">On Hold</div>
                </div>
            </div>
        </div>
    
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTableSeaum" class="table table-bordered table-hover"  style="width:100%">
                    <thead>
                    <tr>
                        <th>Passport Name</th>
                        <th>Passport Number</th>                               
                        <th>Visa No</th>
                        <th>ID No</th>
                        <th>Employee Request</th>
                        <th>Foreign Mole</th>
                        <th>Okala</th>
                        <th>Mufa</th>
                        <th>Update Medical</th>
                        <th>VISA Stamping</th>
                        <th>Finger</th>
                        <th>Training Card</th>
                        <th>Manpower Card</th>
                        <th>Flight Date</th>
                        <th>Options</th>
                    </tr>
                    </thead>
                    <?php
                    if(isset($_GET['pi'])){
                        $processingId = base64_decode($_GET['pi']);
                        $result = $conn->query("SELECT sponsor.sponsorName, jobs.creditType, passport.oldVisa, passport.creationDate as passportCreationDate, passport.disableReason, passport.delegateComission, passport.dollarRate,  passport.country, passport.agentEmail, passport.fName, passport.lName, passport.passportNum, passport.status, sponsorvisalist.sponsorNID, sponsorvisalist.visaGenderType, sponsorvisalist.jobId , sponsorvisalist.visaAmount, agent.agentName, processing.* from processing INNER JOIN passport on passport.passportNum = processing.passportNum AND passport.creationDate = processing.passportCreationDate INNER JOIN jobs on jobs.jobId = passport.jobId INNER JOIN sponsorvisalist USING (sponsorVisa) INNER JOIN sponsor on sponsor.sponsorNID = sponsorvisalist.sponsorNID INNER JOIN agent on agent.agentEmail = passport.agentEmail where processing.processingId = $processingId");
                    }else{
                        $result = $conn->query("SELECT sponsor.sponsorName, jobs.creditType, passport.oldVisa, passport.creationDate as passportCreationDate, passport.disableReason, passport.delegateComission, passport.dollarRate, passport.country, passport.agentEmail, passport.fName, passport.lName, passport.passportNum, passport.status, sponsorvisalist.sponsorNID, sponsorvisalist.visaGenderType, sponsorvisalist.jobId , sponsorvisalist.visaAmount, agent.agentName, processing.* from processing INNER JOIN passport on passport.passportNum = processing.passportNum AND passport.creationDate = processing.passportCreationDate INNER JOIN jobs on jobs.jobId = passport.jobId INNER JOIN sponsorvisalist USING (sponsorVisa) INNER JOIN sponsor on sponsor.sponsorNID = sponsorvisalist.sponsorNID INNER JOIN agent on agent.agentEmail = passport.agentEmail order by creationDate desc");
                    }
                    $status = "pending";
                    while($visa = mysqli_fetch_assoc($result)){ 
                        if($visa['status'] == '2'){ ?>
                            <tr style="background-color: #616161; color: white">
                        <?php }else if($visa['status'] == '1'){ ?>
                            <tr style="background-color: #f9a825 ;">
                        <?php }else{ ?>
                            <tr>
                        <?php }?>
                            <td>
                            <?php echo $visa['fName']." ".$visa['lName'];?>
                            <p><a href="?page=agentList&agE=<?php echo base64_encode($visa['agentEmail']);?>"><?php echo $visa['agentName'];?></a></p>
                            </td>
                            <td><a href="?page=listCandidate&pp=<?php echo base64_encode($visa['passportNum']);?>&cd=<?php echo base64_encode($visa['passportCreationDate']);?>"><?php echo $visa['passportNum'];?></a></td>
                            <td><a href="?page=allVisaList&sv=<?php echo base64_encode($visa['sponsorVisa'])?>"><?php echo $visa['sponsorVisa'];?></a></td>
                            <td><?php echo $visa['sponsorNID'].'<br>'; ?>
                            <a href="?page=sponsorList&spN=<?php echo base64_encode($visa['sponsorNID']); ?>"><span style="font-size: 11px;"><?php echo $visa['sponsorName'];?></span></a></td>
                            <!-- Employee Request -->
                            <td class="first"><?php 
                            if(strtolower($visa['country']) == 'saudi arabia'){
                                if(empty($visa['empRqst']) || $visa['empRqst']=='no'){ ?>
                                    <form action="template/visaProcessing.php" method="post">
                                        <input type="hidden" name="passportNum" value="<?php echo $visa['passportNum'];?>">
                                        <input type="hidden" name="sponsorVisa" value="<?php echo $visa['sponsorVisa'];?>">
                                        <input type="hidden" name="mode" value="empRqstMode">
                                        <button class="btn btn-secondary btn-sm" value="yes" name="empRqst">No</button>
                                    </form>
                                <?php } else { ?>
                                    <form action="template/visaProcessing.php" method="post">
                                        <input type="hidden" name="passportNum" value="<?php echo $visa['passportNum'];?>">
                                        <input type="hidden" name="sponsorVisa" value="<?php echo $visa['sponsorVisa'];?>">
                                        <input type="hidden" name="mode" value="empRqstMode">
                                        <button class="btn btn-primary btn-sm" value="no" name="empRqst">Done</button>
                                    </form>
                                <?php } 
                            }else{
                                echo " - ";
                            }?></td>

                            <!-- Foreign MOLE -->
                            <td class="first"><?php
                            if(strtolower($visa['country']) == 'saudi arabia'){
                                if(empty($visa['empRqst']) || $visa['empRqst']=='no'){ ?>
                                    <button class="btn btn-warning btn-sm">Do Previous</button>
                                <?php }else if(empty($visa['foreignMole']) || $visa['foreignMole']=='no'){ ?>
                                    <form action="template/visaProcessing.php" method="post">
                                        <input type="hidden" name="passportNum" value="<?php echo $visa['passportNum'];?>">
                                        <input type="hidden" name="sponsorVisa" value="<?php echo $visa['sponsorVisa'];?>">
                                        <input type="hidden" name="mode" value="foreignMoleMode">
                                        <button class="btn btn-secondary btn-sm" value="yes" name="foreignMole">No</button>
                                    </form>
                                <?php } else { ?>
                                    <form action="template/visaProcessing.php" method="post">
                                        <input type="hidden" name="passportNum" value="<?php echo $visa['passportNum'];?>">
                                        <input type="hidden" name="sponsorVisa" value="<?php echo $visa['sponsorVisa'];?>">
                                        <input type="hidden" name="mode" value="foreignMoleMode">
                                        <button class="btn btn-primary btn-sm" value="no" name="foreignMole">Done</button>
                                    </form>
                                <?php } 
                            }else{
                                echo " - ";
                            }?></td>

                            <!-- Okala -->
                            <td class="first">
                            <?php if(strtolower($visa['country']) == 'saudi arabia'){?>                          
                                <?php if(empty($visa['foreignMole']) || $visa['foreignMole']=='no'){ ?>
                                    <button class="btn btn-warning btn-sm">Do Previous</button>
                                <?php }else{?>
                                <div class="row">
                                    <?php if(empty($visa['okala']) || $visa['okala']=='no'){ ?>
                                        <div class="col-sm-3">
                                            <button class="btn btn-secondary btn-sm" type="button" value="<?php echo $visa['processingId'];?>" name="okala" data-toggle="modal" data-target="#okalaFileSubmit" onclick="okalaFileSubmit(this.value)">No</button>
                                        </div>
                                    <?php } else { ?>                                
                                        <div class="col-sm-3">
                                            <button class="btn btn-danger btn-sm" type="button" value="<?php echo $visa['processingId'];?>" name="okala" data-toggle="modal" data-target="#okalaFileSubmit" onclick="okalaFileSubmit(this.value)"><span class="fas fa-redo"></span></button>                                    
                                        </div>
                                        <div class="col-sm-3">
                                            <a href="<?php echo $visa['okalaFile'];?>" target="_blank"><button class="btn btn-info btn-sm" type="button"><span class="fas fa-search"></span></button></a>
                                        </div>                                                       
                                    <?php } ?>
                                    <?php if($visa['creditType'] != 'Paid'){ ?>
                                        <div class="col-sm-3">
                                            <form action="index.php" method="post">
                                                <input type="hidden" name="pagePost" value="addCandidatePayment">
                                                <input type="hidden" name="purpose" value="Okala">
                                                <input type="hidden" name="candidateName" value="<?php echo $visa['fName']." ".$visa['lName'];?>">
                                                <input type="hidden" name="passport_info" value="<?php echo $visa['passportNum']."_".$visa['passportCreationDate'];?>">
                                                <input type="hidden" name="agentEmail" value="<?php echo $visa['agentEmail'];?>">
                                                <button class="btn btn-sm btn-success" type="submit" id="add_visa" ><span class="fas fa-plus" aria-hidden="true"></span></button>
                                            </form>
                                        </div>
                                    <?php } ?>
                                </div>
                                <?php } ?></td> 
                            <?php }else{
                                echo " - ";
                            }?>                      
                            <!-- MUFA -->
                            <td class="first"><?php
                            if(strtolower($visa['country']) == 'saudi arabia'){
                                if(empty($visa['okala']) || $visa['okala']=='no'){ ?>
                                    <button class="btn btn-warning btn-sm">Do Previous</button>
                                <?php }else{?>
                                    <div class="row">
                                        <?php if(empty($visa['mufa']) || $visa['mufa']=='no'){ ?>
                                            <div class="col-sm-3">
                                                <button class="btn btn-secondary btn-sm" value="<?php echo $visa['processingId'];?>" name="mufa" data-toggle="modal" data-target="#mufaFileSubmit" onclick="mufaFileSubmit(this.value)">No</button>
                                            </div>
                                        <?php } else { ?>                                    
                                                <div class="col-sm-3">
                                                    <button class="btn btn-danger btn-sm" value="<?php echo $visa['processingId'];?>" name="mufa" data-toggle="modal" data-target="#mufaFileSubmit" onclick="mufaFileSubmit(this.value)"><span class="fas fa-redo"></span></button>
                                                </div>
                                                <div class="col-sm-3">
                                                    <a href="<?php echo $visa['mufaFile'];?>" target="_blank"><button class="btn btn-info btn-sm" type="button"><span class="fas fa-search"></span></button></a>
                                                </div>
                                        <?php } ?>
                                        <?php if($visa['creditType'] != 'Paid'){ ?>
                                            <div class="col-sm-3">
                                                <form action="index.php" method="post">
                                                    <input type="hidden" name="pagePost" value="addCandidatePayment">
                                                    <input type="hidden" name="purpose" value="MUFA">
                                                    <input type="hidden" name="candidateName" value="<?php echo $visa['fName']." ".$visa['lName'];?>">
                                                    <input type="hidden" name="passport_info" value="<?php echo $visa['passportNum']."_".$visa['passportCreationDate'];?>">
                                                    <input type="hidden" name="agentEmail" value="<?php echo $visa['agentEmail'];?>">
                                                    <button class="btn btn-sm btn-success" type="submit" id="add_visa" ><span class="fas fa-plus" aria-hidden="true"></span></button>
                                                </form>
                                            </div>
                                        <?php } ?>
                                    </div>
                                <?php } 
                                }else{
                                    echo " - ";
                            }?></td>

                            <!-- Update Medical -->
                            <td class="second"><?php
                            if(strtolower($visa['country']) == 'saudi arabia'){
                                if(empty($visa['mufa']) || $visa['mufa']=='no'){ ?>
                                    <button class="btn btn-warning btn-sm">Do Previous</button>
                                <?php }else if(empty($visa['medicalUpdate']) || $visa['medicalUpdate']=='no'){ ?>
                                    <form action="template/visaProcessing.php" method="post">
                                        <input type="hidden" name="passportNum" value="<?php echo $visa['passportNum'];?>">
                                        <input type="hidden" name="sponsorVisa" value="<?php echo $visa['sponsorVisa'];?>">
                                        <input type="hidden" name="mode" value="updateMedicalMode">
                                        <button class="btn btn-secondary btn-sm" value="yes" name="updateMedical">No</button>
                                    </form>
                                <?php } else { ?>
                                    <form action="template/visaProcessing.php" method="post">
                                        <input type="hidden" name="passportNum" value="<?php echo $visa['passportNum'];?>">
                                        <input type="hidden" name="sponsorVisa" value="<?php echo $visa['sponsorVisa'];?>">
                                        <input type="hidden" name="mode" value="updateMedicalMode">
                                        <button class="btn btn-primary btn-sm" value="no" name="updateMedical">Done</button>
                                    </form>
                                <?php } 
                            }else{
                                echo " - ";
                            }?></td>

                            <!-- VISA Stamping -->
                            <td class="third"><?php
                            if(strtolower($visa['country']) == 'saudi arabia'){
                                if(empty($visa['medicalUpdate']) || $visa['medicalUpdate']=='no'){ ?>
                                    <button class="btn btn-warning btn-sm">Do Previous</button>
                                <?php }else if(empty($visa['visaStamping']) || $visa['visaStamping']=='no'){ ?>
                                    <button class="btn btn-secondary btn-sm" data-target="#visaStampingDiv" data-toggle="modal" id="stampingButton" value="<?php echo $visa['processingId'];?>" onclick="visaStamping(this.value)">Enter VISA</button>
                                <?php } else { ?>                            
                                    <div class="row">  
                                        <div class="col-md-3">
                                            <a href="?page=svf&p=<?php echo base64_encode($visa['processingId']);?>" target="_blank"><button class="btn btn-sm btn-info"><?php echo $visa['visaStampingDate'];?></button></a>
                                        </div>                              
                                    </div>
                                    <div class="row">
                                        
                                    </div>
                                <?php }
                            }else{
                                if(empty($visa['visaStamping']) || $visa['visaStamping']=='no'){ ?>
                                    <button class="btn btn-secondary btn-sm" data-target="#visaStampingDiv" data-toggle="modal" id="stampingButton" value="<?php echo $visa['processingId'];?>" onclick="visaStamping(this.value)">Enter VISA</button>
                                <?php } else { ?>                            
                                    <div class="row">  
                                        <div class="col-md-3">
                                            <a href="?page=svf&p=<?php echo base64_encode($visa['processingId']);?>" target="_blank"><button class="btn btn-sm btn-info"><?php echo $visa['visaStampingDate'];?></button></a>
                                        </div>                              
                                    </div>
                                    <div class="row">
                                        
                                    </div>
                                <?php }
                            } ?></td>

                            <!-- Finger -->
                            <td class="third"><?php
                            if(empty($visa['visaStamping']) || $visa['visaStamping']=='no'){ ?>
                                <button class="btn btn-warning btn-sm">Do Previous</button>
                            <?php }else{ ?>
                                <div class="row">
                                <?php if(empty($visa['finger']) || $visa['finger']=='no'){ ?>
                                    <div class="col-md-4">
                                        <form action="template/visaProcessing.php" method="post">
                                            <input type="hidden" name="passportNum" value="<?php echo $visa['passportNum'];?>">
                                            <input type="hidden" name="sponsorVisa" value="<?php echo $visa['sponsorVisa'];?>">
                                            <input type="hidden" name="mode" value="fingerMode">
                                            <button class="btn btn-secondary btn-sm" value="yes" name="finger">No</button>
                                        </form>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-md-6">
                                        <form action="template/visaProcessing.php" method="post">
                                            <input type="hidden" name="passportNum" value="<?php echo $visa['passportNum'];?>">
                                            <input type="hidden" name="sponsorVisa" value="<?php echo $visa['sponsorVisa'];?>">
                                            <input type="hidden" name="mode" value="fingerMode">
                                            <button class="btn btn-primary btn-sm" value="no" name="finger">Done</button>
                                        </form>
                                    </div>
                                <?php } ?>
                                <?php if($visa['creditType'] != 'Paid'){ ?>
                                    <div class="col-md-3">
                                        <form action="index.php" method="post">
                                            <input type="hidden" name="pagePost" value="addCandidatePayment">
                                            <input type="hidden" name="purpose" value="Finger">
                                            <input type="hidden" name="candidateName" value="<?php echo $visa['fName']." ".$visa['lName'];?>">
                                            <input type="hidden" name="passport_info" value="<?php echo $visa['passportNum']."_".$visa['passportCreationDate'];?>">
                                            <input type="hidden" name="agentEmail" value="<?php echo $visa['agentEmail'];?>">
                                            <button class="btn btn-sm btn-success" type="submit" id="add_visa" ><span class="fas fa-plus" aria-hidden="true"></span></button>
                                        </form>
                                    </div>
                                <?php } ?>
                                </div>
                            <?php } ?>
                            </td>

                            <!-- Training Card -->
                            <td>
                            <?php $trainingCard = mysqli_fetch_assoc($conn->query("SELECT trainingCard, trainingCardFile, departureSeal from passport where passportNum = '".$visa['passportNum']."' AND creationDate = '".$visa['passportCreationDate']."'"));?>
                            <?php if( $trainingCard['departureSeal'] == 'yes'){ ?>
                                <a href="?page=cI&p=<?php echo base64_encode($visa['passportNum'])."&cd=.".base64_encode($visa['passportCreationDate'])."&t=".time();?>"><p class="text-center">Experienced</p></a>
                            <?php }else{ ?>
                                <?php if(empty($visa['finger']) || $visa['finger'] == 'no'){ ?>
                                    <button class="btn btn-warning btn-sm">Do Previous</button>
                                <?php }else{ ?>
                                    <div class="row">
                                    <?php if(empty($trainingCard['trainingCard']) || $trainingCard['trainingCard'] == 'no'){ ?>
                                        <div class="col-sm-3">
                                            <button class="btn btn-secondary btn-sm" value="<?php echo $visa['passportNum']."-".$visa['sponsorVisa'];?>" id="enterCard" data-target="#trainingCardFileSubmit" data-toggle="modal" onclick="trainingCard(this.value)">No</button>                                
                                        </div>
                                    <?php }else{ ?>
                                            <div class="col-sm-3">
                                                <button class="btn btn-danger btn-sm" value="<?php echo $visa['passportNum']."-".$visa['sponsorVisa'];?>" id="enterCard" data-target="#trainingCardFileSubmit" data-toggle="modal" onclick="trainingCard(this.value)"><span class="fas fa-redo"></span></button>
                                            </div>
                                            <div class="col-sm-3">                                                     
                                                <a href="<?php echo $trainingCard['trainingCardFile'];?>" target="_blank"><button class="btn btn-info btn-sm"><span class="fas fa-search"></span></button></a>
                                            </div>
                                    <?php } ?>
                                        <?php if($visa['creditType'] != 'Paid'){ ?>
                                            <div class="col-sm-3">
                                                <form action="index.php" method="post">
                                                    <input type="hidden" name="pagePost" value="addCandidatePayment">
                                                    <input type="hidden" name="purpose" value="Training Card">
                                                    <input type="hidden" name="candidateName" value="<?php echo $visa['fName']." ".$visa['lName'];?>">
                                                    <input type="hidden" name="passport_info" value="<?php echo $visa['passportNum']."_".$visa['passportCreationDate'];?>">
                                                    <input type="hidden" name="agentEmail" value="<?php echo $visa['agentEmail'];?>">
                                                    <button class="btn btn-sm btn-success" type="submit" id="add_visa" ><span class="fas fa-plus" aria-hidden="true"></span></button>
                                                </form>
                                            </div>
                                        <?php } ?>
                                    </div>
                                <?php } ?></td>
                            <?php }?>
                            
                            <!-- Manpower Card -->
                            <td>
                                <?php if($trainingCard['departureSeal'] != 'yes'){?>
                                    <?php if(empty($trainingCard['trainingCard']) || $trainingCard['trainingCard'] == 'no' || empty($visa['finger']) || $visa['finger'] == 'no'){ ?>
                                        <button class="btn btn-warning btn-sm">Do Previous</button>
                                    <?php }else{ ?>
                                        <div class="row">
                                            <?php if(empty($visa['manpowerCard']) || $visa['manpowerCard'] == 'no'){ ?>
                                                <div class="col-sm-3">
                                                    <button class="btn btn-secondary btn-sm" value="<?php echo $visa['processingId'];?>" id="enterCard" data-target="#manpowerFileSubmit" data-toggle="modal" onclick="manpowerFileSubmit(this.value)">No</button>
                                                </div>
                                            <?php }else{ ?>
                                                <div class="col-sm-3">
                                                    <button class="btn btn-danger btn-sm" value="<?php echo $visa['processingId'];?>" id="enterCard" data-target="#manpowerFileSubmit" data-toggle="modal" onclick="manpowerFileSubmit(this.value)"><span class="fas fa-redo"></span></button>
                                                </div>
                                                <div class="col-sm-3">
                                                    <a href="<?php echo $visa['manpowerCardFile'];?>" target="_blank"><button class="btn btn-sm btn-info"><span class="fas fa-search"></span></button></a>
                                                </div>
                                            <?php } ?>
                                            <?php if($visa['creditType'] != 'Paid'){ ?>
                                                <div class="col-sm-3">
                                                    <form action="index.php" method="post">
                                                        <input type="hidden" name="pagePost" value="addCandidatePayment">
                                                        <input type="hidden" name="purpose" value="Manpower">
                                                        <input type="hidden" name="candidateName" value="<?php echo $visa['fName']." ".$visa['lName'];?>">
                                                        <input type="hidden" name="passport_info" value="<?php echo $visa['passportNum']."_".$visa['passportCreationDate'];?>">
                                                        <input type="hidden" name="agentEmail" value="<?php echo $visa['agentEmail'];?>">
                                                        <button class="btn btn-sm btn-success" type="submit" id="add_visa" ><span class="fas fa-plus" aria-hidden="true"></span></button>
                                                    </form>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                <?php }else{ ?>
                                    <div class="row">
                                        <?php if(empty($visa['manpowerCard']) || $visa['manpowerCard'] == 'no'){ ?>
                                            <div class="col-sm-3">
                                                <button class="btn btn-secondary btn-sm" value="<?php echo $visa['processingId'];?>" id="enterCard" data-target="#manpowerFileSubmit" data-toggle="modal" onclick="manpowerFileSubmit(this.value)">No</button>
                                            </div>
                                        <?php }else{ ?>
                                            <div class="col-sm-3">
                                                <button class="btn btn-danger btn-sm" value="<?php echo $visa['processingId'];?>" id="enterCard" data-target="#manpowerFileSubmit" data-toggle="modal" onclick="manpowerFileSubmit(this.value)"><span class="fas fa-redo"></span></button>
                                            </div>
                                            <div class="col-sm-3">
                                                <a href="<?php echo $visa['manpowerCardFile'];?>" target="_blank"><button class="btn btn-sm btn-info"><span class="fas fa-search"></span></button></a>
                                            </div>
                                        <?php } ?>
                                        <?php if($visa['creditType'] != 'Paid'){ ?>
                                            <div class="col-sm-3">
                                                <form action="index.php" method="post">
                                                    <input type="hidden" name="pagePost" value="addCandidatePayment">
                                                    <input type="hidden" name="purpose" value="Manpower">
                                                    <input type="hidden" name="candidateName" value="<?php echo $visa['fName']." ".$visa['lName'];?>">
                                                    <input type="hidden" name="passport_info" value="<?php echo $visa['passportNum']."_".$visa['passportCreationDate'];?>">
                                                    <input type="hidden" name="agentEmail" value="<?php echo $visa['agentEmail'];?>">
                                                    <button class="btn btn-sm btn-success" type="submit" id="add_visa" ><span class="fas fa-plus" aria-hidden="true"></span></button>
                                                </form>
                                            </div>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </td>

                            <!-- Ticket information -->
                            <td class="third"><?php
                                $ticket = mysqli_fetch_assoc($conn->query("SELECT ticketId, flightDate, count(ticketId) as existTicket from ticket where passportNum = '".$visa['passportNum']."' AND passportCreationDate = '".$visa['passportCreationDate']."'"));
                                if(empty($visa['manpowerCard']) || $visa['manpowerCard'] == 'no'){ ?>
                                    <button class="btn btn-warning btn-sm">Do Previous</button>
                                <?php }else if($ticket['existTicket'] == 0){ ?>
                                    <a href="?page=newTicket&p=<?php echo base64_encode($visa['passportNum'])?>&cd=<?php echo base64_encode($visa['passportCreationDate'])?>"><button class="btn btn-secondary btn-sm">No Ticket</button></a>
                                <?php } else { 
                                    $ticketId = base64_encode($ticket['ticketId']);
                                ?>
                                <input type="hidden" name="pagePost" value="ticketInfo">
                                <a href="?page=tN&tI=<?php echo $ticketId; ?>" target="_blank">
                                    <button class="btn btn-info btn-sm">
                                        <?php echo $ticket['flightDate']; ?>
                                    </button>
                                </a>
                                <?php if($visa['pending'] == 0){ ?>
                                <form class="mt-1" action="template/sendToPendingList.php" method="post">
                                    <input type="hidden" name="passportNum" value="<?php echo $visa['passportNum'] ?>">
                                    <input type="hidden" name="passportCreationDate" value="<?php echo $visa['passportCreationDate'] ?>">
                                    <button class="btn btn-sm btn-secondary"><i class="fas fa-plane"></i></button>
                                </form>
                                <?php }else{ ?>
                                    <button type="button" class="btn btn-sm btn-success mt-1"><i class="fas fa-plane"></i></button>
                                <?php } ?>
                            <?php } ?></td> 

                            <!-- options -->
                            <td>
                                <div class="row">
                                    <?php if($visa['youtube'] == ''){ ?>
                                        <abbr title="Add YouTube Link"><button data-toggle="modal" data-target="#youtube" class="btn btn-sm btn-warning ml-1 mt-1" value="<?php echo $visa['processingId'];?>" onclick="youtubeLink(this.value)"><i class="fab fa-youtube"></i></button></abbr>
                                    <?php }else{ ?>
                                        <abbr title="Go to YouTube"><a href="<?php echo $visa['youtube'] ?>" target="_blank"><button data-toggle="modal" data-target="#youtube" class="btn btn-sm btn-success ml-1 mt-1"><i class="fab fa-youtube"></i></button></a></abbr>
                                    <?php } ?>
                                    <div class="ml-1 mt-1">
                                        <abbr title="Show Expenseces of Candidate"><a href="?page=ce<?php echo "&pn=".base64_encode($visa['passportNum'])."&cd=".base64_encode($visa['passportCreationDate']); ?>" target="_blank"><button class="btn btn-sm btn-info" type="button" id="add_visa" ><span class="fa fa-dollar" aria-hidden="true"></span></button></a></abbr>
                                    </div>
                                    <form class="ml-1 mt-1" action="index.php" method="post">
                                        <input type="hidden" name="pagePost" value="exchangeVisa">
                                        <input type="hidden" name="info" value="<?php echo $visa['fName']."-".$visa['lName']."-".$visa['processingId']."-".$visa['sponsorVisa']."-".$visa['visaAmount']."-".$visa['visaGenderType'];?>">
                                        <abbr title="Exchange VISA"><button class="btn btn-danger btn-sm"><span class="fas fa-exchange-alt"></span></button></abbr>
                                    </form>                                    
                                    <form class="ml-1 mt-1" action="template/saveVisa.php" method="post">
                                        <input type="hidden" name="alter" value="delete">
                                        <input type="hidden" name="processingId" value="<?php echo $visa['processingId'];?>">
                                        <abbr title="Delete Candidate VISA"><button class="btn btn-sm btn-danger"><span class="fa fa-close"></span></button></a></abbr>
                                    </form>
                                    <div class="ml-1 mt-1">
                                        <form action="index.php" method="post">
                                            <input type="hidden" name="redir" value="visaList">
                                            <input type="hidden" name="pagePost" value="addCandidatePayment">
                                            <input type="hidden" name="purpose" value="">
                                            <input type="hidden" name="notAdvance" value="notAdvance">
                                            <input type="hidden" name="candidateName" value="<?php echo $visa['fName']." ".$visa['lName'];?>">
                                            <input type="hidden" name="passport_info" value="<?php echo $visa['passportNum']."_".$visa['passportCreationDate'];?>">
                                            <input type="hidden" name="agentEmail" value="<?php echo $visa['agentEmail'];?>">
                                            <abbr title="Extra Expense"><button class="btn btn-sm btn-success" type="submit" id="add_visa" ><span class="fas fa-plus" aria-hidden="true"></span></button></abbr>
                                        </form>
                                    </div>
                                    <div class="ml-1 mt-1">
                                        <?php if($visa['delegateComission'] == 0){ ?>
                                            <abbr title="Add Delegate Comission"><button class="btn btn-dark btn-sm" data-toggle="modal" data-target="#delegateComissionCandidate" value="<?php echo $visa['passportNum']."_".$visa['passportCreationDate'];?>" onclick="addDelegateExpense(this.value)"><span class="fa fa-dollar" aria-hidden="true"><span class="fa fa-plus" aria-hidden="true"></span></span></button></abbr>
                                        <?php }else{ ?>
                                            <abbr title="Edit Delegate Comission"><button class="btn btn-success btn-sm" data-toggle="modal" data-target="#delegateComissionCandidate" value="<?php echo $visa['passportNum']."_".$visa['passportCreationDate']."_".$visa['delegateComission']."_".$visa['dollarRate'];?>" onclick="editDelegateExpense(this.value)"><span class="fa fa-dollar" aria-hidden="true"><span class="fa fa-check" aria-hidden="true"></span></span></button></abbr>
                                        <?php } ?>                                            
                                    </div>
                                    <div class="ml-1 mt-1">
                                        <abbr title="Return or Complete candidate"><button data-target="#returnCandidate" data-toggle="modal" class="btn btn-sm btn-danger" type="button" value="<?php echo $visa['processingId']."_".$visa['status'] ?>" onclick="getReturnValue(this.value)"><i class="fas fa-user-times"></i></button></abbr>
                                    </div>
                                    <div class="ml-1 mt-1">
                                    <?php if($visa['status'] != 2){ ?>
                                        <abbr title="Disable candidate"><button data-target="#disableCandidate" data-toggle="modal" class="btn btn-sm btn-danger" type="button" value="<?php echo $visa['passportNum']."_".$visa['passportCreationDate'] ?>" onclick="getDisableValue(this.value)"><i class="fas fa-ban"></i></button></abbr>
                                    <?php }else{ ?>
                                        <abbr title="Show Disable Reason"><button data-target="#disableCandidateReason" data-toggle="modal" class="btn btn-sm btn-success" type="button" value="<?php echo $visa['passportNum']."_".$visa['passportCreationDate']."_".$visa['disableReason'] ?>" onclick="showDisableValue(this.value)"><i class="fas fa-ban"></i></button></abbr>
                                    <?php } ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    <tfoot>
                    <tr hidden>
                        <th>Passport Name</th>
                        <th>Passport Number</th>                               
                        <th>Visa No</th>
                        <th>ID No</th>
                        <th>Employee Request</th>
                        <th>Foreign Mole</th>
                        <th>Okala</th>
                        <th>Mufa</th>
                        <th>Update Medical</th>
                        <th>VISA Stamping</th>
                        <th>Finger</th>
                        <th>Training Card</th>
                        <th>Manpower Card</th>
                        <th>Flight Date</th>
                        <th>Options</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>        
    </div>
</div>

<script>
function showDisableValue(info){
    info_split = info.split('_');
    $('#passportNumEnableModal').val(info_split[0]);
    $('#creationDateEnableModal').val(info_split[1]);
    $('#reasonModal').html(info_split[2]);
}
function getDisableValue(info){
    info_split = info.split('_');
    $('#passportNumDisableModal').val(info_split[0]);
    $('#creationDateDisableModal').val(info_split[1]);
}

function getReturnValue(info){
    info_split = info.split('_');
    $('#processingIdModalReturn').val(info_split[0]);
    let button = document.createElement('BUTTON');
    button.setAttribute('type', 'submit');
    if(info_split[1] === '0'){
        button.setAttribute('class', 'btn btn-warning');
        button.setAttribute('value', 'hold');
        button.setAttribute('name', 'hold');
        button.textContent = 'Hold';
    }else if(info_split[1] === '1'){
        button.setAttribute('class', 'btn btn-secondary');
        button.setAttribute('value', 'release');
        button.setAttribute('name', 'release');
        button.textContent = 'Release';
    }
    
    $('#hold').html(button);
}

function calculateBDT(){
    var delegateExpense = ($('#delegateExpenseAmountModal').val() === 0 | $('#delegateExpenseAmountModal').val() === '') ? 1 : $('#delegateExpenseAmountModal').val();
    var dollarRate = ($('#dollarRateModal').val() === 0 | $('#dollarRateModal').val() === '') ? 1 : $('#dollarRateModal').val();
    $('#bdtAmountModal').val(delegateExpense*dollarRate);
}

function youtubeLink(processingId){
    $('#processingIdModal').val(processingId);
}

function addDelegateExpense(info){
    info = info.split('_');
    $('#delegateModalButton').html('Submit');
    $('#passportNumDelegateExpenseInfo').val(info[0]);
    $('#creationDateDelegateExpenseInfo').val(info[1]);
}
function editDelegateExpense(info){
    info = info.split('_');
    $('#delegateModalButton').html('Update');
    $('#passportNumDelegateExpenseInfo').val(info[0]);
    $('#creationDateDelegateExpenseInfo').val(info[1]);
    $('#delegateExpenseAmountModal').val(info[2]);
    $('#dollarRateModal').val(info[3]);
    $('#bdtAmountModal').val(info[2] * info[3]);
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

function manpowerFileSubmit(info){
    $('#processingIdManpower').val(info);
}

function mufaFileSubmit(info){  
    $('#processingIdMufa').val(info);
}

function okalaFileSubmit(info){  
    $('#processingIdOkala').val(info);
}

function trainingCard(info){
    let info_split = info.split('-');
    $('#passportNumCard').val(info_split[0]);
}

function visaStamping(processingId){
    $('#processingIdModalOne').val(processingId);
    $('#processingIdModalThree').val(processingId);
}

$('body').on('click', '#testMedicalFile', function(){
    $('#visaMedical').val($('#testMedicalFile').val());
});

$('body').on('click', '#finalMedicalFile', function(){
    $('#visaMedicalFinal').val($('#finalMedicalFile').val());
});
$('#visaNav').addClass('active');
</script>

