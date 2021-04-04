<style>
    .flex-container {
        display: flex;
        flex-direction: row;
    }
    .btn{
        font-size: 11px;
    }
    /* .first{
        background-color: rgba(159, 168, 218, 0.9);
    }
    .second{
        background-color: rgba(159, 168, 218, 0.7);
    }
    .third{
        background-color: rgba(159, 168, 218, 0.4);
    } */
</style>
<div class="container-fluid" style="padding: 2%">

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

    <!-- Stamping Modal 1 card -->
    <div class="modal fade" tabindex="-1" role="dialog" id="visaStamping">
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

                        <input type="hidden" name="processingId" id="processingIdModalOne">
                        <input type="hidden" name="mode" value="stampingMode">
                        <div class="form-group">
                            <input class="datepicker" autocomplete="off" type="text" name="stampingDate" placeholder="Enter Visa Stamping Date">
                        </div>
                        <div>
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

    <!-- Stamping Modal 3 cards -->
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
                                <input class="form-control-file" type="file" name="visaFile[]">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <div class="form-group">
                                <button class="btn btn-sm" type="button" id="add_visafile_div" ><span class="fa fa-plus" aria-hidden="true"></span></button>
                                <button class="btn btn-sm btn-danger" type="button" id="remove_visafile_div"><span class="fas fa-minus" aria-hidden="true"></span></button>
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
    
    <div class="card">
        <div class="card-header">
            <div class="section-header">
                <h2>All Visa Information</h2>
            </div>
        </div>
    
        <div class="card-body">
        
        <div class="table-responsive">
            <table id="dataTableSeaum" class="table table-bordered table-hover text-center" style="width:100%">
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
                    $result = $conn->query("SELECT sponsor.sponsorName, jobs.creditType, passport.oldVisa, passport.creationDate as passportCreationDate, passport.country, passport.agentEmail, passport.fName, passport.lName, passport.passportNum, sponsorvisalist.sponsorNID, sponsorvisalist.visaGenderType, sponsorvisalist.jobId , sponsorvisalist.visaAmount, processing.* from processing INNER JOIN passport on passport.passportNum = processing.passportNum AND passport.creationDate = processing.passportCreationDate INNER JOIN jobs on jobs.jobId = passport.jobId INNER JOIN sponsorvisalist USING (sponsorVisa) INNER JOIN sponsor on sponsor.sponsorNID = sponsorvisalist.sponsorNID where processing.processingId = $processingId");
                }else{
                    $result = $conn->query("SELECT sponsor.sponsorName, jobs.creditType, passport.oldVisa, passport.creationDate as passportCreationDate, passport.country, passport.agentEmail, passport.fName, passport.lName, passport.passportNum, sponsorvisalist.sponsorNID, sponsorvisalist.visaGenderType, sponsorvisalist.jobId , sponsorvisalist.visaAmount, processing.* from processing INNER JOIN passport on passport.passportNum = processing.passportNum AND passport.creationDate = processing.passportCreationDate INNER JOIN jobs on jobs.jobId = passport.jobId INNER JOIN sponsorvisalist USING (sponsorVisa) INNER JOIN sponsor on sponsor.sponsorNID = sponsorvisalist.sponsorNID order by creationDate desc");
                }
                $status = "pending";
                while($visa = mysqli_fetch_assoc($result)){ ?>
                    <tr>
                        <td><?php echo $visa['fName']." ".$visa['lName'];?></td>
                        <td><a href="?page=listCandidate&pp=<?php echo base64_encode($visa['passportNum']);?>&cd=<?php echo base64_encode($visa['passportCreationDate']);?>"><?php echo $visa['passportNum'];?></a></td>
                        <td><a href="?page=allVisaList&sv=<?php echo base64_encode($visa['sponsorVisa'])?>"><?php echo $visa['sponsorVisa'];?></a></td>
                        <td><?php echo $visa['sponsorNID'].'<br>'; ?>
                        <a href="?page=sponsorList&spN=<?php echo base64_encode($visa['sponsorNID']); ?>"><span style="font-size: 11px;"><?php echo $visa['sponsorName'];?></span></a></td>
                        <!-- Employee Request -->
                        <td class="first"><?php 
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
                        <?php } ?></td>

                        <!-- Foreign MOLE -->
                        <td class="first"><?php
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
                        <?php } ?></td>

                        <!-- Okala -->
                        <td class="first">                            
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
                        <!-- MUFA -->
                        <td class="first"><?php
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
                        <?php } ?></td>

                        <!-- Update Medical -->
                        <td class="second"><?php
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
                        <?php } ?></td>

                        <!-- VISA Stamping -->
                        <td class="third"><?php
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
                        <?php } ?></td>

                        <!-- Finger -->
                        <td class="third"><?php
                        if(empty($visa['visaStamping']) || $visa['visaStamping']=='no'){ ?>
                            <button class="btn btn-warning btn-sm">Do Previous</button>
                        <?php }else if(empty($visa['finger']) || $visa['finger']=='no'){ ?>
                            <form action="template/visaProcessing.php" method="post">
                                <input type="hidden" name="passportNum" value="<?php echo $visa['passportNum'];?>">
                                <input type="hidden" name="sponsorVisa" value="<?php echo $visa['sponsorVisa'];?>">
                                <input type="hidden" name="mode" value="fingerMode">
                                <button class="btn btn-secondary btn-sm" value="yes" name="finger">No</button>
                            </form>
                        <?php } else { ?>
                            <form action="template/visaProcessing.php" method="post">
                                <input type="hidden" name="passportNum" value="<?php echo $visa['passportNum'];?>">
                                <input type="hidden" name="sponsorVisa" value="<?php echo $visa['sponsorVisa'];?>">
                                <input type="hidden" name="mode" value="fingerMode">
                                <button class="btn btn-primary btn-sm" value="no" name="finger">Done</button>
                            </form>
                        <?php } ?></td>

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
                        <?php } ?></td> 

                        <!-- options -->
                        <td>
                            <div class="row">
                                <div class="col-sm-3">                                    
                                    <a href="?page=ce<?php echo "&pn=".base64_encode($visa['passportNum'])."&cd=".base64_encode($visa['passportCreationDate']); ?>" target="_blank"><button class="btn btn-sm btn-info" type="button" id="add_visa" ><span class="fa fa-dollar" aria-hidden="true"></span></button></a>                                      
                                </div>
                                <div class="col-sm-3">
                                    <form action="index.php" method="post">
                                        <input type="hidden" name="pagePost" value="exchangeVisa">
                                        <input type="hidden" name="info" value="<?php echo $visa['fName']."-".$visa['lName']."-".$visa['processingId']."-".$visa['sponsorVisa']."-".$visa['visaAmount']."-".$visa['visaGenderType'];?>">
                                        <button class="btn btn-danger btn-sm"><span class="fas fa-exchange-alt"></span></button>
                                    </form>                                    
                                </div>
                                <div class="col-sm-3">
                                    <form action="template/saveVisa.php" method="post">
                                        <input type="hidden" name="alter" value="delete">
                                        <input type="hidden" name="processingId" value="<?php echo $visa['processingId'];?>">
                                        <button class="btn btn-sm btn-danger"><span class="fa fa-close"></span></button></a>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
                <tfoot hidden>
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
                </tfoot>
            </table>
            </div>
        </div>
    </div>
</div>

<script>
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

