<style>
    .flex-container {
        display: flex;
        flex-direction: row;
    }
    .btn{
        font-size: small;
        size: 50%;
        /* width: 135px;
        height: 30px; */
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
    

    <!-- Test Medical Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="testMedicalSubmit">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/visaSubmit.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Give Test Medical Certificate</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="mode" value="testMedical">
                        <input type="hidden" name="visaMedical" id="visaMedical" value="">
                        <input class="form-control" type="file" name="testMedical">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Final Medical Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="finalMedicalSubmit">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/visaSubmit.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Give Test Medical Certificate</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="mode" value="finalMedical">
                        <input type="hidden" name="visaMedicalFinal" id="visaMedicalFinal" value="">
                        <input class="form-control" type="file" name="finalMedical">
                        
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
                    <th>Visa No</th>
                    <th>Employee Request</th>
                    <th>Foreign Mole</th>
                    <th>Okala</th>
                    <th>Mufa</th>
                    <th>Test Medical</th>
                    <th>Final Medical</th>
                    <th>Visa Stamping</th>
                    <th>Finger</th>
                    <th>Departure Date</th>
                    <th>Arrival Date</th>
                </tr>
                </thead>
                <?php
                $result = $conn->query("SELECT * from visa order by creationDate desc");
                $status = "pending";
                while($visa = mysqli_fetch_assoc($result)){ ?>
                    <tr>
                        <td><?php echo $visa['visaNo'];?></td>

                        <!-- Employee Request -->
                        <td class="first"><?php 
                        if(empty($visa['empRqst']) || $visa['empRqst']=='no'){ ?>
                        <form action="template/visaProcessing.php" method="post">
                            <input type="hidden" name="visaNo" value="<?php echo $visa['visaNo'];?>">
                            <input type="hidden" name="mode" value="empRqstMode">
                            <button class="btn btn-secondary btn-sm" value="yes" name="empRqst">No</button>
                        </form>
                        <?php } else { ?>
                        <form action="template/visaProcessing.php" method="post">
                            <input type="hidden" name="visaNo" value="<?php echo $visa['visaNo'];?>">
                            <input type="hidden" name="mode" value="empRqstMode">
                            <button class="btn btn-primary btn-sm" value="no" name="empRqst">Yes</button>
                        </form>
                        <?php } ?></td>

                        <!-- Foreign MOLE -->
                        <td class="first"><?php
                        if(empty($visa['empRqst']) || $visa['empRqst']=='no'){ ?>
                        <button class="btn btn-warning btn-sm"><span style="font-size: small;">Do Previous Step</span></button>
                        <?php }else if(empty($visa['foreignMole']) || $visa['foreignMole']=='no'){ ?>
                        <form action="template/visaProcessing.php" method="post">
                            <input type="hidden" name="visaNo" value="<?php echo $visa['visaNo'];?>">
                            <input type="hidden" name="mode" value="foreignMoleMode">
                            <button class="btn btn-secondary btn-sm" value="yes" name="foreignMole">No</button>
                        </form>
                        <?php } else { ?>
                        <form action="template/visaProcessing.php" method="post">
                            <input type="hidden" name="visaNo" value="<?php echo $visa['visaNo'];?>">
                            <input type="hidden" name="mode" value="foreignMoleMode">
                            <button class="btn btn-primary btn-sm" value="no" name="foreignMole">Approved</button>
                        </form>
                        <?php } ?></td>

                        <!-- Okala -->
                        <td class="first"><?php
                        if(empty($visa['foreignMole']) || $visa['foreignMole']=='no'){ ?>
                        <button class="btn btn-warning"><span style="font-size: small;">Do Previous Step</span></button>
                        <?php }else if(empty($visa['okala']) || $visa['okala']=='no'){ ?>
                        <form action="template/visaProcessing.php" method="post">
                            <input type="hidden" name="visaNo" value="<?php echo $visa['visaNo'];?>">
                            <input type="hidden" name="mode" value="okalaMode">
                            <button class="btn btn-secondary btn-sm" value="yes" name="okala">No</button>
                        </form>
                        <?php } else { ?>
                        <form action="template/visaProcessing.php" method="post">
                            <input type="hidden" name="visaNo" value="<?php echo $visa['visaNo'];?>">
                            <input type="hidden" name="mode" value="okalaMode">
                            <button class="btn btn-primary btn-sm" value="no" name="okala">Confirmed</button>
                        </form>
                        <?php } ?></td>

                        <!-- MUFA -->
                        <td class="first"><?php
                        if(empty($visa['okala']) || $visa['okala']=='no'){ ?>
                            <button class="btn btn-warning btn-sm"><span style="font-size: small;">Do Previous Step</span></button>
                        <?php }else if(empty($visa['mufa']) || $visa['mufa']=='no'){ ?>
                        <form action="template/visaProcessing.php" method="post">
                            <input type="hidden" name="visaNo" value="<?php echo $visa['visaNo'];?>">
                            <input type="hidden" name="mode" value="mufaMode">
                            <button class="btn btn-secondary btn-sm" value="yes" name="mufa">No</button>
                        </form>
                        <?php } else { ?>
                        <form action="template/visaProcessing.php" method="post">
                            <input type="hidden" name="visaNo" value="<?php echo $visa['visaNo'];?>">
                            <input type="hidden" name="mode" value="mufaMode">
                            <button class="btn btn-primary btn-sm" value="no" name="mufa">Done</button>
                        </form>
                        <?php } ?></td>

                        <!-- Test Medical -->
                        <td class="second">                    
                        <?php if(empty($visa['testMedical']) || $visa['testMedical']=='no'){ ?>
                            <button class="btn btn-secondary btn-sm" value="<?php echo $visa['visaNo'];?>" name="testMedicalFile" data-target="#testMedicalSubmit" data-toggle="modal" id="testMedicalFile">No</button>
                        <?php } else { ?>
                            <a href="<?php echo $visa['testMedicalFile'];?>" target="_blank"><button class="btn btn-primary btn-sm">OK</button></a>
                        <?php } ?></td>

                        <!-- Final Medical -->
                        <td class="second"><?php
                        if(empty($visa['testMedical']) || $visa['testMedical']=='no'){ ?>
                            <button class="btn btn-warning btn-sm"><span style="font-size: small;">Do Previous Step</span></button>
                        <?php }else if(empty($visa['finalMedical']) || $visa['finalMedical']=='no'){ ?>
                            <button class="btn btn-secondary btn-sm" value="<?php echo $visa['visaNo'];?>" name="testMedicalFile" data-target="#finalMedicalSubmit" data-toggle="modal" id="finalMedicalFile">No</button>
                        <?php } else { ?>
                            <a href="<?php echo $visa['finalMedicalFile'];?>" target="_blank"><button class="btn btn-primary btn-sm">OK</button></a>
                        <?php } ?></td>

                        <!-- VISA Stamping -->
                        <td class="third"><?php
                        if(empty($visa['finalMedical']) || $visa['finalMedical']=='no' || empty($visa['mufa']) || $visa['mufa']=='no'){ ?>
                        <button class="btn btn-warning btn-sm"><span style="font-size: small;">Do Previous Step</span></button>
                        <?php }else if(empty($visa['visaStamping']) || $visa['visaStamping']=='no'){ ?>
                        <form action="template/visaProcessing.php" method="post">
                            <input type="hidden" name="visaNo" value="<?php echo $visa['visaNo'];?>">
                            <input type="hidden" name="mode" value="visaStamingMode">
                            <button class="btn btn-secondary btn-sm" value="yes" name="stamping">No</button>
                        </form>
                        <?php } else { ?>
                        <form action="template/visaProcessing.php" method="post">
                            <input type="hidden" name="visaNo" value="<?php echo $visa['visaNo'];?>">
                            <input type="hidden" name="mode" value="visaStamingMode">
                            <button class="btn btn-primary btn-sm" value="no" name="stamping">Done</button>
                        </form>
                        <?php } ?></td>

                        <!-- Finger -->
                        <td class="third"><?php
                        if(empty($visa['visaStamping']) || $visa['visaStamping']=='no'){ ?>
                        <button class="btn btn-warning btn-sm"><span style="font-size: small;">Do Previous Step</span></button>
                        <?php }else if(empty($visa['finger']) || $visa['finger']=='no'){ ?>
                        <form action="template/visaProcessing.php" method="post">
                            <input type="hidden" name="visaNo" value="<?php echo $visa['visaNo'];?>">
                            <input type="hidden" name="mode" value="fingerMode">
                            <button class="btn btn-secondary btn-sm" value="yes" name="finger">No</button>
                        </form>
                        <?php } else { ?>
                        <form action="template/visaProcessing.php" method="post">
                            <input type="hidden" name="visaNo" value="<?php echo $visa['visaNo'];?>">
                            <input type="hidden" name="mode" value="fingerMode">
                            <button class="btn btn-primary btn-sm" value="no" name="finger">Done</button>
                        </form>
                        <?php } ?></td>

                        <!-- Departure Date -->
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
                    <th>Visa No</th>
                    <th>Employee Request</th>
                    <th>Foreign Mole</th>
                    <th>Okala</th>
                    <th>Mufa</th>
                    <th>Test Medical</th>
                    <th>Final Medical</th>
                    <th>Visa Stamping</th>
                    <th>Finger</th>
                    <th>Departure Date</th>
                    <th>Arrival Date</th>
                </tr>
                </tfoot>

            </table>
            </div>
        </div>
    </div>
</div>

<script>
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

