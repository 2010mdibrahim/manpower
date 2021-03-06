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
if(isset($_GET['pp'])){
    $passportNum = base64_decode($_GET['pp']);
    $creationDate = base64_decode($_GET['cd']);
    $result = $conn -> query("SELECT processing.pending, processing.pendingTill, agent.agentName, jobs.jobType, jobs.creditType, passport.*, DATE(passport.creationDate) as creationDateShow from passport left join jobs using (jobId) inner join agent using (agentEmail) INNER JOIN processing on processing.passportNum = passport.passportNum AND processing.passportCreationDate = passport.creationDate where processing.pending = 3 AND passport.passportNum = '$passportNum' and passport.creationDate = '$creationDate'");
}else if(isset($_GET['ag'])){
    $agentEmail = base64_decode($_GET['ag']);
    $result = $conn -> query("SELECT processing.pending, processing.pendingTill, agent.agentName, jobs.jobType, jobs.creditType, passport.*, DATE(passport.creationDate) as creationDateShow from passport left join jobs using (jobId) inner join agent using (agentEmail) INNER JOIN processing on processing.passportNum = passport.passportNum AND processing.passportCreationDate = passport.creationDate where processing.pending = 3 AND passport.agentEmail = '$agentEmail'");
}else{
    $result = $conn -> query("SELECT processing.pending, processing.pendingTill, agent.agentName, jobs.jobType, jobs.creditType, passport.*, DATE(passport.creationDate) as creationDateShow from passport left join jobs using (jobId) inner join agent using (agentEmail) INNER JOIN processing on processing.passportNum = passport.passportNum AND processing.passportCreationDate = passport.creationDate where processing.pending = 3 order by passport.creationDate desc");
}
?>

<style>
    .btn_custom{
        padding: 1%;
        align-content: center;
    }
    .flex-container {
        display: flex;
        flex-direction: row;
    }
    html {
        scroll-behavior: smooth;
    }    
