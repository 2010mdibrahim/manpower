<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.js" integrity="sha256-DrT5NfxfbHvMHux31Lkhxg42LY6of8TaYyK50jnxRnM=" crossorigin="anonymous"></script> -->

<?php
$result = $conn->query("select agentEmail, agentName from agent");
$curYear = date("Y");
$minYear = $curYear - 38;
$maxYear = $curYear - 25;
$curDay = date('m-d');
?>

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
                <label>Gender <span id="genderDanger" style="font-size: small; display: none; color:red">Select Gender</span> </label>
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
            <div class="form-group col-md-6">
                <label>Mobile No.</label>
                <input type="text" class="form-control" required="required" name="mobNum" placeholder="Enter Mobile Number"/>
            </div>
            <div class="form-group col-md-6">
                <label>Date of Birth</label>
                <input type="date" class="form-control" required="required" name="dob" min="<?php echo $minYear.'-'.$curDay;?>" max="<?php echo $maxYear.'-'.$curDay;?>"/>
            </div>
        </div>
        <h4 class="bg-light">Passport Information</h4>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Passport No.</label>
                <input type="text" class="form-control" required="required" name="passportNum" placeholder="Enter Passport Number"/>
            </div>
            <div class="form-group col-md-6">
                <label>Issue Date</label>
                <input type="date" class="form-control" required="required" name="issuD" id="issuD"/>
            </div>
            <div class="form-group col-md-6">
                <label>Country</label>
                <input type="text" class="form-control" required="required" name="country" placeholder="Enter Country"/>
            </div>
            <div class="form-group col-md-6">
                <label>Expiry Date</label>
                <input type="date" class="form-control" required="required" name="expD" id="expDate"/>
            </div>
            <div class="form-group col-md-6">
                <label>Departure Date</label>
                <input type="date" class="form-control" name="departureDate"/>
            </div>
            <div class="form-group col-md-6">
                <label>Arrival Date</label>
                <input type="date" class="form-control" name="arrivalDate"/>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Agent <span class="agentDanger" style="font-size: small; display: none; color:red">Enter Either Option</span> </label>
                <select class="form-control select2" name="agentEmail" id="agent">
                    <option value="notSet">------ Select Option ------</option>
                    <?php while($agent = mysqli_fetch_assoc($result)){?>
                        <option value="<?php echo $agent['agentEmail'];?>"><?php echo $agent['agentName'];?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label>Comment</label>
                <input type="text" class="form-control" name="comment" placeholder="Anything to add..."/>
            </div>
            <div class="form-group col-md-6">
                <label>Office <span class="agentDanger" style="font-size: small; display: none; color:red">Enter Either Option</span> </label>
                <input class="form-control" type="text" name="office" id="office" placeholder="Office Name">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Police Verification <span id="policeVerificationDanger" style="font-size: small; display: none; color:red">Select Verification</span> </label>
                <select class="form-control" name="policeVerification" id="policeVerification">
                    <option value="notSet">------ Select Option ------</option>
                    <option value="yes">Provided</option>
                    <option value="no">Did not provide</option>
                </select>
            </div>
            <div class="form-group col-md-6" id="policeFile" style="display: none;">
                <div>
                    <label>Police Verification File</label>
                    <input class="form-control" type="file" name="policeVerification">
                </div>
            </div> 
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Passport Size Photo <span id="photoDanger" style="font-size: small; display: none; color:red">Select Photo</span> </label>
                <select class="form-control" name="photo" required="required" id="photo">
                    <option value="notSet">------ Select Option ------</option>
                    <option value="yes">Submitted</option>
                    <option value="no">Did not submit</option>
                </select>
            </div>
                    
            <div id="photoFile" class="form-group col-md-6" style="display: none;">
                <div>
                    <label>Give Photo</label>
                    <input class="form-control" type="file" name="photoFile">
                </div>
            </div>
        </div>           
        <div class="form-group">
            <input class="form-control bg-primary" type="submit" style="margin: auto; width: auto; color: white" value="Submit" id="submit">
        </div>
    </form>
</div>


<script>

    $('body').on('submit', '#candidateForm', function(){
        let photo = $('#photo').val();
        let gender = $('#gender').val()
        let policeVerification = $('#policeVerification').val()
        let agent = $('#agent').val()
        let office = $('#office').val()

        if(photo == 'notSet'){
            $('#photoDanger').show();
            return false;
        }else if(gender == 'notSet'){
            $('#genderDanger').show();
            return false;
        }else if(policeVerification == 'notSet'){
            $('#policeVerificationDanger').show();
            return false;
        }else if(agent == 'notSet' && office == ''){
            $('.agentDanger').show();
            return false;
        }
    });

    $('body').on('change', '#issuD', function(){
        let issuD = $('#issuD').val().split('-');
        issuD[0] = parseInt(issuD[0])+1;
        let newD = issuD[0] + '-' + issuD[1] + '-' + issuD[2];
        $('#expDate').attr('min', newD);
    });


    function expDateVal(val){
        $('#expDate').attr('min', val);
    };


    $('body').on('change', '#photo', function(){
        let photo = $('#photo').val();
        if(photo == 'yes'){
            $('#photoFile').show();
        }else{
            $('#photoFile').hide();
        }
    });


    $('body').on('change', '#policeVerification', function(){
        let policeVerification = $('#policeVerification').val();
        if(policeVerification == 'yes'){
            $('#policeFile').show();
        }else{
            $('#policeFile').hide();
        }
    });


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
