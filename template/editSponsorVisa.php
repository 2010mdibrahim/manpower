<?php
$visaSponsor = explode("-",$_POST['sponsorVisa']);
$gender = $visaSponsor[0];
$jobType = $visaSponsor[1];
$sponsorName = $visaSponsor[2];
$amount = mysqli_fetch_assoc($conn->query("SELECT visaAmount, comment from sponsorvisalist where visaGenderType = '$gender' AND jobType = '$jobType' AND sponsorName = '$sponsorName'"));
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Add VISA to Sponsor</h2>
    </div>
    
    <form action="template/visaSponsorEditQry.php" method="post">
        <div class="form-group">
            <div class="row">
                <div class="form-group col-md-6" >
                    <label>Select Sponsor Name</label>
                    <select class="form-control" name="sponsorName" readonly>
                        <option><?php echo $sponsorName;?></option>
                    </select>
                </div>
            </div>
        </div>
        <h3 style="background-color: aliceblue; padding: 0.5%">Sponsor Information</h3>
        <div class="form-group">
            <div class="row">
                <div class="form-group col-md-6" >
                    <label>VISA Amount</label>
                    <input class="form-control" type="number" name="visaAmount" value="<?php echo $amount['visaAmount'];?>" readonly>
                </div>
                <div class="form-group col-md-6" >
                    <label>Add Amount</label>
                    <input class="form-control" type="number" name="addAmount" placeholder="0">
                </div>
                <div class="form-group col-md-6" >
                    <label>Job Type</label>
                    <input class="form-control" type="text" name="jobType" value="<?php echo $jobType;?>">
                </div>
                <div class="form-group col-md-6" >                    
                    <label>Visa Gender Type</label>
                    <select class="form-control" name="gender">
                    <?php if($gender == 'male'){ ?>
                        <option>Male</option>
                        <option>Female</option>
                    <?php } ?>                        
                        <option>Female</option>
                        <option>Male</option>
                    </select>
                </div>
                <div class="form-group col-md-6" >
                    <label>Comment</label>
                    <input class="form-control" type="text" name="comment" value="<?php echo $amount['comment'];?>">
                </div>
            </div>
        </div>
        <div class="form-group" >        
            <input style="width: auto; margin: auto" class="form-control" type="submit" value="Add" name="sponsorVisaEdit">
        </div>
    </form>
</div>

<script>
    window.onload = function() {
        $('#sponsorNav').addClass('active');
    };
</script>