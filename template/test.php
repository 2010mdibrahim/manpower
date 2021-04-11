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
$passportNum = 'BT0078911';
$creationDate = '2021-04-08 11:19:34';
$passportInfo = mysqli_fetch_assoc($conn->query("SELECT jobs.jobType, agent.agentName, passport.* from passport inner join agent using(agentEmail) left join jobs using (jobId) where passport.passportNum = '$passportNum' AND passport.creationDate = '$creationDate'"));
$hasVisa = mysqli_fetch_assoc($conn->query("SELECT count(processingId) as processingCount from processing where passportNum = '$passportNum' AND passportCreationDate = '$creationDate'"));
$documentation = '';
?>
<style>
    .personal-card-body{
        padding-left: 0;
    }
    .card{
        justify-content: center;
    }
    .full-body{
        font-size: 15px;
        color: #455a64;
    }
    ul{
        list-style-type: none;
        text-align: left;
    }
    li{
        border-bottom: 1px #eceff1 solid;
        border-radius: 3px;
        padding: 2px;
    }
    .label{
        font-size: 27px;
        font-weight: 5000;
        color: #0277bd;
    }
    .left-row{
        background-color: #f5f5f5;
        border-radius: 5px;
    }
    .right-row{
        background-color: #cfd8dc;
        border-radius: 5px;
    }
    .image{
        border-radius: 10px;
    }
    .row{
        margin-left: 0;
        margin-right: 0;
    }
    .points{
        color: #039be5;
    }
    .list-group-item{
        background-color: #bdbdbd ;
    }
    .document-anchor{
        margin-bottom: 5px;
    }
