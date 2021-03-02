<?php
$sponsorVisa = $_POST['sponsorVisa'];
$sponsorVisaData = mysqli_fetch_assoc($conn->query("SELECT * from sponsorvisalist where sponsorVisa = '$sponsorVisa'"));
$result = $conn->query("SELECT sponsorNID, sponsorName from sponsor");
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Add Sponsor's VISA</h2>
    </div>
    
    <form action="template/visaSponsorQry.php" method="post">
        <input type="hidden" name="alter" value="update">
        <div class="form-group">
            <div class="row">
                <div class="form-group col-md-6" >
                    <label>Select Sponsor Name</label>
                    <select class="form-control select2" name="sponsorNid">
                        <option>--- Select Sponsor ---</option>
                        <?php while($sponsorName = mysqli_fetch_assoc($result)){ ?>
                        <?php if($sponsorName['sponsorNID'] == $sponsorVisaData['sponsorNID']){ ?>
                            <option value="<?php echo $sponsorName['sponsorNID'];?>" selected><?php echo $sponsorName['sponsorName']." - ".$sponsorName['sponsorNID'];?></option>
                        <?php }else{ ?>
                            <option value="<?php echo $sponsorName['sponsorNID'];?>"><?php echo $sponsorName['sponsorName']." - ".$sponsorName['sponsorNID'];?></option>
                        <?php } 
                        } ?>
                    </select>
                </div>
            </div>
        </div>
        <h3 style="background-color: aliceblue; padding: 0.5%">Sponsor Information</h3>
        <div class="form-group">
            <div class="row">
                <div class="form-group col-md-6" >
                    <label>VISA No.</label>
                    <input class="form-control" type="text" name="visaNo" value="<?php echo $sponsorVisaData['sponsorVisa'];?>">
                </div>
                <div class="form-group col-md-6" >
                    <label>Issue Date</label>
                    <input class="form-control hijri-date-input" autocomplete="off" type="text" name="issueDate" value="<?php echo $sponsorVisaData['issueDate'];?>">
                </div>
                <div class="form-group col-md-6" >
                    <label>VISA Amount</label>
                    <input class="form-control" type="number" name="visaAmount" value="<?php echo $sponsorVisaData['visaAmount'];?>">
                </div>
                <div class="form-group col-md-6" >
                    <label>Job Type. <span class="danger" id="jobType_danger" >Enter Job Type.</span> </label>
                    <select class="form-control select2" name="jobType" id="jobType">
                    <?php $result = $conn->query("SELECT jobType, jobId from jobs order by creationDate desc");?>
                        <option value="notSet">----- Select Job Type -----</option>
                        <?php while($jobs = mysqli_fetch_assoc($result)){ ?>
                        <?php if($jobs['jobId'] == $sponsorVisaData['jobId']){?>
                            <option value="<?php echo $jobs['jobId'];?>" selected><?php echo $jobs['jobType'];?></option>
                        <?php }else{ ?>
                            <option value="<?php echo $jobs['jobId'];?>"><?php echo $jobs['jobType'];?></option>
                        <?php } } ?>
                    </select>
                </div>
                <div class="form-group col-md-6" >                    
                    <label>Visa Gender Type</label>
                    <select class="form-control" name="gender">
                        <option>----- Select Gender -----</option>
                        <?php if($sponsorVisaData['visaGenderType'] == 'male'){?>
                            <option value="male" selected>Male</option>
                            <option value="female">Female</option>
                        <?php }else{ ?>
                            <option value="male">Male</option>
                            <option value="female" selected>Female</option>
                        <?php }?>
                        
                    </select>
                </div>
                <div class="form-group col-md-6" >
                    <label>Comment</label>
                    <input class="form-control" type="text" name="comment" value="<?php echo $sponsorVisaData['comment'];?>">
                </div>
            </div>
        </div>
        <div class="form-group" >        
            <input style="width: auto; margin: auto" class="form-control" type="submit" value="Update" name="sponsor">
        </div>
    </form>
</div>

<script>
    $(function () {
        initHijrDatePicker();

    });

    function initHijrDatePicker() {
        $(".hijri-date-input").hijriDatePicker({
            locale: "en-us",
            hijri: true
        });
    }

    function initHijrDatePickerDefault() {
        $(".hijri-date-input").hijriDatePicker();
    }
    window.onload = function() {
        $('#sponsorNav').addClass('active');
    };
</script>