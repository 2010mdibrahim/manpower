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
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>First Name</label>
                <input type="text" class="form-control" required="required" name="fName" value="<?php echo $candidate['fName']?>"/>
            </div>
            <div class="form-group col-md-6">
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
            </div>
            <div class="form-group col-md-6">
                <label>Last Name</label>
                <input type="text" class="form-control" required="required" name="lName" value="<?php echo $candidate['lName']?>"/>
            </div>
            <div class="form-group col-md-6">
                <label>Mobile No.</label>
                <input type="text" class="form-control" required="required" name="mobNum" value="<?php echo $candidate['mobNum']?>"/>
            </div>
            <div class="form-group col-md-6">
                <label>Date of Birth</label>
                <input type="date" class="form-control" required="required" name="dob" value="<?php echo $candidate['dob']?>" min="<?php echo $minYear.'-'.$curDay;?>" max="<?php echo $maxYear.'-'.$curDay;?>"/>
            </div>
        </div>
        <h4 class="bg-light">Passport Information</h4>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Passport No.</label>
                <input type="text" class="form-control" required="required" name="passportNum" value="<?php echo $candidate['passportNum']?>" readonly/>
            </div>
            <div class="form-group col-md-6">
                <label>Country</label>
                <input type="text" class="form-control" name="country" value="<?php echo $candidate['country']?>"/>
            </div>
            <div class="form-group col-md-6">
                <label>Issue Date</label>
                <input type="date" class="form-control" required="required" name="issuD" value="<?php echo $candidate['issueDate']?>"/>
            </div>            
            <div class="form-group col-md-6">
                <label>Expiry Date</label>
                <input type="date" class="form-control" required="required" name="expD" value="<?php echo $candidate['expiryDate']?>"/>
            </div>
            <div class="form-group col-md-6">
                <label>Departure Date</label>
                <input type="date" class="form-control" name="departureDate" value="<?php echo $candidate['departureDate']?>"/>
            </div>
            <div class="form-group col-md-6">
                <label>Arrival Date</label>
                <input type="date" class="form-control" name="arrivalDate" value="<?php echo $candidate['arrivalDate']?>"/>
            </div>
            <div class="form-group col-md-6">
                <label>Comment</label>
                <input type="text" class="form-control" name="comment" value="<?php echo $candidate['comment'];?>"/>
            </div>
            <div class="form-group col-md-6">
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
            </div>            
        </div>
        <div class="form-group">
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
