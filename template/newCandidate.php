<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.js" integrity="sha256-DrT5NfxfbHvMHux31Lkhxg42LY6of8TaYyK50jnxRnM=" crossorigin="anonymous"></script> -->

<style>
    span.danger{
        display: none;
        color: red;
        font-size: small;
    }    
</style>


<div class="container">
<p>this is pull test</p>
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
                <select class="form-control" name="gender" id="gender">
                    <option value="notSet">----- Select Gender -----</option>
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
                <?php $result = $conn->query("SELECT jobType, jobId from jobs order by creationDate desc");?>
                    <option value="">----- Select Job Type -----</option>
                    <?php while($jobs = mysqli_fetch_assoc($result)){ ?>
                        <option value="<?php echo $jobs['jobId'];?>"><?php echo $jobs['jobType'];?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <h4 class="bg-light">Passport Information</h4>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Passport No.</label>
                <input type="text" class="form-control" required="required" name="passportNum" placeholder="Enter Passport Number"/>
            </div>            
            <div class="form-group col-md-6">
                <label>Country</label>
                <select class="form-control select2" name="country" id="country" required>
                <?php $result = $conn->query("SELECT country from delegate order by creationDate desc");?>
                    <option value="">Select Country</option>
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
                <div class="form-row" id="experienced" style="display: none;">
                    <div class="form-group col-md-6">
                        <label>Departure Date</label>
                        <input type="text" class="form-control experience_dates datepicker" name="departureDate" placeholder="yyyy/mm/dd"/>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Arrival Date</label>
                        <input type="date" class="form-control experience_dates datepicker" name="arrivalDate" placeholder="yyyy/mm/dd"/>
                    </div>               
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-row">
                <!-- <div class="form-group col-md-6">
                    <label>Agent or Office <span class="agentOrOfficeDanger" style="font-size: small; display: none; color:red">Enter Either Option</span> </label>
                    <div class="form-group">
                        <label class="parking_label">Agent
                            <input type="radio" name="agentOrOffice" value="agent" checked required>
                            <span class="checkmark"></span>
                        </label>
                        <label class="parking_label">Office
                            <input type="radio" name="agentOrOffice" value="office" required>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div> -->
                <div class="form-group col-md-6" id="agentNotOffice">
                    <label>Agent <span class="danger" id="agent_validation">Enter Agent</span> </label>
                    <select class="form-control select2" name="agentEmail" id="agent">
                        <option value="notSet">------ Select Option ------</option>
                        <?php 
                        $result = $conn->query("select agentEmail, agentName from agent");
                        while($agent = mysqli_fetch_assoc($result)){
                        ?>
                            <option value="<?php echo $agent['agentEmail'];?>"><?php echo $agent['agentName'];?></option>
                        <?php } ?>
                    </select>
                </div>
                <!-- <div class="form-group col-md-6" id="officeNotAgent" style="display: none;">
                    <label>Office <span class="danger" id="office_validation">Enter Office</span> </label>
                    <input class="form-control" type="text" name="office" id="office" placeholder="Office Name">
                </div> -->
                <div class="form-group col-md-6">
                <label> Manpower Office <span class="danger" id="manpower_danger"> Enter Manpower Office </span> </label>
                <select class="form-control select2" id="manpower" name="manpower">
                    <option value="notSet">----- Select Office ------</option>
                    <?php
                    $result = $conn->query("SELECT manpowerOfficeName from manpoweroffice");
                    while($manpower = mysqli_fetch_assoc($result)){
                    ?>
                        <option><?php echo $manpower['manpowerOfficeName']; ?></option>
                    <?php } ?>
                </select>
            </div> 
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
        <div class="form-group">
            <input class="form-control bg-primary" type="submit" style="margin: auto; width: auto; color: white" value="Submit" id="submit">
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
    
    // form validation
    $('body').on('submit', '#candidateForm', function(){       
        let gender = $('#gender').val();
        let agent = $('#agent').val();
        let office = $('#office').val();
        let mobNum = $('#mobNum').val();
        let jobType = $('#jobType').val();
        const agentOrOffice = $("input[name='agentOrOffice']:checked").val();
        const experience = $("input[name='experience']:checked").val();
        const policeVerification = $("input[name='policeVerification']:checked").val();
        const photo = $("input[name='passportPhoto']:checked").val();
        const manpower = $('#manpower').val();
        
        if(jobType == 'notSet'){
            $('#jobType_danger').show();
            $('html, body').animate({
                scrollTop: ($('.date_error').offset().top - 300)
            }, 500);
            return false;
        }

        if(experience === 'yes'){
            $('.experience_dates').prop('required', true);
        }

        if(policeVerification === 'yes'){
            $('#policeVerification').prop('required', true);
        }

        if(photo === 'yes'){
            $('#photoFile_input').prop('required', true);
        }
        

        if(mobNum.length != 11){
            $('#mobNum_danger').show();
            $('html, body').animate({
                scrollTop: ($('.date_error').offset().top - 300)
            }, 500);
            return false;
        }
        if(gender == 'notSet'){
            $('#genderDanger').show();
            $('html, body').animate({
                scrollTop: ($('.date_error').offset().top - 300)
            }, 500);
            return false;
        }
        if(agentOrOffice == 'agent'){
            if(agent == 'notSet'){
                $('#agent_validation').show();
                $('html, body').animate({
                    scrollTop: ($('.date_error').offset().top)
                }, 500);
                return false;
            }
        }
        if(agentOrOffice == 'office'){
            if(office == ''){
                $('#office_validation').show();
                $('html, body').animate({
                    scrollTop: ($('.date_error').offset().top)
                }, 500);
                return false;
            }
        }  
        if(manpower == 'notSet'){
            $('#manpower_danger').show();
            $('html, body').animate({
                scrollTop: ($('.date_error').offset().top)
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


    window.onload = function() {
        $('#candidateNav').addClass('active');
    };
</script>
