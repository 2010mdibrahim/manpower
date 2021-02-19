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
    <form action="template/newCandidateInsert.php" method="post">
        <h4 class="bg-light">Candidate Information</h4>
        <div class="row">
            <div class="column col-md-6">
                <label>First Name</label>
                <input type="text" class="form-control" required="required" name="fName"/>
                <br>
                <label>Gender</label>
                <select class="form-control" name="gender">
                    <option>----- Select Gender -----</option>
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
                <input type="date" class="form-control" required="required" name="issuD" id="issuD" onchange="expDateVal(this.value)"/>
                <br>
            </div>
            <div class="column col-md-6">
                <label>Country</label>
                <input type="text" class="form-control" name="country"/>
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
                <label>Police Verification</label>
                <select class="form-control" name="policeVerification">
                    <option>------ Select Option ------</option>
                    <option value="yes">Provided</option>
                    <option value="no">Did not provide</option>
                </select>
                <br>
            </div>
            <div class="column col-md-6">
                <label>Passport Size Photo</label>
                <select class="form-control" name="photo">
                    <option>------ Select Option ------</option>
                    <option value="yes">Submitted</option>
                    <option value="no">Did not submit</option>
                </select>
                <br>
            </div>
            <div class="column col-md-6">
                <label>Agent</label>
                <select class="form-control" name="agentEmail">
                    <option>------ Select Option ------</option>
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
            <input class="form-control bg-primary" type="submit" style="margin: auto; width: 15%" value="Submit">
        </div>
    </form>
</div>


<script>
    function expDateVal(val){
        $('#expDate').attr('min', val);
    };
</script>
