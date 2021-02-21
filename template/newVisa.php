<?php
include ('includes/ajax.php');
$result = $conn->query("SELECT passportNum, fName, lName from passport");
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>New Visa Information</h2>
    </div>
    
    <form action="template/saveVisa.php" method="post">       
        <div class="form-group">            
            <div class="row">  
                <!-- PASSPORT INFORMATION -->
                <div class="column col-md-6" >
                    <h4 class="bg-light">Passport Information</h4>
                    <label> Passport </label>
                    <select class="form-control" id="passport" name="passportNum">
                        <option>Select Passport</option>
                        <?php
                        while($passport = mysqli_fetch_assoc($result)){
                        ?>
                            <option value="<?php echo $passport['passportNum']; ?>"><?php echo $passport['fName']." ".$passport['lName']; ?></option>
                        <?php } ?>
                    </select>                    
                </div>  
                <!-- SPONSOR INFORMATION -->        
                <div class="column col-md-6" >
                    <h4 class="bg-light">Sponsor Information</h4>
                    <label> Sponsor Name </label>
                    <select class="form-control" id="sponsorInfo" name="sponsorInfo">
                        <option>Select Passport First</option>
                    </select>
                    <br>                    
                </div>
            </div>
        </div>
        <!-- VISA Information -->
        <div class="form-group">
            <h4 class="bg-light">Visa Information</h4>
            <div class="row">
                <div class="column col-md-6" >
                    <label> VISA No </label>
                    <input type="text" class="form-control" required="required" name="visaNo" placeholder="ENTER VISA"/>
                    <br>
                    <label> Manpower Office </label>
                    <select class="form-control" id="manpower" name="manpower">
                        <option>Select Office</option>
                        <?php
                        $result = $conn->query("SELECT manpowerOfficeName from manpoweroffice");
                        while($manpower = mysqli_fetch_assoc($result)){
                        ?>
                            <option><?php echo $manpower['manpowerOfficeName']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="column col-md-6">
                    <label>Job Id</label>
                    <input type="text" class="form-control" required="required" name="jobId" id="jobId" placeholder="ENTER JOB ID"/>
                    <br>
                    <label>Comment</label>
                    <input type="text" class="form-control" name="comment" id="comment" placeholder="Comment"/>
                </div>
            </div>
        </div>   
        <br>
        <input style="margin: auto; width: 15%" class="form-control" type="submit" value="Add Visa">
</div>
</form>
</div>
<script>      

    //sponsor
    $(document).on('change', '#passport', function(){
        let passportNum = $('#passport').val();
        $.ajax({
            url: "template/fetchSponsorFromPassport.php",
            type: "post",
            data: {passportNum: passportNum},
            success: function(response){
                $('#sponsorInfo').html(response);
            }
        });
    });

</script>