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
    $result = $conn -> query("SELECT processingcompleted.pending, agent.agentName, jobs.jobType, jobs.creditType, passportcompleted.*, DATE(passportcompleted.creationDate) as creationDateShow from passportcompleted left join jobs using (jobId) inner join agent using (agentEmail) inner join processingcompleted on passportcompleted.passportNum = processingcompleted.passportNum AND passportcompleted.creationDate = processingcompleted.passportCreationDate where passportcompleted.passportNum = '$passportNum' and passportcompleted.creationDate = '$creationDate' and processingcompleted.pending = 3");
}else{
    $result = $conn -> query("SELECT processingcompleted.pending, agent.agentName, jobs.jobType, jobs.creditType, passportcompleted.*, DATE(passportcompleted.creationDate) as creationDateShow from passportcompleted left join jobs using (jobId) inner join agent using (agentEmail) inner join processingcompleted on passportcompleted.passportNum = processingcompleted.passportNum AND passportcompleted.creationDate = processingcompleted.passportCreationDate where processingcompleted.pending = 3 order by passportcompleted.creationDate desc");
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
    <div class="card">
        <div class="card-header">
            <div class="section-header">
                <h2>Completed Candidate List</h2>
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
                        <div class="row">              
                            <?php if(empty($candidate['testMedical']) || $candidate['testMedical']=='no'){ ?>
                                <div class="col-sm-3">
                                    <button class="btn btn-secondary btn-sm" value="<?php echo $candidate['passportNum']."_".$candidate['creationDate'];?>" name="testMedicalFile" data-target="#testMedicalSubmit" data-toggle="modal" id="testMedicalFile" onclick="testMedical(this.value)">No</button>
                                </div>                            
                            <?php } else { ?>
                                <div class="col-sm-3">    
                                    <a href="<?php echo $candidate['testMedicalFile']."?t=".time();?>" target="_blank"><button class="btn btn-info btn-sm"><span class="fas fa-search"></span></button></a>
                                </div>                                                        
                            <?php } ?>                                
                        </div></td>
                        <!-- Final Medical -->
                        <td class="second">
                        <div class="row">
                            <div class="col-sm-3"> 
                                <a href="<?php echo $candidate['finalMedicalFile']."?t=".time();?>" target="_blank"><button class="btn btn-info btn-sm"><span class="fas fa-search"></span></button></a>
                            </div> 
                            <div class="col-sm">
                                <?php if($candidate['finalMedical'] == 'yes') { ?>
                                    <button class="btn btn-info btn-sm"><?php echo $candidate['finalMedicalReport'];?></button>
                                <?php } ?>
                            </div>                                    
                        </div>
                        </td>
                        <!-- Police Clearance -->
                        <td>                        
                        <div class="row">
                            <?php 
                            if($candidate['policeClearance'] == 'yes'){ ?>
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
                        if($candidate['experienceStatus'] == 'new'){
                            if($candidate['trainingCard'] == 'yes'){ ?>
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
                                <a href="?page=ccI&p=<?php echo base64_encode($candidate['passportNum'])."&cd=.".base64_encode($candidate['creationDate'])."&t=".time();?>"><p class="text-center">Experienced</p></a>
                            </div>
                        <?php } ?>
                        </div>
                        </td>
                        <td>
                            <div class="container">
                                <div class="row">
                                    <div class="button_div">
                                        <form action="template/editCandidateQry.php" method="post">
                                            <input type="hidden" name="alter" value="delete">
                                            <input type="hidden" value="editCandidate" name="pagePost">
                                            <input type="hidden" value="yes" name="completed">
                                            <input type="hidden" value="<?php echo $candidate['passportNum']; ?>" name="passportNum">
                                            <input type="hidden" value="<?php echo $candidate['creationDate']; ?>" name="creationDate">
                                            <button type="submit" class="btn btn-danger btn-sm"><span class="fa fa-close" aria-hidden="true"></span></button>
                                        </form>
                                    </div>
                                    <div class="button_div">
                                        <a href="?page=cec<?php echo "&pn=".base64_encode($candidate['passportNum'])."&cd=".base64_encode($candidate['creationDate']);  ?>" target="_blank"><button class="btn btn-sm btn-info" type="button" id="add_visa" ><span class="fa fa-dollar" aria-hidden="true"></span></button></a>
                                    </div>
                                    <div class="button_div">
                                        <a href="?page=completedCandidateInfo&passportNum=<?php echo $candidate['passportNum']; ?>&creationDate=<?php echo $candidate['creationDate']; ?>" target="_blank"><button class="btn btn-sm btn-warning" type="button" id="add_visa" ><span class="fa fa-eye" aria-hidden="true"></span></button></a>
                                    </div>
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

$('#candidateNav').addClass('active');
</script>