</style>
<div class="card full-body">
    <div class="row">
        <div class="col-md-4 left-row">
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-sm">
                        <?php echo ($passportInfo['passportPhoto'] == 'yes') ? '<img class="image" src="'.$passportInfo['passportPhotoFile'].'" width="150px" height="150px">' : 'No Photo Uploaded';?>
                    </div>
                </div>
            </div>
            <div class="card-body personal-card-body">
                <ul>
                    <li>
                        <div class="row">
                            <div class="col-md-4 points">
                                Name:
                            </div>
                            <div class="col-sm">
                                <p><?php echo $passportInfo['fName']." ".$passportInfo['lName'];?></p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-md-4 points">
                                Gender:
                            </div>
                            <div class="col-sm">
                                <p><?php echo $passportInfo['gender'];?></p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-md-4 points">
                                Phone Number:
                            </div>
                            <div class="col-sm">
                                <p><?php echo $passportInfo['mobNum'];?></p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-md-4 points">
                                Date of Birth:
                            </div>
                            <div class="col-sm">
                                <p><?php echo $passportInfo['dob'];?></p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-md-4 points">
                                Agent:
                            </div>
                            <div class="col-sm">
                                <p><?php echo $passportInfo['agentName'];?></p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-8 right-row">
            <div class="card-body">
            </div>
            <div class="card-body">
                <label class="label" for="passportList">Passport</label>
                <ul>
                    <li>
                        <div class="row">
                            <div class="col-md-2 points">
                                <p>Passport Number: </p>
                            </div>
                            <div class="col-sm">
                                <span><?php echo $passportInfo['passportNum'];?></span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <?php
                            $expiryDate = new DateTime($passportInfo['issueDate']);
                            $format = "P".$passportInfo['validity']."Y";
                            $expiryDate->add(new DateInterval($format));
                        ?>
                        <div class="row">
                            <div class="col-md-2 points">
                                <p>Issue Date: </p>
                            </div>
                            <div class="col-sm">
                                <span><?php echo $passportInfo['issueDate'];?></span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-md-2 points">
                                <p>Expiry Date: </p>
                            </div>
                            <div class="col-sm">
                                <span><?php echo $expiryDate->format('Y-m-d');?></span>
                            </div>
                        </div>
                    </li>
                    <li>
                    <?php if($passportInfo['experienceStatus'] == 'experienced'){ ?>
                        <div class="row">
                            <div class="col-md-2 points">
                                <span>Experienced: </span>
                            </div>
                            <div class="col-sm">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="row">
                                            Depature Date: 
                                        </div>
                                        <div class="row">
                                            <span><?php echo ($passportInfo['departureDate'] == '0000-00-00') ? 'No Date' : $passportInfo['departureDate'];?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            Arrival Date: 
                                        </div>
                                        <div class="row">
                                            <span><?php echo ($passportInfo['arrivalDate'] == '0000-00-00') ? 'No Date' : $passportInfo['arrivalDate'];?></span>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <p>Visited Country: 
                                        <?php 
                                        $result_country = $conn->query("SELECT * from passportexperiencedcountry where passportNum = '".$passportInfo['passportNum']."' AND passportCreationDate = '".$passportInfo['creationDate']."'");
                                        while($country = mysqli_fetch_assoc($result_country)){ ?>
                                        <span><?php echo $country['country']; ?></span>
                                        <?php } ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }else{ ?>
                        <div class="row">
                            <div class="col-md-2 points">
                                <span>New: </span>
                            </div>
                            <div class="col-sm">
                                <?php if($passportInfo['trainingCard'] == 'yes'){ ?>
                                    <a href="<?php echo $passportInfo['trainingCardFile'];?>" target="_blank"><button class="btn">Training Card</button></a>
                                <?php }else{ ?>
                                    <p>No Training Card Uploaded</p>
                                <?php } ?>
                            </div>
                        </div>                                       
                    <?php } ?>
                    </ul>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm">
                        <label class="label" for="passportList">Applied for</label>
                        <ul>
                            <li>
                                <div class="row">
                                    <div class="col-md-4 points">
                                        <p>Job: </p>
                                    </div>
                                    <div class="col-sm">
                                        <span><?php echo $passportInfo['jobType'];?></span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-4 points">
                                        <p>Country: </p>
                                    </div>
                                    <div class="col-sm">
                                        <span><?php echo $passportInfo['country'];?></span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-md-4 points">
                                        <p>Manpower Office: </p>
                                    </div>
                                    <div class="col-sm">
                                        <span><?php echo $passportInfo['manpowerOfficeName'];?></span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm">
                        <label class="label" for="passportList">Documents</label>
                        <ul>
                            <li class="list-group-item">  
                                <a href="<?php echo $passportInfo['passportScannedCopy']; $documentation .= $passportInfo['passportScannedCopy']?>" target="_blank"><button class="btn document-anchor">Passport Scanned Copy</button></a>
                                <?php if($passportInfo['testMedical'] == 'yes'){ ?>
                                    <a href="<?php echo $passportInfo['testMedicalFile'];$documentation .= '~'.$passportInfo['testMedicalFile'];?>" target="_blank"><button class="btn document-anchor">Test Medical</button></a>
                                <?php }?>
                                <?php if($passportInfo['finalMedical'] == 'yes'){ ?>
                                    <a href="<?php echo $passportInfo['finalMedicalFile'];$documentation .= '~'.$passportInfo['finalMedicalFile'];?>" target="_blank"><button class="btn document-anchor">Final Medical</button></a>
                                <?php }?>
                                <?php if($passportInfo['policeClearance'] == 'yes'){ ?>
                                    <a href="<?php echo $passportInfo['policeClearanceFile'];$documentation .= '~'.$passportInfo['policeClearanceFile'];?>" target="_blank"><button class="btn document-anchor">Police Clearance</button></a>
                                <?php }?>
                                <?php if($passportInfo['experienceStatus'] == 'experienced'){ ?>
                                    <a href="<?php echo $passportInfo['departureSealFile'];$documentation .= '~'.$passportInfo['departureSealFile'];?>" target="_blank"><button class="btn document-anchor">Departure Seal</button></a>
                                    <a href="<?php echo $passportInfo['arrivalSealFile'];$documentation .= '~'.$passportInfo['arrivalSealFile'];?>" target="_blank"><button class="btn document-anchor">Arrival Seal</button></a>
                                    <?php
                                    $result = $conn->query("SELECT * from optionalfiles where passportNum = '".$passportInfo['passportNum']."' AND passportCreationDate = '".$passportInfo['creationDate']."'");
                                    $i = 1;
                                    if(!is_null($result)){
                                        while($optional = mysqli_fetch_assoc($result)){ ?>
                                            <a href="<?php echo $optional['optionalFile'];$documentation .= '~'.$optional['optionalFile'];?>" target="_blank"><button class="btn document-anchor">Opt #<?php $i++;?></button></a>                                        
                                <?php   } 
                                    } 
                                }else{ ?>
                                    <a href="<?php echo $passportInfo['trainingCardFile'];$documentation .= '~'.$passportInfo['trainingCardFile'];?>" target="_blank"><button class="btn document-anchor">Training Card</button></a>
                                <?php } ?>
                                <a href="template/getZip.php?doc=<?php echo base64_encode($documentation);?>"><button class="btn btn-warning document-anchor"><i class="fa fa-download"></i></button></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php 
            $hasVisa = mysqli_fetch_assoc($conn->query("SELECT count(processingId) as processingCount from processing where passportNum = '$passportNum' AND passportCreationDate = '$creationDate'"));
            if($hasVisa['processingCount'] != 0){
            $visaInfo = mysqli_fetch_assoc($conn->query("SELECT sponsorvisalist.sponsorVisa, ticket.flightDate, delegate.delegateName, delegateoffice.officeName, sponsor.sponsorName, processing.* from processing LEFT JOIN ticket on processing.passportNum = ticket.passportNum AND processing.passportCreationDate = ticket.passportCreationDate INNER JOIN sponsorvisalist USING (sponsorVisa) INNER JOIN sponsor on sponsor.sponsorNID = sponsorvisalist.sponsorNID INNER JOIN delegateoffice on delegateoffice.delegateOfficeId = sponsor.delegateOfficeId INNER JOIN delegate on delegate.delegateId = delegateoffice.delegateId where processing.passportNum = '$passportNum' AND processing.passportCreationDate = '$creationDate'"));
            ?>
            <div class="card-body">
                <label class="label" for="passportList">VISA Information</label>
                <ul>
                    <li>
                        <div class="row">
                            <div class="col-md-2 points">
                                <p>Delegate Name: </p>
                            </div>
                            <div class="col-sm">
                                <span><?php echo $visaInfo['delegateName'];?></span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-md-2 points">
                                <p>Delegate Office: </p>
                            </div>
                            <div class="col-sm">
                                <span><?php echo $visaInfo['officeName'];?></span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-md-2 points">
                                <p>Sponsor Name: </p>
                            </div>
                            <div class="col-sm">
                                <span><?php echo $visaInfo['sponsorName'];?></span>
                            </div>
                        </div>
                    </li>                    
                    <li>
                        <div class="row">
                            <div class="col-md-2 points">
                                <p>Sponsor VISA: </p>
                            </div>
                            <div class="col-sm">
                                <span><?php echo $visaInfo['sponsorVisa'];?></span>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <?php } ?>
        </div>
    </div>
</div>