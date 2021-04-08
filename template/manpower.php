<?php
if(!isset($_SESSION['sections'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!in_array("All", $_SESSION['sections'])){
        if(!in_array("Manpower", $_SESSION['sections'])){
            header("Location: ../index.php");
            exit();
        }        
    }
}
?>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Add Manpower Office</h2>
    </div>
    <h3 style="background-color: aliceblue; padding: 0.5%">Office Information</h3>
    <form action="template/manpowerQry.php" method="post">
        <div class="form-group">
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Office Name</label>
                    <input class="form-control" autocomplete="off" type="text" name="officeName" placeholder="Enter Name">
                </div>
                <div class="form-group col-md-6">
                    <label>License Number</label>
                    <input class="form-control" autocomplete="off" type="text" name="licenseNumber" placeholder="Enter License Number">
                </div>                
                <div class="form-group col-md-6">
                    <label>Office Address</label>
                    <input class="form-control" autocomplete="off" type="text" name="officeAddress" placeholder="Enter Office Address">
                </div>
                <div class="form-group col-md-6">
                    <label>Comment</label>
                    <input class="form-control" autocomplete="off" type="text" id="sponsorVisa" name="comment" placeholder="Any comment">
                </div>
            </div>
            <div class="form-group">
                <div class="row" id="addManpowerJobs">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-sm">                        
                                <label>Job</label>
                                <select class="form-control select2" name="jobId[]" id="" required>
                                <option value="">Select Job</option>
                                <?php
                                $result_job = $conn->query("SELECT * from jobs");
                                while($jobs = mysqli_fetch_assoc($result_job)){ ?>
                                    <option value="<?php echo $jobs['jobId'];?>"><?php echo $jobs['jobType'];?></option>
                                <?php } ?>
                                </select>
                            </div>
                            <div class="col-sm">
                                <label>Processing Cost</label>
                                <input class="form-control" autocomplete="off" type="number" name="processingCost[]" placeholder="Cost" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-sm" type="button" id="add_manpowerJobs" ><span class="fa fa-plus" aria-hidden="true"></span></button>
                <button class="btn btn-sm btn-danger" type="button" id="remove_manpowerJobs"><span class="fas fa-minus" aria-hidden="true"></span></button>
            </div>
        </div>      
        <input style="margin: auto; width: auto" class="form-control" type="submit" value="Add" name="manpower">
    </form>
</div>

<script>
    $('#add_manpowerJobs').click(function (){
        $.ajax({
            type: 'post',
            url: 'template/fetchManpowerJobs.php',
            success: function(response){
                $('#addManpowerJobs').append(response);
                $('.select2').select2({
                    width: '100%'
                });
            }
        });
    });
    $('#remove_manpowerJobs').click(function (){
        $('#addManpowerJobs').children().last().remove();
    })
    $('#manpowerNav').addClass('active');
</script>