<?php
$manpowerId = base64_decode($_GET['mi']);
$result = $conn->query("SELECT jobs.jobType, manpowerjobprocessing.* from manpowerjobprocessing INNER JOIN jobs using (jobId) where manpowerOfficeId = $manpowerId");
?>
<div class="container">
    <!-- Edit manpower jobs -->
    <div class="modal fade" tabindex="-1" role="dialog" id="editJobs">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/editManpowerJobs.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Job</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="editJobsForm">
                        
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>    
    <div class="card">
        <div class="card-header text-center"> Manpower Jobs List </div>
        <?php 
        $i = 1;
        while($jobList = mysqli_fetch_assoc($result)){ ?>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <p>Job #<?php echo $i++; ?></p>
                    </div>
                    <div class="col-sm-3">
                        <h5><?php echo $jobList['jobType'];?></h5>
                    </div>
                    <div class="col-sm-3">
                        <h5><?php echo $jobList['processingCost'];?></h5>
                    </div>
                    <div class="col-sm-3">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#editJobs" value="<?php echo $jobList['manpowerJobProcessingId']."_".$jobList['jobId']."_".$jobList['processingCost']."_".$jobList['manpowerOfficeId'];?>" onclick="editJob(this.value)"><span class="fa fa-edit"></span></button>
                        <button class="btn btn-danger"><span class="fa fa-close"></span></button>
                    </div>
                </div>        
            </div>
            <hr>
        <?php } ?>
    </div>
</div>
<script>
function editJob(info){
    $.ajax({
        type: 'post',
        url: 'template/fetchMapowerJobList.php',
        data: {info: info},
        success: function(response){
            $('#editJobsForm').html(response);
        }
    });
}
$('#manpowerNav').addClass('active');
</script>