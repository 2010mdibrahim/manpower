<style>
    .flex-container {
        display: flex;
        flex-direction: row;
    }
    .btn{
        font-size: small;
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
                        <input type="hidden" name="sponsorVisa" id="sponsorVisaCard">
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


    <!-- Stamping Date Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="visaStamping">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/visaProcessing.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Visa Stamping Date</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="passportNum" id="passportNum">
                        <input type="hidden" name="sponsorVisa" id="sponsorVisa">
                        <input type="hidden" name="mode" value="stampingDateMode">
                        <input type="date" name="stampingDate">
                        
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
            <table id="dataTableSeaum" class="table table-bordered table-hover" style="width:100%">
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
                    <th>Flight Date</th>
                </tr>
                </thead>
                <?php
                // $result = $conn->query("SELECT passport.passportNum, passport.fName, passport.lName, sponsorvisalist.sponsorName FROM passport INNER JOIN sponsorvisalist USING (sponsorVisaAmountId)");
                $result = $conn->query("SELECT passport.fName, passport.lName, passport.passportNum, sponsorvisalist.sponsorNID, sponsorvisalist.visaGenderType, sponsorvisalist.jobType , processing.* from processing INNER JOIN passport USING (passportNum) INNER JOIN sponsorvisalist USING (sponsorVisa) order by creationDate desc");
                $status = "pending";
                while($visa = mysqli_fetch_assoc($result)){ ?>
                    <tr>
                        <td><?php echo $visa['fName']." ".$visa['lName'];?></td>
                        <td><?php echo $visa['passportNum'];?></td>
                        <td><?php echo $visa['sponsorVisa'];?></td>
                        <td><?php echo $visa['sponsorNID'];?></td>
                        

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
                                <button class="btn btn-primary btn-sm" value="no" name="empRqst">Yes</button>
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
                                <button class="btn btn-primary btn-sm" value="no" name="foreignMole">Approved</button>
                            </form>
                        <?php } ?></td>

                        <!-- Okala -->
                        <td class="first"><?php
                        if(empty($visa['foreignMole']) || $visa['foreignMole']=='no'){ ?>
                        <button class="btn btn-warning"><span style="font-size: small;">Do Previous</span></button>
                        <?php }else if(empty($visa['okala']) || $visa['okala']=='no'){ ?>
                        <form action="template/visaProcessing.php" method="post">
                            <input type="hidden" name="passportNum" value="<?php echo $visa['passportNum'];?>">
                            <input type="hidden" name="sponsorVisa" value="<?php echo $visa['sponsorVisa'];?>">
                            <input type="hidden" name="mode" value="okalaMode">
                            <button class="btn btn-secondary btn-sm" value="yes" name="okala">No</button>
                        </form>
                        <?php } else { ?>
                        <form action="template/visaProcessing.php" method="post">
                            <input type="hidden" name="passportNum" value="<?php echo $visa['passportNum'];?>">
                            <input type="hidden" name="sponsorVisa" value="<?php echo $visa['sponsorVisa'];?>">
                            <input type="hidden" name="mode" value="okalaMode">
                            <button class="btn btn-primary btn-sm" value="no" name="okala">Confirmed</button>
                        </form>
                        <?php } ?></td>

                        <!-- MUFA -->
                        <td class="first"><?php
                        if(empty($visa['okala']) || $visa['okala']=='no'){ ?>
                            <button class="btn btn-warning btn-sm"><span style="font-size: small;">Do Previous</span></button>
                        <?php }else if(empty($visa['mufa']) || $visa['mufa']=='no'){ ?>
                        <form action="template/visaProcessing.php" method="post">
                            <input type="hidden" name="passportNum" value="<?php echo $visa['passportNum'];?>">
                            <input type="hidden" name="sponsorVisa" value="<?php echo $visa['sponsorVisa'];?>">
                            <input type="hidden" name="mode" value="mufaMode">
                            <button class="btn btn-secondary btn-sm" value="yes" name="mufa">No</button>
                        </form>
                        <?php } else { ?>
                        <form action="template/visaProcessing.php" method="post">
                            <input type="hidden" name="passportNum" value="<?php echo $visa['passportNum'];?>">
                            <input type="hidden" name="sponsorVisa" value="<?php echo $visa['sponsorVisa'];?>">
                            <input type="hidden" name="mode" value="mufaMode">
                            <button class="btn btn-primary btn-sm" value="no" name="mufa">Done</button>
                        </form>
                        <?php } ?></td>

                        <!-- Update Medical -->
                        <td class="second"><?php
                        if(empty($visa['mufa']) || $visa['mufa']=='no'){ ?>
                            <button class="btn btn-warning btn-sm"><span style="font-size: small;">Do Previous</span></button>
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
                            <button class="btn btn-warning btn-sm"><span style="font-size: 11px;">Do Previous Step</span></button>
                        <?php }else if(empty($visa['visaStamping']) || $visa['visaStamping']=='no'){ ?>
                            <button class="btn btn-info btn-sm" data-target="#visaStamping" data-toggle="modal" id="stampingButton" value="<?php echo $visa['passportNum']."-".$visa['sponsorVisa'];?>">Enter Date</button>
                        <?php } else { ?>
                            <p><?php echo $visa['visaStampingDate'];?></p>
                        <?php } ?></td>

                        <!-- Finger -->
                        <td class="third"><?php
                        if(empty($visa['visaStamping']) || $visa['visaStamping']=='no'){ ?>
                            <button class="btn btn-warning btn-sm"><span style="font-size: small;">Do Previous</span></button>
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
                        <?php if($visa['visaGenderType'] == 'female' AND $visa['jobType'] == 'housekeep'){ ?>
                            <a href="<?php echo $visa['trainingCardFile'];?>"><button class="btn btn-warning btn-sm">Card</button></a>
                        <?php }else{ ?>
                                <?php if(empty($visa['finger']) || $visa['finger'] == 'no'){ ?>
                                        <button class="btn btn-warning btn-sm"><span style="font-size: small;">Do Previous</span></button>
                                <?php }else if(empty($visa['trainingCard']) || $visa['trainingCard'] == 'no'){ ?>
                                        <button class="btn btn-secondary btn-sm" value="<?php echo $visa['passportNum']."-".$visa['sponsorVisa'];?>" id="enterCard" data-target="#trainingCardFileSubmit" data-toggle="modal">Enter Card</button>                                
                                <?php }else{ ?>
                                        <a href="<?php echo $visa['trainingCardFile'];?>" target="_blank"><button class="btn btn-warning btn-sm">Card</button></a>
                                <?php } ?>
                        <?php } ?>
                        </td>

                        <td class="third"><?php
                        $ticket = mysqli_fetch_assoc($conn->query("SELECT *, count(ticketId) as existTicket from ticket where passportNum = '".$visa['passportNum']."'"));
                        if(empty($visa['finger']) || $visa['finger'] == 'no'){ ?>
                        <button class="btn btn-warning btn-sm"><span style="font-size: small;">Do Previous Step</span></button>
                        <?php }else if($ticket['existTicket'] == 0){ ?>
                        <button class="btn btn-secondary btn-sm"><span style="font-size: small;">No Ticket Assigned</span></button>
                        <?php } else { 
                            echo $ticket['flightDate'];
                        } ?></td>


                        <td><?php 
                        if(empty($visa['empRqst']) || $visa['empRqst']=='no'){ ?>
                        <button class="btn btn-secondary btn-sm">No</button>
                        <?php } else { ?>
                        <button class="btn btn-primary btn-sm">Yes</button>
                        <?php } ?></td>                    
                        <!-- <td>
                            <div class="flex-container">
                                <div style="padding-right: 2%">
                                    <form action="index.php" method="post">
                                        <input type="hidden" name="alter" value="update">
                                        <input type="hidden" value="editVisa" name="pagePost">
                                        <input type="hidden" value="<?php echo $visa['visaId']; ?>" name="visaId">
                                        <button type="submit" class="btn btn-primary btn-sm">Edit</></button>
                                    </form>
                                </div>
                                <div style="padding-left: 2%">
                                    <form action="template/editVisaQry.php" method="post">
                                        <input type="hidden" name="alter" value="delete">
                                        <input type="hidden" value="editCandidate" name="pagePost">
                                        <input type="hidden" value="<?php echo $visa['visaId']; ?>" name="visaId">
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</></button>
                                    </form>
                                </div>
                            </div>
                        </td> -->
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
                    <th>Flight Date</th>
                </tr>
                </tfoot>

            </table>
            </div>
        </div>
    </div>
</div>

<script>
$('body').on('click', '#enterCard', function(){
    let info = $('#enterCard').val().split('-');
    $('#passportNumCard').val(info[0]);
    $('#sponsorVisaCard').val(info[1]);
});

$('body').on('click', '#stampingButton', function(){
    let info = $('#stampingButton').val().split('-');
    $('#passportNum').val(info[0]);
    $('#sponsorVisa').val(info[1]);
});

$('body').on('click', '#testMedicalFile', function(){
    $('#visaMedical').val($('#testMedicalFile').val());
});

$('body').on('click', '#finalMedicalFile', function(){
    $('#visaMedicalFinal').val($('#finalMedicalFile').val());
});

window.onload = function() {
    $('#visaNav').addClass('active');
};
</script>

