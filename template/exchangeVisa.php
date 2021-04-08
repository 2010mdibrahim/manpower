<?php
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("VISA", $_SESSION['sections'])){
            if (headers_sent()) {
                die("No Access");
            }else{
                header("Location: ../index.php");
                exit();
            } 
        }        
    }
}
$info = explode('-',$_POST['info']);
$fName = $info[0];
$lName = $info[1];
$processingId = $info[2];
$sponsorVisa = $info[3];
$visaAmount = $info[4];
$gender = $info[5];
$result = $conn -> query("SELECT jobs.jobType, sponsor.sponsorName, sponsorvisalist.sponsorVisa, sponsorvisalist.sponsorNID, sponsorvisalist.visaAmount from sponsorvisalist inner join jobs using(jobId) INNER JOIN sponsor USING (sponsorNID) WHERE visaGenderType = '".strtolower($gender)."' and visaAmount > 0 AND sponsorVisa != '$sponsorVisa' order by sponsorNID");
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>New Visa Information</h2>
    </div>
    
    <form action="template/exchangeVisaQry.php" method="post"> 
    <input type="hidden" name="processingId" value="<?php echo $processingId; ?>">
    <input type="hidden" name="selectedSponsorVisa" value="<?php echo $sponsorVisa; ?>">
    <input type="hidden" name="selectedSponsorVisaAmount" value="<?php echo $visaAmount; ?>">
        <div class="form-group">            
            <div class="form-row">  
                <!-- PASSPORT INFORMATION -->
                <div class="form-group col-md-6">
                    <label> Passport </label>
                    <select class="form-control" id="passport" name="passportNum" readonly>
                        <option><?php echo $fName." ".$lName;?></option>
                    </select>                    
                </div>  
                <!-- SPONSOR INFORMATION -->        
                <div class="form-group col-md-6" >
                    <label> Sponsor Name </label>
                    <select class="form-control select2" id="sponsorInfo" name="sponsorInfo" required>
                        <option value="">Select Sponsor</option>
                        <?php while($sponsor = mysqli_fetch_assoc($result)){?>
                        <?php $val = $sponsor['sponsorVisa']."-".$sponsor['visaAmount']; ?>
                            <option value='<?php echo $val ?>'><?php echo $sponsor['sponsorName']." - ".$sponsor['jobType'] ?></option>
                        <?php } ?>
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
        <div class="form-group">
            <input style="margin: auto; width: auto" class="form-control" type="submit" value="Exchange">
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