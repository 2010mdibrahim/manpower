<?php
$result = $conn->query("SELECT sponsorName from sponsor");
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Add VISA to Sponsor</h2>
    </div>
    
    <form action="template/visaSponsorQry.php" method="post">
        <div class="form-group">
            <div class="row">
                <div class="form-group col-md-6" >
                    <label>Select Sponsor Name</label>
                    <select class="form-control" name="sponsorName">
                        <option>--- Select Sponsor ---</option>
                        <?php while($sponsorName = mysqli_fetch_assoc($result)){?>
                            <option><?php echo $sponsorName['sponsorName'];?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <h3 style="background-color: aliceblue; padding: 0.5%">Sponsor Information</h3>
        <div class="form-group">
            <div class="row">
                <div class="form-group col-md-6" >
                    <label>VISA Amount</label>
                    <input class="form-control" type="number" name="visaAmount" placeholder="Enter Amount">
                </div>
                <div class="form-group col-md-6" >
                    <label>Job Type</label>
                    <input class="form-control" type="text" name="jobType" placeholder="Enter Type">
                </div>
                <div class="form-group col-md-6" >                    
                    <label>Visa Gender Type</label>
                    <select class="form-control" name="gender">
                        <option>----- Select Gender -----</option>
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                </div>
                <div class="form-group col-md-6" >
                    <label>Comment</label>
                    <input class="form-control" type="text" name="comment" placeholder="Enter Remark">
                </div>
            </div>
        </div>
        <div class="form-group" >        
            <input style="width: auto; margin: auto" class="form-control" type="submit" value="Add" name="sponsor">
        </div>
    </form>
</div>

<script>
    window.onload = function() {
        $('#sponsorNav').addClass('active');
    };
</script>