<?php
if(isset($_GET['pp'])){
    $passportNum = base64_decode($_GET['pp']);
    $creationDate = base64_decode($_GET['cd']);
    $result = $conn -> query("SELECT jobs.jobType, passport.*, DATE(passport.creationDate) as creationDateShow from passport left join jobs using (jobId) where passport.passportNum = '$passportNum' and passport.creationDate = '$creationDate'");
}else{
    $result = $conn -> query("SELECT jobs.jobType, passport.*, DATE(passport.creationDate) as creationDateShow from passport left join jobs using (jobId) order by passport.creationDate desc");
}
?>

<style>
    .flex-container {
        display: flex;
        flex-direction: row;
    }
    html {
        scroll-behavior: smooth;
    }    
</style>
<div class="container-fluid" style="padding: 2%">
    <!-- Final Medical Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="finalMedicalSubmit">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/visaSubmit.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Give Final Medical Certificate</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="mode" value="finalMedical">
                        <input type="hidden" name="passportMedicalFinal" id="passportMedicalFinal" value="">
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
                        <input type="hidden" name="passportMedical" id="passportMedical" value="">
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
    

    <!-- Police Clearance Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="policeClearanceFileSubmit">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/listSubmit.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Give Police Clearance File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="mode" value="policeVerification">
                        <input type="hidden" name="modalPassportPolice" id="modalPassportPolice">
                        <input class="form-control" type="file" name="policeClearance">
                        
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
                        
                        <input type="hidden" name="from" value="candidateList">
                        <input type="hidden" name="trainingCardFrom" value="passport">
                        <input type="hidden" name="passportNum" id="passportNum">
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

    <!-- Passport Photo Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="photoFileSubmit">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/listSubmit.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Give Passport Photo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="mode" value="photoMode">
                        <input type="hidden" name="passportNumModalPhoto" id="passportNumModalPhoto" value="">
                        <input class="form-control" type="file" name="photo">
                        
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
                <h2>Candidate List</h2>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTableSeaum" class="table table-bordered table-hover"  style="width:100%">
                    <thead>
                    <tr>
                        <th>Creation Date</th>
                        <th>Candidate Name</th>
                        <th>Passport No</th>
                        <th>Mobile No</th>
                        <th>Age</th>
                        <th>Passport expire date</th>
                        <th>Candidare previouse status</th>
                        <th>Applying for Country</th>               
                        <th>Test Medical</th>
                        <th>Final Medical</th>
                        <th>Police Clearance</th>
                        <th>Training Card</th>                       
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <?php
                    while( $candidate = mysqli_fetch_assoc($result) ){

                        // ----- experience days ------
                        $arrivalDate = new DateTime($candidate['arrivalDate']);
                        $departureDate = new DateTime($candidate['departureDate']);
                        $experience = $departureDate->diff($arrivalDate);
                        
                        // ------- validity days -------
                        $expiryDate = new DateTime($candidate['issueDate']); // will add validity to this date thats why it is expiry date
                        $today = new DateTime(date('Y-m-d'));
                        $format = "P".$candidate['validity']."Y";
                        $expiryDate->add(new DateInterval($format));
                        $validity = $expiryDate->diff($today);

                        // ---------- DOB -----------
                        $today = new Datetime(date('Y-m-d'));
                        $bday = new Datetime($candidate['dob']);
                        $age = $today->diff($bday);
                    
                        if($age->y < 25){ ?>
                            <tr style="background-color: #e8f5e9;">
                        <?php }else if($age->y > 38){ ?>
                            <tr style="background-color: #fffde7;">
                        <?php }else{ ?>
                            <tr>
                        <?php } ?>

                        <!-- Creation Date -->
                        <td><?php echo $candidate['creationDateShow'];?></td>
                        <td>
                        <a href="?page=cI&p=<?php echo base64_encode($candidate['passportNum'])."&cd=.".base64_encode($candidate['creationDate'])."&t=".time();?>" target="_blank"><?php echo $candidate['fName']." ".$candidate['lName'];?></a>
                        <p>(<?php echo $candidate['gender'];?>)</p>
                        </td>
                        <td><?php echo $candidate['passportNum'];?></td>                  
                        <td><?php echo $candidate['mobNum'];?></td>                      
                        <td><?php printf('%d years', $age->y);?></td>
                        <!-- Passport Validity -->
                        <td><?php 
                        $noVal = true;
                        if($validity->y != 0){
                            echo $validity->y.' Years; ';
                            $noVal = false;
                        }
                        if($validity->m != 0){
                            echo $validity->m.' Months; ';   
                            $noVal = false;                     
                        }
                        if($validity->d != 0){
                            echo $validity->d.' Days.';
                            $noVal = false;
                        }
                        if($noVal){
                            echo 'No Validity';
                        } 
                        ?></td>
                        <!-- Experience Days -->
                        <td><?php
                        $noExp = true;
                        if($experience->y != 0){
                            echo $experience->y.' Years; ';
                            $noExp = false;
                        }
                        if($experience->m != 0){
                            echo $experience->m.' Months; ';
                            $noExp = false;                        
                        }
                        if($experience->d != 0){
                            echo $experience->d.' Days.';
                            $noExp = false;
                        }
                        if($noExp){
                            echo 'New';
                        } ?></td>
                        <td>
                        <?php echo $candidate['country'];?>
                        <p style="font-size: 11px;">(<?php echo $candidate['jobType'];?>)</p>
                        </td>
                        <!-- Test Medical -->
                        <td class="second">
                        <div class="row">              
                            <?php if(empty($candidate['testMedical']) || $candidate['testMedical']=='no'){ ?>
                                <div class="col-sm-3">
                                    <button class="btn btn-secondary btn-sm" value="<?php echo $candidate['passportNum']."_".$candidate['creationDate'];?>" name="testMedicalFile" data-target="#testMedicalSubmit" data-toggle="modal" id="testMedicalFile" onclick="testMedical(this.value)">No</button>
                                </div>                            
                            <?php } else { ?>                            
                                <div class="col-sm-3">
                                    <button class="btn btn-danger btn-sm" value="<?php echo $candidate['passportNum']."_".$candidate['creationDate'];?>" name="testMedicalFile" data-target="#testMedicalSubmit" data-toggle="modal" id="testMedicalFile" onclick="testMedical(this.value)"><span class="fas fa-redo"></span></button>
                                </div>
                                <div class="col-sm-3">    
                                    <a href="<?php echo $candidate['testMedicalFile']."?t=".time();?>" target="_blank"><button class="btn btn-info btn-sm"><span class="fas fa-search"></span></button></a>
                                </div>                                                        
                            <?php } ?>
                                <div class="col-sm-3">
                                    <form action="index.php" method="post">
                                        <input type="hidden" name="redir" value="listCandidate">
                                        <input type="hidden" name="pagePost" value="addCandidatePayment">
                                        <input type="hidden" name="purpose" value="Test Medical">
                                        <input type="hidden" name="candidateName" value="<?php echo $candidate['fName']." ".$candidate['lName'];?>">
                                        <input type="hidden" name="passport_info" value="<?php echo $candidate['passportNum']."_".$candidate['creationDate'];?>">
                                        <input type="hidden" name="agentEmail" value="<?php echo $candidate['agentEmail'];?>">
                                        <button class="btn btn-sm btn-success" type="submit" id="add_visa" ><span class="fas fa-plus" aria-hidden="true"></span></button>
                                    </form>
                                </div>
                        </div></td>
                        <!-- Final Medical -->
                        <td class="second">                        
                        <?php                        
                            if(empty($candidate['testMedical']) || $candidate['testMedical']=='no'){ ?>
                                <button class="btn btn-warning btn-sm">Do Previous</button>
                            <?php }else{ ?>
                            <div class="row">
                                <?php if(empty($candidate['finalMedical']) || $candidate['finalMedical']=='no'){ ?>                                
                                    <div class="col-sm-3">
                                        <button class="btn btn-secondary btn-sm" value="<?php echo $candidate['passportNum']."_".$candidate['creationDate'];?>" name="finalMedicalFile" data-target="#finalMedicalSubmit" data-toggle="modal" id="finalMedicalFile" onclick="finalMedical(this.value)">No</button>
                                    </div>
                                <?php } else { ?>                            
                                        <div class="col-sm-3">
                                            <button class="btn btn-danger btn-sm" value="<?php echo $candidate['passportNum']."_".$candidate['creationDate'];?>" name="finalMedicalFile" data-target="#finalMedicalSubmit" data-toggle="modal" id="finalMedicalFile" onclick="finalMedical(this.value)"><span class="fas fa-redo"></span></button>
                                        </div>
                                        <div class="col-sm-3"> 
                                            <a href="<?php echo $candidate['finalMedicalFile']."?t=".time();?>" target="_blank"><button class="btn btn-info btn-sm"><span class="fas fa-search"></span></button></a>
                                        </div>                                                        
                                <?php } ?>
                                    <div class="col-sm-3">
                                        <form action="index.php" method="post">
                                            <input type="hidden" name="redir" value="listCandidate">
                                            <input type="hidden" name="pagePost" value="addCandidatePayment">
                                            <input type="hidden" name="purpose" value="Final Medical">
                                            <input type="hidden" name="candidateName" value="<?php echo $candidate['fName']." ".$candidate['lName'];?>">
                                            <input type="hidden" name="passport_info" value="<?php echo $candidate['passportNum']."_".$candidate['creationDate'];?>">
                                            <input type="hidden" name="agentEmail" value="<?php echo $candidate['agentEmail'];?>">
                                            <button class="btn btn-sm btn-success" type="submit" id="add_visa" ><span class="fas fa-plus" aria-hidden="true"></span></button>
                                        </form>
                                    </div>
                                </div>
                            <?php } ?>
                        </td>
                        <!-- Police Clearance -->
                        <td>                        
                        <div class="row">
                            <?php 
                            if($candidate['policeClearance'] == 'yes'){ ?>
                                    <div class="col-sm-3">
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#policeClearanceFileSubmit" id="policeClearancePassport" value="<?php echo $candidate['passportNum']."_".$candidate['creationDate'];?>" onclick="policeClearance(this.value)"><span class="fas fa-redo"></span></button>
                                    </div>
                                    <div class="col-sm-3"> 
                                        <a href="<?php echo $candidate['policeClearanceFile']."?t=".time();?>" target="_blank"><button class="btn btn-info btn-sm"><span class="fas fa-search"></span></button></a>
                                    </div>                            
                            <?php }else{ ?>
                            <div class="col-sm-3">
                                <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#policeClearanceFileSubmit" id="policeClearancePassport" value="<?php echo $candidate['passportNum']."_".$candidate['creationDate'];?>" onclick="policeClearance(this.value)">No</button>                            
                            </div>
                            <?php } ?>
                            <div class="col-sm-3">
                                <form action="index.php" method="post">
                                    <input type="hidden" name="redir" value="listCandidate">
                                    <input type="hidden" name="pagePost" value="addCandidatePayment">
                                    <input type="hidden" name="purpose" value="Police Clearance">
                                    <input type="hidden" name="candidateName" value="<?php echo $candidate['fName']." ".$candidate['lName'];?>">
                                    <input type="hidden" name="passport_info" value="<?php echo $candidate['passportNum']."_".$candidate['creationDate'];?>">
                                    <input type="hidden" name="agentEmail" value="<?php echo $candidate['agentEmail'];?>">
                                    <button class="btn btn-sm btn-success" type="submit" id="add_visa" ><span class="fas fa-plus" aria-hidden="true"></span></button>
                                </form>
                            </div>
                        </div>
                        </td>
                        <!-- Training Card -->
                        <td>
                        <div class="row">
                        <?php
                        if($candidate['oldVisa'] == 'no'){
                            if($candidate['trainingCard'] == 'yes'){ ?>
                                <div class="col-sm-3">
                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#trainingCardFileSubmit" id="trainingPassport" value="<?php echo $candidate['passportNum'];?>" onclick="trainingCard(this.value)"><span class="fas fa-redo"></span></button>
                                </div>
                                <div class="col-sm-3"> 
                                    <a href="<?php echo $candidate['trainingCardFile'];?>" target="_blank"><button class="btn btn-info btn-sm"><span class="fas fa-search"></span></button></a>
                                </div>                            
                            <?php }else{ ?>
                                <div class="col-sm-3"> 
                                    <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#trainingCardFileSubmit" id="trainingPassport" value="<?php echo $candidate['passportNum'];?>" onclick="trainingCard(this.value)">No</button>
                                </div>                            
                            <?php } ?>
                            <div class="col-sm-3">
                                <form action="index.php" method="post">
                                    <input type="hidden" name="redir" value="listCandidate">
                                    <input type="hidden" name="pagePost" value="addCandidatePayment">
                                    <input type="hidden" name="purpose" value="Training Card">
                                    <input type="hidden" name="candidateName" value="<?php echo $candidate['fName']." ".$candidate['lName'];?>">
                                    <input type="hidden" name="passport_info" value="<?php echo $candidate['passportNum']."_".$candidate['creationDate'];?>">
                                    <input type="hidden" name="agentEmail" value="<?php echo $candidate['agentEmail'];?>">
                                    <button class="btn btn-sm btn-success" type="submit" id="add_visa" ><span class="fas fa-plus" aria-hidden="true"></span></button>
                                </form>
                            </div>                       
                        <?php }else{ ?>
                            <div class="col-sm">
                                <a href="?page=cI&p=<?php echo base64_encode($candidate['passportNum'])."&cd=.".base64_encode($candidate['creationDate'])."&t=".time();?>"><p class="text-center">Experienced</p></a>
                            </div>
                        <?php } ?>
                        </div>
                        </td>
                        <td>
                            <div class="container">
                                <div class="row">
                                    <div class="col-3">
                                        <form action="index.php" method="post">
                                            <input type="hidden" name="alter" value="update">
                                            <input type="hidden" value="editCandidate" name="pagePost">
                                            <input type="hidden" value="<?php echo $candidate['passportNum']; ?>" name="passportNum">
                                            <input type="hidden" value="<?php echo $candidate['creationDate']; ?>" name="creationDate">
                                            <button type="submit" class="btn btn-primary btn-sm"><span class="fa fa-edit" aria-hidden="true"></span></></button>
                                        </form>
                                    </div>
                                    <div class="col-3">
                                        <form action="template/editCandidateQry.php" method="post">
                                            <input type="hidden" name="alter" value="delete">
                                            <input type="hidden" value="editCandidate" name="pagePost">
                                            <input type="hidden" value="<?php echo $candidate['passportNum']; ?>" name="passportNum">
                                            <input type="hidden" value="<?php echo $candidate['creationDate']; ?>" name="creationDate">
                                            <button type="submit" class="btn btn-danger btn-sm"><span class="fa fa-close" aria-hidden="true"></span></button>
                                        </form>
                                    </div>
                                    <div class="col-3">                                    
                                        <a href="?page=ce<?php echo "&pn=".base64_encode($candidate['passportNum'])."&cd=".base64_encode($candidate['creationDate']);  ?>" target="_blank"><button class="btn btn-sm btn-info" type="button" id="add_visa" ><span class="fa fa-dollar" aria-hidden="true"></span></button></a>                                      
                                    </div>
                                </div>
                            </div>
                        </td>
                        </tr>
                    <?php } ?>
                    <tfoot>
                    <tr hidden>
                        <th>Passport No</th>
                        <th>Candidate Name</th> 
                        <th>Country</th>               
                        <th>Mobile No</th>
                        <th>Age</th>
                        <th>Passport Validity</th>
                        <th>Amount of experience</th>
                        <th>Police Clearance</th>
                        <th>Passport Photo</th>
                        <th>Test Medical</th>
                        <th>Final Medical</th>
                        <th>Creation Date</th>
                        <th>Edit</th>
                    </tr>
                    </tfoot>

                </table>
            </div>
        </div>
    </div>
    
</div>

<script>
function trainingCard(passport_info){
    $('#passportNum').val(passport_info);
}

function testMedical(passport_info){
    $('#passportMedical').val(passport_info);
}

function finalMedical(passport_info){
    $('#passportMedicalFinal').val(passport_info);
}

function policeClearance(passport_info){
    $('#modalPassportPolice').val(passport_info);
}

$('#candidateNav').addClass('active');
</script>






