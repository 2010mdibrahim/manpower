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
$passportNum = $_GET['passportNum'];
$creationDate = $_GET['creationDate'];
$passportInfo = mysqli_fetch_assoc($conn->query("SELECT jobs.jobType, agent.agentName, passport.* from passport inner join agent using(agentEmail) left join jobs using (jobId) where passport.passportNum = '$passportNum' AND passport.creationDate = '$creationDate'"));
$hasVisa = mysqli_fetch_assoc($conn->query("SELECT count(processingId) as processingCount from processing where passportNum = '$passportNum' AND passportCreationDate = '$creationDate'"));
$documentation = '';
?>
<style>
    span{
        font-size: 1.2rem;
        text-align:right;
    }
    ul{
        list-style-type: none;
        text-align: left;
    }
    p{
        text-align: left;
    }
    .list-group-inside{
        padding-left: 45px;
        padding-top: 20px;
    }
    .inside-text{
        font-size: 0.8rem;
    }
    .card{
        width: 100%;
    }
</style>
<div class="card text-center">
  <div class="card-header">
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Personal Infomation</a>
        <!-- <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</a> -->
        <!-- <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a> -->
    </div>
  </div>
  <div class="tab-content" id="nav-tabContent">
    <div class="card-body tab-pane fade show active" id="nav-home" role="tabpanel">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="card">
                    <div class="card-header"> Personal Information</div>
                    <div class="card-body">
                        <div class="row" style="width: 100%;">
                            <div class="col-sm">
                                <div class="card-body">
                                    <?php echo ($passportInfo['passportPhoto'] == 'yes') ? '<img src="'.$passportInfo['passportPhotoFile'].'" width="150px" height="150px">' : 'No Photo Uploaded';?>
                                </div>
                            </div>
                            <div class="col-sm">
                                <ul>
                                    <li>
                                        <p>Agent: <span><?php echo $passportInfo['agentName'];?></span></p>
                                    </li>
                                    <li>
                                        <p>Name: <span><?php echo $passportInfo['fName']." ".$passportInfo['lName'];?></span></p>
                                    </li>
                                    <li>
                                        <p>Passport Number: <span ><?php echo $passportInfo['passportNum'];?></span></p>
                                    </li>
                                    <li>
                                        <p>Mobile Number: <span><?php echo $passportInfo['mobNum'];?></span></p>
                                    </li>              
                                </ul>
                            </div>
                            <div class="col-sm">
                                <ul>
                                    <li>
                                        <p>Gender: <span><?php echo $passportInfo['gender'];?></span></p>
                                    </li>
                                    <li>
                                        <p>Date of Birth: <span><?php echo $passportInfo['dob'];?></span></p>
                                    </li>
                                    <li>
                                    <?php
                                        $expiryDate = new DateTime($passportInfo['issueDate']);
                                        $format = "P".$passportInfo['validity']."Y";
                                        $expiryDate->add(new DateInterval($format));
                                    ?>
                                        <p>Issue Date: <span><?php echo $passportInfo['issueDate'];?></span></p>
                                    </li>
                                    <li>
                                        <p>Expiry Date: <span><?php echo $expiryDate->format('Y-m-d');?></span></p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header"> Passport Related Information</div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Applied For Job: <span><?php echo $passportInfo['jobType'];?></span></li>
                            <li class="list-group-item">Applied Country: <span><?php echo $passportInfo['country'];?></span></li>
                            <li class="list-group-item">Manpower Office: <span><?php echo $passportInfo['manpowerOfficeName'];?></span></li>
                            <li class="list-group-item">Documentation:  
                                    <a href="<?php echo $passportInfo['passportScannedCopy']; $documentation .= $passportInfo['passportScannedCopy']?>" target="_blank"><button class="btn">Passport Scanned Copy</button></a>
                                <?php if($passportInfo['testMedical'] == 'yes'){ ?>
                                    <a href="<?php echo $passportInfo['testMedicalFile'];$documentation .= '~'.$passportInfo['testMedicalFile'];?>" target="_blank"><button class="btn">Test Medical</button></a>
                                <?php }?>
                                <?php if($passportInfo['finalMedical'] == 'yes'){ ?>
                                    <a href="<?php echo $passportInfo['finalMedicalFile'];$documentation .= '~'.$passportInfo['finalMedicalFile'];?>" target="_blank"><button class="btn">Final Medical</button></a>
                                <?php }?>
                                <?php if($passportInfo['policeClearance'] == 'yes'){ ?>
                                    <a href="<?php echo $passportInfo['policeClearanceFile'];$documentation .= '~'.$passportInfo['policeClearanceFile'];?>" target="_blank"><button class="btn">Police Clearance</button></a>
                                <?php }?>
                                <a href="template/getZip.php?doc=<?php echo base64_encode($documentation);?>"><button class="btn btn-warning"><i class="fa fa-download"></i></button></a>
                            </li>
                            <li class="list-group-item">
                                <?php if($passportInfo['experienceStatus'] == 'experienced'){ ?>
                                    Candidate Previous Status: <span>Experienced</span>
                                    <ul class="list-group-inside list-group-flush">
                                        <li>
                                            <div class="row">
                                                <div class="col-sm">
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <p>Depature Date: <span><?php echo ($passportInfo['departureDate'] == '0000-00-00') ? 'No Date' : $passportInfo['departureDate'];?></span></p>
                                                        </div>
                                                        <div class="col-sm">
                                                            <a href="<?php echo $passportInfo['departureSealFile'];?>" target="_blank"><button class="btn">Departure Seal</button></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm">
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <p>Arrival Date: <span><?php echo ($passportInfo['arrivalDate'] == '0000-00-00') ? 'No Date' : $passportInfo['arrivalDate'];?></span></p>
                                                        </div>
                                                        <div class="col-sm">
                                                            <a href="<?php echo $passportInfo['arrivalSealFile'];?>" target="_blank"><button class="btn">Departure Seal</button></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <p>Visited Country: </p>
                                                <?php 
                                                $result_country = $conn->query("SELECT * from passportexperiencedcountry where passportNum = '".$passportInfo['passportNum']."' AND passportCreationDate = '".$passportInfo['creationDate']."'");
                                                while($country = mysqli_fetch_assoc($result_country)){
                                                ?>
                                                <div class="col-md-1">
                                                    <button class="btn btm-info"><?php echo $country['country']; ?></button>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </li>
                                <?php }else{ ?>
                                    Candidate Previous Status: <span>New</span>
                                    <ul class="list-group-inside list-group-flush">
                                        <li> 
                                            <?php if($passportInfo['trainingCard'] == 'yes'){ ?>
                                                <a href="<?php echo $passportInfo['trainingCardFile'];?>" target="_blank"><button class="btn">Training Card</button></a>
                                            <?php }else{ ?>
                                                <p>No Training Card Uploaded</p>
                                            <?php } ?>
                                        </li>                                        
                                <?php } ?>
                                </ul>
                                
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header"> VISA Related Information</div>
                    <?php 
                    if($hasVisa['processingCount'] > 0){ 
                        $visaInfo = mysqli_fetch_assoc($conn->query("SELECT sponsorvisalist.sponsorVisa, ticket.flightDate, delegate.delegateName, delegateoffice.officeName, sponsor.sponsorName, processing.* from processing LEFT JOIN ticket on processing.passportNum = ticket.passportNum AND processing.passportCreationDate = ticket.passportCreationDate INNER JOIN sponsorvisalist USING (sponsorVisa) INNER JOIN sponsor on sponsor.sponsorNID = sponsorvisalist.sponsorNID INNER JOIN delegateoffice on delegateoffice.delegateOfficeId = sponsor.delegateOfficeId INNER JOIN delegate on delegate.delegateId = delegateoffice.delegateId where processing.passportNum = '$passportNum' AND processing.passportCreationDate = '$creationDate'"));
                    ?>
                        <div class="card-body">
                            <label for="" style="text-align: left;">Delegate Information</label>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Delegate Name: <span><?php echo $visaInfo['delegateName'];?></span></li>
                                <li class="list-group-item">Sponsor Name: <span><?php echo $visaInfo['sponsorName'];?></span></li>
                                <li class="list-group-item">Sponsor under Office: <span><?php echo $visaInfo['officeName'];?></span></li>
                                <li class="list-group-item">Sponsor VISA: <span><?php echo $visaInfo['sponsorVisa'];?></span></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <label for="" style="text-align: left;">VISA Stage</label>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Employee Request: <span><?php echo ($visaInfo['empRqst'] == 'yes') ? 'Done' : 'Not Done';?></span></li>
                                <li class="list-group-item">Foreign MOLE: <span><?php echo ($visaInfo['foreignMole'] == 'yes') ? 'Done' : 'Not Done';?></span></li>
                                <li class="list-group-item">OKALA: <span>
                                <?php if($visaInfo['okala'] == 'yes'){ ?>
                                    <a href="<?php echo $visaInfo['okalaFile'];?>" target="_blank"><button class="btn">Okala</button></a>
                                <?php }else{ ?>
                                    Not Done
                                <?php } ?>
                                </span></li>
                                <li class="list-group-item">MUFA: <span>
                                <?php if($visaInfo['mufa'] == 'yes'){ ?>
                                    <a href="<?php echo $visaInfo['mufaFile'];?>" target="_blank"><button class="btn">MUFA</button></a>
                                <?php }else{ ?>
                                    Not Done
                                <?php } ?>
                                </span></li>
                                <li class="list-group-item">Medical Update: <span><?php echo ($visaInfo['medicalUpdate'] == 'yes') ? 'Done' : 'Not Done';?></span></li>
                                <li class="list-group-item">VISA Stamping: <span>
                                <?php if($visaInfo['visaStamping'] == 'yes'){ ?>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-sm">Stamping Date:</div>
                                                <div class="col-sm"><?php echo $visaInfo['visaStampingDate']; ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <a href="<?php echo $visaInfo['visaFile'];?>" target="_blank"><button class="btn">Stamping File</button></a>
                                        </div>
                                    </div>
                                <?php }else{ ?>
                                    Not Done
                                <?php } ?>
                                </span></li>
                                <li class="list-group-item">Finger: <span><?php echo ($visaInfo['finger'] == 'yes') ? 'Done' : 'Not Done';?></span></li>
                                <li class="list-group-item">Manpower Card: <span>
                                <?php if($visaInfo['manpowerCard'] == 'yes'){ ?>
                                    <a href="<?php echo $visaInfo['manpowerCardFile'];?>" target="_blank"><button class="btn">Manpower Card</button></a>
                                <?php }else{ ?>
                                    Not Done
                                <?php } ?>
                                </span></li>
                                <li class="list-group-item">Flight Date: <span>
                                <?php if(!is_null($visaInfo['flightDate'])){ ?>
                                    <span><?php echo $visaInfo['flightDate'];?></span>
                                <?php }else{ ?>
                                    No Ticket Assigned
                                <?php } ?>
                                </span></li>
                            </ul>
                        </div>
                    <?php }else{ ?>
                        <div class="card-body">
                            <h5>No VISA assigned</h5>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
<script>
    function getZip(documentation){
        $.ajax({
            type: 'post',
            url: 'template/getAllDocument.php',
            data: {documentation: documentation}
        });
    }
</script>