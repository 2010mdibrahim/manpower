<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.js" integrity="sha256-DrT5NfxfbHvMHux31Lkhxg42LY6of8TaYyK50jnxRnM=" crossorigin="anonymous"></script> -->

<style>
    span.danger{
        display: none;
        color: red;
        font-size: small;
    }    
</style>


<div class="container">
    <div class="section-header">
        <h2>New Candidate Information</h2>
    </div>
    <form action="template/newCandidateInsert.php" method="post" enctype="multipart/form-data" id="candidateForm">
        <h4 class="bg-light">Candidate Information</h4>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>First Name</label>
                <input type="text" class="form-control" required="required" name="fName" placeholder="Enter First Name"/>
            </div>
            <div class="form-group col-md-6">
                <label>Gender <span class="danger" id="genderDanger">Select Gender</span> </label>
                <select class="form-control" name="gender" id="gender" required>
                    <option value="">----- Select Gender -----</option>
                    <option>Male</option>
                    <option>Female</option>
                </select>
            </div>
            <div class="column col-md-6">
                <label>Last Name</label>
                <input type="text" class="form-control" required="required" name="lName" placeholder="Enter Last Name"/>
            </div>
            <div class="form-group col-md-6 date_error">
                <label>Mobile No. <span class="danger" id="mobNum_danger" >Enter propur number</span> </label>
                <input type="text" class="form-control" required="required" name="mobNum" id="mobNum" placeholder="Enter Mobile Number"/>
            </div>
            <div class="form-group col-md-6">
                <label>Date of Birth</label>
                <input type="text" class="form-control datepicker" required="required" name="dob" autocomplete="off" placeholder="yyyy/mm/dd"/>
            </div>
            <div class="form-group col-md-6 date_error">
                <label>Job Type. <span class="danger" id="jobType_danger" >Enter Job Type.</span> </label>
                <select class="form-control select2" name="jobType" id="jobType" required>
                <?php $result = $conn->query("SELECT jobType, jobId, creditType from jobs order by creationDate desc");?>
                    <option value="">----- Select Job Type -----</option>
                    <?php while($jobs = mysqli_fetch_assoc($result)){ ?>
                        <option value="<?php echo $jobs['jobId'];?>"><?php echo $jobs['jobType']." - ".$jobs['creditType'];?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <h4 class="bg-light">Passport Information</h4>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Passport No. <span id="pass_danger" style="color: red;display:none">Passport Already Exists</span></label>
                <input type="text" class="form-control" required="required" name="passportNum" id="passportNum" placeholder="Enter Passport Number"/>
            </div>            
            <div class="form-group col-md-6">
                <label>Country</label>
                <select class="form-control select2" name="country" id="country" required>
                <?php $result = $conn->query("SELECT country from delegate order by creationDate desc");?>
					<option value=""> --- Select Country --- </option>
                    <?php while($country = mysqli_fetch_assoc($result)){ ?>
                        <option><?php echo $country['country'];?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label>Issue Date</label>
                <input type="text" class="form-control datepicker" autocomplete="off" required="required" name="issuD" id="issuD" placeholder="yyyy/mm/dd"/>
            </div>
            <div class="form-group col-md-6" style="text-align: center;">
                <label>Validity Year</label>
                <div class="form-group">
                    <label class="parking_label">5 Years
                        <input type="radio" name="validityYear" id="validityYear" value="5" required>
                        <span class="checkmark"></span>
                    </label>
                    <label class="parking_label">10 Years
                        <input type="radio" name="validityYear" id="validityYear" value="10" required>
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
        </div>
        <label>New or Experienced</label>
        <div class="form-group">            
            <div class="parking_container">
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label class="parking_label">New
                            <input type="radio" name="experience" value="no" required>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="form-group col-md-2">
                        <label class="parking_label">Experienced
                            <input type="radio" name="experience" value="yes" required>
                            <span class="checkmark"></span>
                        </label> 
                    </div> 
                </div>
                <div class="form-row" id="experienced" style="display: none; background-color: rgba(0,0,0,0.04); padding: 5px; border-radius: 5px">
                    <div class="col-md-6">
                        <label>Departure Seal</label>
                        <input class="form-control-file" type="file" name="departureSealFile" id="departureSealFile">
                    </div>
                    <div class="col-md-6">
                        <label>Arrival Seal</label>
                        <input class="form-control-file" type="file" name="arrivalSealFile" id="arrivalSealFile">
                    </div>
                    <div class="col-md-6">
                        <label>Departure Date</label>
                        <input type="text" autocomplete="off" class="form-control experience_dates datepicker" name="departureDate" placeholder="yyyy/mm/dd"/>
                    </div>
                    <div class="col-md-6">
                        <label>Arrival Date</label>
                        <input type="text" autocomplete="off" class="form-control experience_dates datepicker" name="arrivalDate" placeholder="yyyy/mm/dd"/>
                    </div>               
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label> Manpower Office <span class="danger" id="manpower_danger"> Enter Manpower Office </span> </label>
                    <select class="form-control select2" id="manpower" name="manpower" required>
                        <option value="">----- Select Office ------</option>
                        <?php
                        $result = $conn->query("SELECT manpowerOfficeName from manpoweroffice");
                        while($manpower = mysqli_fetch_assoc($result)){
                        ?>
                            <option><?php echo $manpower['manpowerOfficeName']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6" id="agentNotOffice">
                    <label>Agent <span class="danger" id="agent_validation">Enter Agent</span> </label>
                    <select class="form-control select2" name="agentEmail" id="agent" required>
                        <option value="">------ Select Option ------</option>
                        <?php 
                        $result = $conn->query("select agentEmail, agentName from agent");
                        while($agent = mysqli_fetch_assoc($result)){
                        ?>
                            <option value="<?php echo $agent['agentEmail'];?>"><?php echo $agent['agentName'];?></option>
                        <?php } ?>
                    </select>
                </div>                 
            </div>                       
        </div>
        <div class="form-row"> 
            <div class="form-group col-md-6">
                <label>VISA Fee</label>
                <input class="form-control" type="number" name="comission" placeholder="Enter Amount" required>
            </div>
            
            <div class="col-md-6 text-center">
                <label for="">Advance</label>
                <div class="form-group">
                    <label class="parking_label">Yes
                        <input type="radio" name="advance" id="advance_yes" value="yes" required>
                        <span class="checkmark"></span>
                    </label>
                    <label class="parking_label">No
                        <input type="radio" name="advance" id="advance_no" value="no" checked required>
                        <span class="checkmark"></span>
                    </label>
                </div>                
            </div>
            
        </div>
        <div class="form-row" id="advance_take" style="display: none;">
            <div class="form-group col-md-6">                    
                <label>Advance</label>
                <input class="form-control" type="number" name="advance_amount" id="advance_amount" placeholder="Enter Amount">
            </div>       
            <div class="form-group col-md-6">                    
                <label>Pay Date</label>
                <input class="form-control datepicker" type="text" autocomplete="off" name="payDate" id="payDate" placeholder="Enter Payment Date">
            </div> 
            <div class="form-group col-md-6">                    
                <label>Payment Mode</label>
                <select class="form-control" name="payMode" id="payMode">
                    <option value="">Select Payment Mode</option>
                    <?php
                    $result = $conn->query("SELECT paymentMode from paymentmethod");
                    while($payMode = mysqli_fetch_assoc($result)){ ?>
                        <option><?php echo $payMode['paymentMode'];?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-row">            
            <div class="form-group col-md-6">
                <label>Comment</label>
                <input type="text" class="form-control" name="comment" placeholder="Anything to add..."/>
            </div>
        </div>
        <h4 class="bg-light">Documents</h4>
        <div class="form-row">            
            <div class="form-group col-md-6" id="passportScanFile">
                <div>
                    <label>Passport Scanned Copy</label>
                    <input class="form-control" type="file" name="passportScan" required>
                </div>
            </div> 
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Police Verification <span id="policeVerificationDanger" style="font-size: small; display: none; color:red">Select Verification</span> </label>
                    <div class="form-group">
                        <label class="parking_label">Provided
                            <input type="radio" name="policeVerification" value="yes" required>
                            <span class="checkmark"></span>
                        </label>
                        <label class="parking_label">Not Provided
                            <input type="radio" name="policeVerification" value="no" required>
                            <span class="checkmark"></span>
                        </label>
                    </div>                    
                </div>
                <div class="form-group col-md-6" id="policeFile" style="display: none;">
                    <div>
                        <label>Police Verification File</label>
                        <input class="form-control" type="file" name="policeVerification" id="policeVerification">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="col-md-6">
                    <label>Passport Size Photo <span id="photoDanger" style="font-size: small; display: none; color:red">Select Photo</span> </label>
                    <div class="form-group">
                        <label class="parking_label">Provided
                            <input type="radio" name="passportPhoto" value="yes" required>
                            <span class="checkmark"></span>
                        </label>
                        <label class="parking_label">Not Provided
                            <input type="radio" name="passportPhoto" value="no" required>
                            <span class="checkmark"></span>
                        </label>
                    </div>                 
                </div>
                <div id="photoFile" class="form-group col-md-6" style="display: none;">
                    <div>
                        <label>Give Photo</label>
                        <input class="form-control" type="file" name="photoFile" id="photoFile_input">
                    </div>
                </div>
            </div>
        </div>  
        <div class="form-group" style="display: none;" id="trainingCard_div">
            <div class="row">
                <div class="col-md-6">
                    <label>Training Card <span id="photoDanger" style="font-size: small; display: none; color:red">Select Photo</span> </label>
                    <div class="form-group">
                        <label class="parking_label">Provided
                            <input type="radio" name="trainingCard" value="yes" required>
                            <span class="checkmark"></span>
                        </label>
                        <label class="parking_label">Not Provided
                            <input type="radio" name="trainingCard" value="no" required>
                            <span class="checkmark"></span>
                        </label>
                    </div>                 
                </div>
                <div class="col-md-6" id="trainingCardDiv" style="display: none;">
                    <label>Give Traning Card</label>
                    <input class="form-control" type="file" name="traningCardFile" id="traningCardFile">
                </div>
            </div>
        </div>        
        <div class="form-group">
            <input class="form-control bg-primary" type="submit" style="margin: auto; width: auto; color: white" value="Submit" id="submit">
        </div>
    </form>
</div>


<script>

    $('body').on('change', '#passportNum', function(){
        const passportNum = $('#passportNum').val();
        $.ajax({
            url: 'template/checkPassport.php',
            type: 'post',
            data: {passportNum: passportNum},
            success: function(exist){
                if(exist === 'yes'){
                    $('#pass_danger').show();
                }else{
                    $('#pass_danger').hide();
                }
            }
        });
    });

    // radio toggle
    $('body').on('click', "input[type='radio']", function(){
        const experience = $("input[name='experience']:checked").val();
        const policeVerification = $("input[name='policeVerification']:checked").val();
        const passportPhoto = $("input[name='passportPhoto']:checked").val();
        const agentOrOffice = $("input[name='agentOrOffice']:checked").val();
        const advance = $("input[name='advance']:checked").val();
        const trainingCard = $("input[name='trainingCard']:checked").val();

        if(trainingCard == 'yes'){
            $('#trainingCardDiv').show();
            $('#traningCardFile').prop('required',true);
        }else{
            $('#trainingCardDiv').hide();
            $('#traningCardFile').prop('required',false);
        }
        
        if(advance === 'yes'){
            $('#advance_amount').prop('required',true);
            $('#payDate').prop('required',true);
            $('#payMode').prop('required',true);
            $('#advance_take').show();
        }else if(advance === 'no'){
            $('#advance_take').hide();
            $('#advance_amount').prop('required',false);
            $('#payDate').prop('required',false);
            $('#payMode').prop('required',false);
        }

        if(experience === 'yes'){
            $('#experienced').show();
            $('#trainingCard_div').hide();
            $('#oldVisaFile').prop('required',true);
            $('#departureSealFile').prop('required',true);
            $('#arrivalSealFile').prop('required',true);
            $('#departureDate').prop('required',true);
            $('#arrivalDate').prop('required',true);
        }else if(experience === 'no'){
            $('#experienced').hide();
            $('#trainingCard_div').show();
            $('#oldVisaFile').prop('required',false);
            $('#departureSealFile').prop('required',false);
            $('#arrivalSealFile').prop('required',false);
            $('#departureDate').prop('required',false);
            $('#arrivalDate').prop('required',false);
        }

        if(policeVerification === 'yes'){
            $('#policeVerification').prop('required',true);
            $('#policeFile').show();
        }else if(policeVerification === 'no'){
            $('#policeVerification').prop('required',false);
            $('#policeFile').hide();
        }

        if(passportPhoto === 'yes'){
            $('#photoFile_input').prop('required',true);
            $('#photoFile').show();
        }else if(passportPhoto === 'no'){
            $('#photoFile_input').prop('required',false);
            $('#photoFile').hide();
        }
    });
    
    // form validation
    $('body').on('submit', '#candidateForm', function(){
        let mobNum = $('#mobNum').val();        

        if(mobNum.length != 11){
            $('#mobNum_danger').show();
            $('html, body').animate({
                scrollTop: ($('.date_error').offset().top - 300)
            }, 500);
            return false;
        }      
    });


    // set expiry date of passport to one year more then the issue date
    $('body').on('change', '#issuD', function(){
        let issuD = $('#issuD').val().split('-');
        issuD[0] = parseInt(issuD[0])+1;
        let newD = issuD[0] + '-' + issuD[1] + '-' + issuD[2];
        $('#expDate').attr('min', newD);
    });


    $('body').on('change', '#passportScan', function(){
        let passportScan = $('#passportScan').val();
        if(passportScan == 'yes'){
            $('#passportScanFile').show();
        }else{
            $('#passportScanFile').hide();
        }
    });

    // photo file ext verification
    $(document).ready(function(){
        $('#policeFile').click(function (){
            let image_name = $('#image').val();
            var extension = $('#image').val().split('.').pop().toLowerCase();
            if(jQuery.inArray(extension, ['gif','png','jpg','jpeg','pdf']) == -1)
            {
                alert('Invalid Image File');
                $('#image').val('');
                return false;
            }
        });
    });
    $('#candidateNav').addClass('active');
</script>
