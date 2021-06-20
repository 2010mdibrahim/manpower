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
?>
<?php
$result = $conn->query("SELECT passport.passportNum, passport.creationDate, passport.fName, passport.lName, processing.processingId from passport LEFT JOIN processing on passport.passportNum = processing.passportNum AND passport.creationDate = processing.passportCreationDate where passport.finalMedicalStatus = 'fit' AND passport.testMedicalStatus = 'fit' AND passport.finalMedical = 'yes' AND processing.processingId is null");
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
                    <select class="form-control select2" id="passport" name="passport_info">
                        <option>Select Passport</option>
                        <?php
                        while($passport = mysqli_fetch_assoc($result)){
                        ?>
                            <option value="<?php echo $passport['passportNum']."_".$passport['creationDate']."_".$passport['fName']." ".$passport['lName']; ?>"><?php echo $passport['fName']." ".$passport['lName']." - ".$passport['passportNum']; ?></option>
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
    $('#visaNav').addClass('active');

</script>