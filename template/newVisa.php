<?php
// include ('includes/select2.php');
// include ('includes/ajax.php');
$result = $conn->query("SELECT passportNum, creationDate, fName, lName from passport where finalMedical = 'yes'");
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
                            <option value="<?php echo $passport['passportNum']."_".$passport['creationDate']; ?>"><?php echo $passport['fName']." ".$passport['lName']." - ".$passport['passportNum']; ?></option>
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

    window.onload = function() {
        $('#visaNav').addClass('active');
    };

</script>