</style>
<div class="container-fluid" style="padding: 2%">
    <div class="card">
        <div class="card-header">
            <div class="section-header">
                <h2>Returned Candidate List</h2>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTableSeaum" class="table table-bordered table-hover"  style="width:100%">
                    <thead>
                    <tr>
                        <th>Creation Date & Agent Name</th>
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
                        $today = new Datetime(date('Y-m-d'));
                        // ----- experience days ------
                        $arrivalDate = new DateTime($candidate['arrivalDate']);
                        $departureDate = new DateTime($candidate['departureDate']);
                        $experience = $departureDate->diff($arrivalDate);
                        
                        // ------- validity days -------
                        $expiryDate = new DateTime($candidate['issueDate']); // will add validity to this date thats why it is expiry date
                        $format = "P".$candidate['validity']."Y";
                        $expiryDate->add(new DateInterval($format));
                        $validity = $expiryDate->diff($today);

                        // ---------- DOB -----------
                        $bday = new Datetime($candidate['dob']);
                        $age = $today->diff($bday);
                    
                        if($candidate['testMedicalStatus'] == 'unfit' || $candidate['finalMedicalStatus'] == 'unfit'){ ?>
                            <tr style="background-color: #fb8c00;">
                        <?php }else if($age->y > 38){ ?>
                            <tr style="background-color: #fffde7;">
                        <?php }else{ ?>
                            <tr>
                        <?php } ?>
                        

                        <!-- Creation Date -->
                        <td>
                        <p><?php echo $candidate['creationDateShow'];?></p>
                        <p><a href="?page=agentList&agE=<?php echo base64_encode($candidate['agentEmail']);?>"><?php echo $candidate['agentName'];?></a></p>
                        </td>
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
                        <p style="font-size: 11px;">(<?php echo (!is_null($candidate['jobType'])) ? $candidate['jobType'] : 'Not Assigned';?>)</p>
                        </td>
                        <!-- Test Medical -->
                        <td class="second">
                        <div class="row justify-content-center">              
                            <?php if(empty($candidate['testMedical']) || $candidate['testMedical']=='no'){ ?>
                                <div class="btn_custom">
                                    <button class="btn btn-secondary btn-sm" value="<?php echo $candidate['passportNum']."_".$candidate['creationDate'];?>" name="testMedicalFile" data-target="#testMedicalSubmit" data-toggle="modal" id="testMedicalFile" onclick="testMedical(this.value)">No</button>
                                </div>                            
                            <?php } else { ?> 
                                    <div class="btn_custom">
                                        <button class="btn btn-danger btn-sm" value="<?php echo $candidate['passportNum']."_".$candidate['creationDate'];?>" name="testMedicalFile" data-target="#testMedicalSubmit" data-toggle="modal" id="testMedicalFile" onclick="testMedical(this.value)"><span class="fas fa-redo"></span></button>
                                    </div>
                                    <div class="btn_custom">
                                        <a href="<?php echo $candidate['testMedicalFile']."?t=".time();?>" target="_blank"><button class="btn btn-info btn-sm"><span class="fas fa-search"></span></button></a>
                                    </div>
                                    <div class="btn_custom">
                                    <?php if($candidate['testMedicalStatus'] == 'fit'){?>
                                        <form action="template/medicalFittness.php" method="post">
                                            <input type="hidden" name="medical" value="testMedicalStatus">
                                            <input type="hidden" name="passportNum" value="<?php echo $candidate['passportNum'] ?>">
                                            <input type="hidden" name="creationDate" value="<?php echo $candidate['creationDate'] ?>">
                                            <input type="hidden" name="medicalStatus" value="<?php echo $candidate['testMedicalStatus'] ?>">
                                            <button class="btn btn-primary btn-sm"><span class="fa fa-check"></span></button>
                                        </form>
                                    <?php }else{ ?>
                                        <form action="template/medicalFittness.php" method="post">
                                            <input type="hidden" name="medical" value="testMedicalStatus">
                                            <input type="hidden" name="passportNum" value="<?php echo $candidate['passportNum'] ?>">
                                            <input type="hidden" name="creationDate" value="<?php echo $candidate['creationDate'] ?>">
                                            <input type="hidden" name="medicalStatus" value="<?php echo $candidate['testMedicalStatus'] ?>">
                                            <button class="btn btn-warning btn-sm"><span class="fa fa-minus-circle"></span></button>
                                        </form>
                                    <?php } ?>
                                    </div>
                            <?php } ?>
                        </div></td>
                        <!-- Final Medical -->
                        <td class="second">                        
                        <?php                        
                            if(empty($candidate['testMedical']) || $candidate['testMedical']=='no'){ ?>
                                <button class="btn btn-warning btn-sm">Do Previous</button>
                            <?php }else{ ?>
                            <div class="row justify-content-center" style="padding-bottom: 5%;">
                                <?php if(empty($candidate['finalMedical']) || $candidate['finalMedical']=='no'){ ?>                                
                                    <div class="btn_custom">
                                        <button class="btn btn-secondary btn-sm" value="<?php echo $candidate['passportNum']."_".$candidate['creationDate'];?>" name="finalMedicalFile" data-target="#finalMedicalSubmit" data-toggle="modal" id="finalMedicalFile" onclick="finalMedical(this.value)">No</button>
                                    </div>
                                <?php } else { ?>                            
                                        <div class="btn_custom">
                                            <button class="btn btn-danger btn-sm" value="<?php echo $candidate['passportNum']."_".$candidate['creationDate']."_".$candidate['finalMedicalReport'];?>" name="finalMedicalFile" data-target="#finalMedicalSubmit" data-toggle="modal" id="finalMedicalFile" onclick="finalMedical(this.value)"><span class="fas fa-redo"></span></button>
                                        </div>
                                        <div class="btn_custom"> 
                                            <a href="<?php echo $candidate['finalMedicalFile']."?t=".time();?>" target="_blank"><button class="btn btn-info btn-sm"><span class="fas fa-search"></span></button></a>
                                        </div>
                                        <div class="btn_custom">
                                        <?php if($candidate['finalMedicalStatus'] == 'fit'){?>
                                            <form action="template/medicalFittness.php" method="post">
                                                <input type="hidden" name="medical" value="finalMedicalStatus">
                                                <input type="hidden" name="passportNum" value="<?php echo $candidate['passportNum'] ?>">
                                                <input type="hidden" name="creationDate" value="<?php echo $candidate['creationDate'] ?>">
                                                <input type="hidden" name="medicalStatus" value="<?php echo $candidate['finalMedicalStatus'] ?>">
                                                <button class="btn btn-primary btn-sm"><span class="fa fa-check"></span></button>
                                            </form>
                                        <?php }else{ ?>
                                            <form action="template/medicalFittness.php" method="post">
                                                <input type="hidden" name="medical" value="finalMedicalStatus">
                                                <input type="hidden" name="passportNum" value="<?php echo $candidate['passportNum'] ?>">
                                                <input type="hidden" name="creationDate" value="<?php echo $candidate['creationDate'] ?>">
                                                <input type="hidden" name="medicalStatus" value="<?php echo $candidate['finalMedicalStatus'] ?>">
                                                <button class="btn btn-warning btn-sm"><span class="fa fa-minus-circle"></span></button>
                                            </form>
                                        <?php } ?>
                                        </div>                                                      
                                <?php } ?>
                                </div>
                                <div class="btn_custom">
                                    <?php if($candidate['finalMedical'] == 'yes') { ?>
                                        <button class="btn btn-info btn-sm"><?php echo $candidate['finalMedicalReport'];?></button>
                                    <?php } ?>
                                </div>                                    
                            <?php } ?>
                        </div></td>
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
                        </div>
                        </td>
                        <!-- Training Card -->
                        <td>
                        <div class="row">
                        <?php
                        if($candidate['departureSeal'] == 'no'){
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
                                    <!-- <div class="col-1"> -->
                                        <form action="index.php" method="post">
                                            <input type="hidden" name="alter" value="update">
                                            <input type="hidden" value="editCandidate" name="pagePost">
                                            <input type="hidden" value="<?php echo $candidate['passportNum']; ?>" name="passportNum">
                                            <input type="hidden" value="<?php echo $candidate['creationDate']; ?>" name="creationDate">
                                            <button type="submit" class="btn btn-primary btn-sm"><span class="fa fa-edit" aria-hidden="true"></span></></button>
                                        </form>
                                    <!-- </div> -->
                                    <!-- <div class="col-1"> -->
                                        <form action="template/editCandidateQry.php" method="post">
                                            <input type="hidden" name="alter" value="delete">
                                            <input type="hidden" value="editCandidate" name="pagePost">
                                            <input type="hidden" value="<?php echo $candidate['passportNum']; ?>" name="passportNum">
                                            <input type="hidden" value="<?php echo $candidate['creationDate']; ?>" name="creationDate">
                                            <button type="submit" class="btn btn-danger btn-sm"><span class="fa fa-close" aria-hidden="true"></span></button>
                                        </form>
                                    <!-- </div> -->
                                    <!-- <div class="col-1">                                     -->
                                        <a href="?page=ce<?php echo "&pn=".base64_encode($candidate['passportNum'])."&cd=".base64_encode($candidate['creationDate']);  ?>" target="_blank"><button class="btn btn-sm btn-info" type="button" id="add_visa" ><span class="fa fa-dollar" aria-hidden="true"></span></button></a>                                      
                                    <!-- </div> -->
                                    <!-- <div class="col-1">                                     -->
                                        <a href="?page=candidateInfo&passportNum=<?php echo $candidate['passportNum']; ?>&creationDate=<?php echo $candidate['creationDate']; ?>" target="_blank"><button class="btn btn-sm btn-warning" type="button" id="add_visa" ><span class="fa fa-eye" aria-hidden="true"></span></button></a>                                      
                                    <!-- </div> -->
                                    <?php if($candidate['finalMedical'] == 'yes' & $candidate['finalMedicalStatus'] == 'fit') { ?>
                                        <?php if($candidate['delegateComission'] == 0){ ?>
                                            <button class="btn btn-dark btn-sm" data-toggle="modal" data-target="#delegateComissionCandidate" id="trainingPassport" value="<?php echo $candidate['passportNum']."_".$candidate['creationDate'];?>" onclick="addDelegateExpense(this.value)"><span class="fa fa-dollar" aria-hidden="true"><span class="fa fa-plus" aria-hidden="true"></span></span></button>
                                        <?php }else{ ?>
                                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#delegateComissionCandidate" id="trainingPassport" value="<?php echo $candidate['passportNum']."_".$candidate['creationDate']."_".$candidate['delegateComission'];?>" onclick="editDelegateExpense(this.value)"><span class="fa fa-dollar" aria-hidden="true"><span class="fa fa-check" aria-hidden="true"></span></span></button>
                                        <?php } ?>                                            
                                    <?php } ?>
                                </div>
                            </div>
                        </td>
                        </tr>
                    <?php } ?>
                    <tfoot>
                    <tr hidden>
                        <th>Creation Date & Agent Name</th>
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
    var info_split = passport_info.split('_');
    $('#passportMedicalFinal').val(info_split[0]+'_'+info_split[1]);
    $('#finalMedicalDateModal').val(info_split[2]);
}

function policeClearance(passport_info){
    $('#modalPassportPolice').val(passport_info);
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
    $('#creationDateDelegateExpenseInfo').val(info[1]);;
    $('#delegateExpenseAmountModal').val(info[2]);;
}

$('#candidateNav').addClass('active');
</script>