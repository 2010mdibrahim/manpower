<?php
if(isset($_POST['passportNum'])){
    $passportNum = $_POST['passportNum'];
}else{
    $passportNum = '';
}
$creationDate = $_POST['creationDate'];
$candidate = mysqli_fetch_assoc($conn -> query("SELECT * from passport where passportNum = '$passportNum' AND creationDate = '$creationDate'"));
?>

<style>
    span.danger{
        display: none;
        color: red;
        font-size: small;
    }
    
</style>

<div class="container">
    <div class="section-header">
        <h2>Edit Candidate Information</h2>
    </div>
    <form action="template/editCandidateQry.php" method="post" enctype="multipart/form-data" id="candidateForm">
        <input type="hidden" name="currentPassport" value="<?php echo $candidate['passportNum'];?>">
        <input type="hidden" name="currentCreationDate" value="<?php echo $creationDate;?>">
        <input type="hidden" name="alter" value="update">
        <h4 class="bg-light">Candidate Information</h4>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>First Name</label>
                <input type="text" class="form-control" required="required" name="fName" value="<?php echo $candidate['fName'];?>"/>
            </div>
            <div class="form-group col-md-6">
                <label>Gender <span class="danger" id="genderDanger">Select Gender</span> </label>
                <select class="form-control" name="gender" id="gender">
                    <?php if($candidate['gender'] == 'male'){ ?>
                        <option selected>Male</option>
                        <option>Female</option>
                    <?php }else{ ?>                        
                        <option>Male</option>
                        <option selected>Female</option>
                    <?php } ?>
                </select>
            </div>
            <div class="column col-md-6">
                <label>Last Name</label>
                <input type="text" class="form-control" required="required" name="lName" value="<?php echo $candidate['lName'];?>"/>
            </div>
            <div class="form-group col-md-6 date_error">
                <label>Mobile No. <span class="danger" id="mobNum_danger" >Enter propur number</span> </label>
                <input type="text" class="form-control" required="required" name="mobNum" id="mobNum" value="<?php echo $candidate['mobNum'];?>"/>
            </div>
            <div class="form-group col-md-6">
                <label>Date of Birth</label>
                <input type="text" class="form-control datepicker" required="required" name="dob" value="<?php echo $candidate['dob'];?>"/>
            </div>
            <div class="form-group col-md-6 date_error">
                <label>Job Type. <span class="danger" id="jobType_danger" >Enter Job Type.</span> </label>
                <select class="form-control select2" name="jobType" id="jobType" required>
                <?php $result = $conn->query("SELECT jobType, jobId from jobs order by creationDate desc");?>
                    <option value="">----- Select Job Type -----</option>
                    <?php while($jobs = mysqli_fetch_assoc($result)){ ?>
                    <?php if($candidate['jobId'] == $jobs['jobId']){?>
                            <option value="<?php echo $jobs['jobId'];?>" selected><?php echo $jobs['jobType'];?></option>
                        <? }else{ ?>
                            <option value="<?php echo $jobs['jobId'];?>"><?php echo $jobs['jobType'];?></option>
                    <?php } } ?>
                </select>
            </div>
        </div>
        <h4 class="bg-light">Passport Information</h4>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Passport No.</label>
                <input type="text" class="form-control" required="required" name="passportNum" value="<?php echo $candidate['passportNum'];?>"/>
            </div>            
            <div class="form-group col-md-6">
                <label>Country</label>
                <select class="form-control select2" name="country" id="country" required>
                <?php $result = $conn->query("SELECT country from delegate order by creationDate desc");?>
                    <?php while($country = mysqli_fetch_assoc($result)){ ?>
                        <?php if($country == $candidate['country']){?>
                            <option selected><?php echo $country['country'];?></option>
                        <?php }else{ ?>
                            <option><?php echo $country['country'];?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label>Issue Date</label>
                <input type="text" class="form-control datepicker" required="required" name="issuD" id="issuD" value="<?php echo $candidate['issueDate'];?>"/>
            </div>
            <div class="form-group col-md-6" style="text-align: center;">
                <label>Validity Year</label>
                <div class="form-group">
                <?php if($candidate['validity'] == 5){?>
                    <label class="parking_label">5 Years
                        <input type="radio" name="validityYear" id="validityYear" value="5" checked required>
                        <span class="checkmark"></span>
                    </label>
                    <label class="parking_label">10 Years
                        <input type="radio" name="validityYear" id="validityYear" value="10" required>
                        <span class="checkmark"></span>
                    </label>
                <?php }else{ ?>
                    <label class="parking_label">5 Years
                        <input type="radio" name="validityYear" id="validityYear" value="5" required>
                        <span class="checkmark"></span>
                    </label>
                    <label class="parking_label">10 Years
                        <input type="radio" name="validityYear" id="validityYear" value="10" checked required>
                        <span class="checkmark"></span>
                    </label>
                <?php } ?>
                </div>
            </div>
        </div>
        <label>New or Experienced</label>
        <div class="form-group">            
            <div class="parking_container">
                <div class="form-row">
                <?php if($candidate['departureDate'] == '0000-00-00' AND $candidate['arrivalDate'] == '0000-00-00'){?>
                    <div class="form-group col-md-2">
                        <label class="parking_label">New
                            <input type="radio" name="experience" value="no" checked required>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="form-group col-md-2">
                        <label class="parking_label">Experienced
                            <input type="radio" name="experience" value="yes" required>
                            <span class="checkmark"></span>
                        </label> 
                    </div> 
                <?php }else{ ?>
                    <div class="form-group col-md-2">
                        <label class="parking_label">New
                            <input type="radio" name="experience" value="no" required>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="form-group col-md-2">
                        <label class="parking_label">Experienced
                            <input type="radio" name="experience" value="yes" checked required>
                            <span class="checkmark"></span>
                        </label> 
                    </div> 
                <?php } ?>
                </div>
                <div class="form-row" id="experienced" style="display: <?php echo ($candidate['departureDate'] == '0000-00-00' AND $candidate['arrivalDate'] == '0000-00-00') ? 'none' : 'static';?>;background-color: rgba(0,0,0,0.04); padding: 5px; border-radius: 5px">
                    <div class="col-md-4">
                        <label>Departure Seal</label>
                        <input class="form-control-file" type="file" name="departureSealFile" id="traningCardFile">
                    </div>
                    <div class="col-md-4">
                        <label>Arrival Seal</label>
                        <input class="form-control-file" type="file" name="arrivalSealFile" id="traningCardFile">
                    </div>
                    <div class="col-md-6">
                        <label>Departure Date</label>
                        <input type="text" class="form-control experience_dates datepicker" name="departureDate" value="<?php echo $candidate['departureDate'];?>"/>
                    </div>
                    <div class="col-md-6">
                        <label>Arrival Date</label>
                        <input type="text" class="form-control experience_dates datepicker" name="arrivalDate" value="<?php echo $candidate['arrivalDate'];?>"/>
                    </div>                                    
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Agent or Office <span class="agentOrOfficeDanger" style="font-size: small; display: none; color:red">Enter Either Option</span> </label>
                    <div class="form-group">
                        <label class="parking_label">Agent
                            <input type="radio" name="agentOrOffice" value="agent" checked required>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
                <div class="form-group col-md-6" id="agentNotOffice">
                    <label>Agent <span class="danger" id="agent_validation">Enter Agent</span> </label>
                    <select class="form-control select2" name="agentEmail" id="agent">
                        <option value=""></option>
                        <?php $result = $conn->query("select agentEmail, agentName from agent"); 
                            while($agent = mysqli_fetch_assoc($result)){
                                if($candidate['agentEmail'] == $agent['agentEmail']){?>
                                <option value="<?php echo $agent['agentEmail'];?>" selected><?php echo $agent['agentName'];?></option>
                            <?php }else{ ?>
                                <option value="<?php echo $agent['agentEmail'];?>"><?php echo $agent['agentName'];?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-6" id="officeNotAgent" style="display: none;">
                    <label>Office <span class="danger" id="office_validation">Enter Office</span> </label>
                    <input class="form-control" type="text" name="office" id="office" placeholder="Office Name">
                </div> 
            </div>                       
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label> Manpower Office <span class="danger" id="manpower_danger"> Enter Manpower Office </span> </label>
                <select class="form-control select2" id="manpower" name="manpower">
                    <option value="notSet">----- Select Office ------</option>
                    <?php
                    $result = $conn->query("SELECT manpowerOfficeName from manpoweroffice");
                    while($manpower = mysqli_fetch_assoc($result)){
                    ?>
                        <?php if($candidate['manpowerOfficeName'] == $manpower['manpowerOfficeName']){ ?>
                            <option selected><?php echo $manpower['manpowerOfficeName']; ?></option>
                        <?php }else{ ?>
                            <option><?php echo $manpower['manpowerOfficeName']; ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label>Comment</label>
                <input type="text" class="form-control" name="comment" value="<?php echo $candidate['comment'];?>"/>
            </div>
        </div>
        <h4 class="bg-light">Documents</h4>
        <div class="form-row">            
            <div class="form-group col-md-6" id="passportScanFile">
                <div>
                    <label>Passport Scanned Copy</label>
                    <input class="form-control" type="file" name="passportScan">
                </div>
            </div> 
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Police Verification <span id="policeVerificationDanger" style="font-size: small; display: none; color:red">Select Verification</span> </label>
                    <?php if($candidate['policeClearance'] == 'yes'){ ?>
                    <div class="form-group">
                        <label class="parking_label">Provided
                            <input type="radio" name="policeVerification" value="yes" checked required>
                            <span class="checkmark"></span>
                        </label>
                        <label class="parking_label">Not Provided
                            <input type="radio" name="policeVerification" value="no" required>
                            <span class="checkmark"></span>
                        </label>
                    </div> 
                    <?php }else{ ?>  
                    <div class="form-group">
                        <label class="parking_label">Provided
                            <input type="radio" name="policeVerification" value="yes" required>
                            <span class="checkmark"></span>
                        </label>
                        <label class="parking_label">Not Provided
                            <input type="radio" name="policeVerification" value="no" checked required>
                            <span class="checkmark"></span>
                        </label>
                    </div>   
                    <?php } ?>              
                </div>
                <div class="form-group col-md-6" id="policeFile" style="display: <?php echo ($candidate['policeClearance'] == 'yes') ? 'static' : 'none';?>;">
                    <div>
                        <label>Police Verification File</label>
                        <input class="form-control" type="file" name="policeVerificationFile" id="policeVerificationFile">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="col-md-6">
                    <label>Passport Size Photo <span id="photoDanger" style="font-size: small; display: none; color:red">Select Photo</span> </label>
                    <div class="form-group">
                    <?php if($candidate['passportPhoto'] == 'yes'){ ?>
                        <label class="parking_label">Provided
                            <input type="radio" name="passportPhoto" value="yes" checked required>
                            <span class="checkmark"></span>
                        </label>
                        <label class="parking_label">Not Provided
                            <input type="radio" name="passportPhoto" value="no" required>
                            <span class="checkmark"></span>
                        </label>
                    <?php }else{ ?>
                        <label class="parking_label">Provided
                            <input type="radio" name="passportPhoto" value="yes" required>
                            <span class="checkmark"></span>
                        </label>
                        <label class="parking_label">Not Provided
                            <input type="radio" name="passportPhoto" value="no" checked required>
                            <span class="checkmark"></span>
                        </label>
                    <?php } ?>
                    </div>                 
                </div>
                <div id="photoFile" class="form-group col-md-6" style="display: <?php echo ($candidate['passportPhoto'] == 'yes') ? 'static' : 'none';?>;">
                    <div>
                        <label>Give Photo</label>
                        <input class="form-control" type="file" name="photoFile" id="photoFile_input">
                    </div>
                </div>
            </div>
        </div>          
        <div class="form-group">
            <input class="form-control bg-primary" type="submit" style="margin: auto; width: auto; color: white" value="Update" id="submit">
        </div>
    </form>
</div>
<script>
// radio toggle
$('body').on('click', "input[type='radio']", function(){
    const experience = $("input[name='experience']:checked").val();
    const policeVerification = $("input[name='policeVerification']:checked").val();
    const passportPhoto = $("input[name='passportPhoto']:checked").val();
    const agentOrOffice = $("input[name='agentOrOffice']:checked").val();

    if(experience === 'yes'){
        $('#experienced').show();
    }else if(experience === 'no'){
        $('#experienced').hide();
    }

    if(policeVerification === 'yes'){
        $('#policeFile').show();
    }else if(policeVerification === 'no'){
        $('#policeFile').hide();
    }

    if(passportPhoto === 'yes'){
        $('#photoFile').show();
    }else if(passportPhoto === 'no'){
        $('#photoFile').hide();
    }

    if(agentOrOffice === 'office'){
        $('#agentNotOffice').hide();
        $('#officeNotAgent').show();
    }else if(agentOrOffice === 'agent'){
        $('#agentNotOffice').show();
        $('#officeNotAgent').hide();
    }
});
</script>
