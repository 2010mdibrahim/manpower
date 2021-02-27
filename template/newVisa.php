<?php
// include ('includes/select2.php');
// include ('includes/ajax.php');
$result = $conn->query("SELECT passportNum, fName, lName from passport where finalMedical = 'yes'");
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>New Visa Information</h2>
    </div>
    
    <form action="template/saveVisa.php" method="post">       
        <div class="form-group">            
            <div class="form-row">  
                <!-- PASSPORT INFORMATION -->
                <div class="form-group col-md-6">
                    <label> Passport </label>
                    <select class="form-control select2" id="passport" name="passportNum">
                        <option>Select Passport</option>
                        <?php
                        while($passport = mysqli_fetch_assoc($result)){
                        ?>
                            <option value="<?php echo $passport['passportNum']; ?>"><?php echo $passport['fName']." ".$passport['lName']." - ".$passport['passportNum']; ?></option>
                        <?php } ?>
                    </select>                    
                </div>  
                <!-- SPONSOR INFORMATION -->        
                <div class="form-group col-md-6" >
                    <label> Sponsor Name </label>
                    <select class="form-control select2" id="sponsorInfo" name="sponsorInfo">
                        <option>Select Passport First</option>
                    </select>                  
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6" >
                    <label> Comment </label>
                    <input class="form-control" type="text" name="comment" placeholder="Any Comment...">                 
                </div>
            </div>
        </div>
        <!-- VISA Information -->
        <!-- <div class="form-group">
            <h4 class="bg-light">Visa Information</h4>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label> VISA No </label>
                    <input type="text" class="form-control" required="required" name="visaNo" placeholder="ENTER VISA"/>
                </div>
                <div class="form-group col-md-6">
                    <label> Manpower Office </label>
                    <select class="form-control select2" id="manpower" name="manpower">
                        <option>Select Office</option>
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
                <div class="form-group col-md-6">
                    <label>Job Id</label>
                    <input type="text" class="form-control" required="required" name="jobId" id="jobId" placeholder="ENTER JOB ID"/>
                </div>
                <div class="form-group col-md-6">
                    <label>Comment</label>
                    <input type="text" class="form-control" name="comment" id="comment" placeholder="Comment"/>
                </div>
            </div>                
        </div> -->
        <div class="form-group">
            <input style="margin: auto; width: auto" class="form-control" type="submit" value="Add Visa">
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

    window.onload = function() {
        $('#visaNav').addClass('active');
    };

</script>