<?php
if(isset($_POST['passportNum'])){
    $passportNum = $_POST['passportNum'];
}else{
    $passportNum = '';
}
$candidate = mysqli_fetch_assoc($conn -> query("select * from passport where passportNum = '".$passportNum."'"));
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
    <form action="template/editCandidateQry.php" method="post">
        <input type="hidden" name="alter" value="update">
        <h4 class="bg-light">Candidate Information</h4>
        <div class="row">
            <div class="column col-md-6">
                <label>First Name</label>
                <input type="text" class="form-control" required="required" name="fName" value="<?php echo $candidate['fName']?>"/>
                <br>
                <label>Gender</label>
                <select class="form-control" name="gender">
                    <?php if($candidate['gender'] === 'Male'){?>
                        <option selected>Male</option>
                        <option>Female</option>
                    <?php }else{ ?>
                        <option>Male</option>
                        <option selected>Female</option>
                    <?php } ?>
                </select>
                <br>
            </div>
            <div class="column col-md-6">
                <label>Last Name</label>
                <input type="text" class="form-control" required="required" name="lName" value="<?php echo $candidate['lName']?>"/>
                <br>
                <label>Mobile No.</label>
                <input type="text" class="form-control" required="required" name="mobNum" value="<?php echo $candidate['mobNum']?>"/>
            </div>
            <div class="column col-md-6">
                <label>Date of Birth</label>
                <input type="date" class="form-control" required="required" name="dob" value="<?php echo $candidate['dob']?>" min="<?php echo $minYear.'-'.$curDay;?>" max="<?php echo $maxYear.'-'.$curDay;?>"/>
            </div>
        </div>
        <br>
        <h4 class="bg-light">Passport Information</h4>
        <div class="row">
            <div class="column col-md-6">
                <label>Passport No.</label>
                <input type="text" class="form-control" required="required" name="passportNum" value="<?php echo $candidate['passportNum']?>" readonly/>
                <br>
                <label>Issue Date</label>
                <input type="date" class="form-control" required="required" name="issuD" value="<?php echo $candidate['issueDate']?>"/>
                <br>
            </div>
            <div class="column col-md-6">
                <label>Country</label>
                <input type="text" class="form-control" name="country" value="<?php echo $candidate['country']?>"/>
                <br>
                <label>Expiry Date</label>
                <input type="date" class="form-control" required="required" name="expD" value="<?php echo $candidate['expiryDate']?>"/>
                <br>
            </div>
            <div class="column col-md-6">
                <label>Departure Date</label>
                <input type="date" class="form-control" name="departureDate" value="<?php echo $candidate['departureDate']?>"/>
                <br>
            </div>
            <div class="column col-md-6">
                <label>Arrival Date</label>
                <input type="date" class="form-control" name="arrivalDate" value="<?php echo $candidate['arrivalDate']?>"/>
                <br>
            </div>
            <div class="column col-md-6">
                <label>Police Verification</label>
                <select class="form-control" name="policeVerification">
                    <?php if($candidate['policeClearance'] === 'yes'){?>
                        <option value="yes" selected>Provided</option>
                        <option value="no">Did not provide</option>
                    <?php }else{ ?>
                        <option value="yes">Provided</option>
                        <option value="no" selected>Did not provide</option>
                    <?php } ?>
                </select>
                <br>
            </div>
            <div class="column col-md-6">
                <label>Passport Size Photo</label>
                <select class="form-control" name="photo" id="policeVerification">
                    <?php if($candidate['passportPhoto'] === 'yes'){?>
                        <option value="yes" selected>Submitted</option>
                        <option value="no">Did not submit</option>
                    <?php }else{ ?>
                        <option value="yes">Submitted</option>
                        <option value="no" selected>Did not submit</option>
                    <?php } ?>
                </select>
                <br>
                <div id="policeFile" style="display: none;">
                    <label>Police Verification File</label>
                    <input class="form-control" type="file" name="policeVerification">
                </div>
            </div>
            <div class="column col-md-6">
                <label>Agent</label>
                <select class="form-control" name="agentEmail">
                    <?php while($agent = mysqli_fetch_assoc($result)){
                        if($agent['agentEmail'] === $candidate['agentEmail']){ ?>
                            <option value="<?php echo $agent['agentEmail'];?>" selected><?php echo $agent['agentName'];?></option>
                        <?php }else{?>
                            <option value="<?php echo $agent['agentEmail'];?>"><?php echo $agent['agentName'];?></option>
                    <?php }
                    } ?>
                </select>
                <br>
            </div>
            <div class="column col-md-6">
                <label>Comment</label>
                <input type="text" class="form-control" name="comment" value="<?php echo $candidate['comment'];?>"/>
                <br>
            </div>
        </div>
        <br>
        <div>
            <input class="form-control bg-primary" type="submit" style="margin: auto; width: 15%" value="Update">
        </div>
    </form>
</div>
<script>
$('body').on('change', '#policeVerification', function(){
    let policeVerification = $('#policeVerification').val();
    if(policeVerification == 'yes'){
        $('#policeFile').show();
    }else{
        $('#policeFile').hide();
    }
});
</script>
