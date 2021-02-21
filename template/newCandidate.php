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
        <div class="row">
            <div class="column col-md-6">
                <label>First Name</label>
                <input type="text" class="form-control" required="required" name="fName"/>
                <br>
                <label>Gender <span id="genderDanger" style="font-size: small; display: none; color:red">Select Gender</span> </label>
                <select class="form-control" name="gender" id="gender">
                    <option value="notSet">----- Select Gender -----</option>
                    <option>Male</option>
                    <option>Female</option>
                </select>
                <br>
            </div>
            <div class="column col-md-6">
                <label>Last Name</label>
                <input type="text" class="form-control" required="required" name="lName"/>
                <br>
                <label>Mobile No.</label>
                <input type="text" class="form-control" required="required" name="mobNum"/>
            </div>
            <div class="column col-md-6">
                <label>Date of Birth</label>
                <input type="date" class="form-control" required="required" name="dob" min="<?php echo $minYear.'-'.$curDay;?>" max="<?php echo $maxYear.'-'.$curDay;?>"/>
            </div>
        </div>
        <br>
        <h4 class="bg-light">Passport Information</h4>
        <div class="row">
            <div class="column col-md-6">
                <label>Passport No.</label>
                <input type="text" class="form-control" required="required" name="passportNum"/>
                <br>
                <label>Issue Date</label>
                <input type="date" class="form-control" required="required" name="issuD" id="issuD"/>
                <br>
            </div>
            <div class="column col-md-6">
                <label>Country</label>
                <input type="text" class="form-control" required="required" name="country"/>
                <br>
                <label>Expiry Date</label>
                <input type="date" class="form-control" required="required" name="expD" id="expDate"/>
                <br>
            </div>
            <div class="column col-md-6">
                <label>Departure Date</label>
                <input type="date" class="form-control" name="departureDate"/>
                <br>
            </div>
            <div class="column col-md-6">
                <label>Arrival Date</label>
                <input type="date" class="form-control" name="arrivalDate"/>
                <br>
            </div>
            <div class="column col-md-6">
                <label>Police Verification <span id="policeVerificationDanger" style="font-size: small; display: none; color:red">Select Verification</span> </label>
                <select class="form-control" name="policeVerification" id="policeVerification">
                    <option value="notSet">------ Select Option ------</option>
                    <option value="yes">Provided</option>
                    <option value="no">Did not provide</option>
                </select>
                <br>
                <div id="policeFile" style="display: none;">
                    <label>Police Verification File</label>
                    <input class="form-control" type="file" name="policeVerification">
                </div>
            </div>
            <div class="column col-md-6">
                <label>Passport Size Photo <span id="photoDanger" style="font-size: small; display: none; color:red">Select Photo</span> </label>
                <select class="form-control" name="photo" required="required" id="photo">
                    <option value="notSet">------ Select Option ------</option>
                    <option value="yes">Submitted</option>
                    <option value="no">Did not submit</option>
                </select>
                <br>
                <div id="photoFile" style="display: none;">
                    <label>Give Photo</label>
                    <input class="form-control" type="file" name="photoFile">
                </div>
            </div>
            <div class="column col-md-6">
                <label>Agent <span id="agentDanger" style="font-size: small; display: none; color:red">Select Agent</span> </label>
                <select class="form-control" name="agentEmail" id="agent">
                    <option value="notSet">------ Select Option ------</option>
                    <?php while($agent = mysqli_fetch_assoc($result)){?>
                        <option value="<?php echo $agent['agentEmail'];?>"><?php echo $agent['agentName'];?></option>
                    <?php } ?>
                </select>
                <br>
            </div>
            <div class="column col-md-6">
                <label>Comment</label>
                <input type="text" class="form-control" name="comment"/>
                <br>
            </div>
        </div>
        <br>
        <div>
            <input class="form-control bg-primary" type="submit" style="margin: auto; width: 15%" value="Submit" id="submit">
        </div>
    </form>
</div>


<script>

    $('body').on('submit', '#candidateForm', function(){
        let photo = $('#photo').val();
        let gender = $('#gender').val()
        let policeVerification = $('#policeVerification').val()
        let agent = $('#agent').val()

        if(photo == 'notSet'){
            $('#photoDanger').show();
            return false;
        }else if(gender == 'notSet'){
            $('#genderDanger').show();
            return false;
        }else if(policeVerification == 'notSet'){
            $('#policeVerificationDanger').show();
            return false;
        }else if(agent == 'notSet'){
            $('#agentDanger').show();
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
</script>
