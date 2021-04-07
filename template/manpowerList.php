<?php
$result = $conn -> query("SELECT * from manpoweroffice order by manpowerOfficeName");
?>
<style>
    .flex-container {
        display: flex;
        flex-direction: row;
    }
    .dot {
        height: 25px;
        width: 30px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
    }
</style>
<div class="container-fluid" style="padding: 2%">
    <!-- Add manpower jobs -->
    <div class="modal fade" tabindex="-1" role="dialog" id="addJobs">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/addManpowerJobs.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Job</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="editJobsForm">
                    <div class="form-group">
                        <input type="hidden" name="manpowerOfficeId" id="manpowerOfficeIdModal">
                        <div id="addManpowerJobs">
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
                    <div class="form-group">
                        <button class="btn btn-sm" type="button" id="add_manpowerJobs" ><span class="fa fa-plus" aria-hidden="true"></span></button>
                        <button class="btn btn-sm btn-danger" type="button" id="remove_manpowerJobs"><span class="fas fa-minus" aria-hidden="true"></span></button>
                    </div>
                        
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
        <div class="card-header">
            <div class="section-header">
                <h2>Manpower Office List</h2>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTableSeaum" class="table table-bordered table-hover"  style="width:100%">
                    <thead>
                    <tr>
                        <th>Office Name</th>
                        <th>Office License</th>
                        <th>Office Address</th>
                        <th>Jobs</th> 
                        <th>Comment</th> 
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <?php
                    while( $manpower = mysqli_fetch_assoc($result) ){                
                    ?>
                        <tr>
                            <td>
                            <div class="row">
                            <div class="col-sm">
                            <?php echo $manpower['manpowerOfficeName'];?>
                            </div>
                            <div class="col-sm"><div class="dot">new</div></div>
                            </div>
                            </td>
                            <td><?php echo $manpower['licenseNumber'];?></td>
                            <td><?php echo $manpower['officeAddress'];?></td>
                            <td><a href="?page=manpowerJobList&mi=<?php echo base64_encode($manpower['manpowerOfficeId']);?>&mn=<?php echo base64_encode($manpower['manpowerOfficeName']);?>">Jobs</a></td>
                            <td><?php echo $manpower['comment'];?></td>                 
                            <td>
                                <div class="flex-container">
                                    
                                </div>
                                <div class="flex-container">
                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#addJobs" value="<?php echo $manpower['manpowerOfficeId']?>" onclick="modalData(this.value)">Add Office</span></button>
                                    <div style="padding-left: 2%">
                                        <form action="index.php" method="post">
                                            <input type="hidden" name="pagePost" value="editManpowerOffice">
                                            <input type="hidden" value="<?php echo $manpower['manpowerOfficeId']; ?>" name="manpowerOfficeId">
                                            <button type="submit" class="btn btn-info btn-sm" name="manpower">Edit</></button>
                                        </form>
                                    </div>
                                    <div style="padding-left: 2%">
                                        <form action="template/manpowerQry.php" method="post">
                                            <input type="hidden" name="alter" value="delete">
                                            <input type="hidden" value="<?php echo $manpower['manpowerOfficeName']; ?>" name="officeName">
                                            <button type="submit" class="btn btn-danger btn-sm" name="manpower">Delete</></button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    <tfoot>
                    <tr hidden>
                        <th>Office Name</th>
                        <th>Office License</th>
                        <th>Office Address</th>
                        <th>Jobs</th> 
                        <th>Comment</th> 
                        <th>Edit</th>
                    </tr>
                    </tfoot>

                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function modalData(manpowerOfficeId){
        $('#manpowerOfficeIdModal').val(manpowerOfficeId);
    }
    $('#add_manpowerJobs').click(function (){
        $.ajax({
            type: 'post',
            url: 'template/fetchManpowerJobs2.php',
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






