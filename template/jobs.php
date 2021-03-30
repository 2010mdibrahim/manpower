<style>
.container{
    margin-bottom: 2%;
}

#custom_alert_seaum {
    width: 100%;
    height: 100%;
    border-radius: 12px;
    font-size: 21px;
    text-align: center;

    -webkit-animation: fadein 1s; /* Safari, Chrome and Opera > 12.1 */
       -moz-animation: fadein 1s; /* Firefox < 16 */
        -ms-animation: fadein 1s; /* Internet Explorer */
         -o-animation: fadein 1s; /* Opera < 12.1 */
            animation: fadein 1s;
}

@keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* Firefox < 16 */
@-moz-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* Safari, Chrome and Opera > 12.1 */
@-webkit-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* Internet Explorer */
@-ms-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}
</style>
<div class="container" style="padding: 2%">
    <!-- Passport Photo Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="editJob">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="template/jobsEditQry.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Give Job Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row" id="modalTest">
                            <input type="hidden" name="jobId" id="modalJobId">       
                            <div class="form-group col-sm">
                                <label style="margin-right: 5px;">Job Type: </label>
                                <input class="form-control" type="text" name="jobType" id="modalJobType">       
                            </div>
                            <div class="form-group col-sm">
                                <label style="margin-right: 5px;">Job Credit Type: </label>
                                <select class="form-control" name="creditType" id="modalCreditType">
                                    <option value="">Select Credit Type</option>
                                    <option>Debit</option>
                                    <option>Credit</option>
                                </select>
                            </div>
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

    <div class="section-header">
        <h2>Jobs</h2>
    </div>    
    <div class="container">
        <form action="template/addNewJobQry.php" method="post">
            <div class="form-row align-items-end">
                <div class="form-group col-md-4" >
                    <label>Add Jobs</label>
                    <input class="form-control" type="text" name="jobType" placeholder="Enter Name">
                </div>
                <div class="form-group col-md-4">
                    <label style="margin-right: 5px;">Job Credit Type: </label>
                    <select class="form-control" name="creditType">
                        <option value="">Select Credit Type</option>
                        <option>Debit</option>
                        <option>Credit</option>
                    </select>
                </div>
                <div class="form-group" >
                    <input class="form-control" type="submit" value="Add" name="jobs" onclick="custom_alert()">
                </div>
            </div>    
        </form>
    </div>
    <?php $result = $conn->query("SELECT * from jobs order by creationDate desc"); ?>
    <div class="container">
        <div class="table-responsive">
            <table id="dataTableSeaum" class="table table-bordered table-hover"  style="width:100%">
                <thead>
                <tr>
                    <th>Job Name</th>
                    <th>Job Credit Type</th>
                    <th>Creation Date</th> 
                    <th>Edit</th>
                </tr>
                </thead>
                <?php while($jobs = mysqli_fetch_assoc($result)){?>
                <tr>
                    <td><?php echo $jobs['jobType'];?></td>
                    <td><?php echo $jobs['creditType'];?></td>
                    <td><?php echo $jobs['creationDate'];?></td>
                    <!-- Edit Section -->
                    <td>
                        <div class="row">
                            <div class="col-md-2">                                        
                                <button type="submit" data-toggle="modal" data-target="#editJob" class="btn btn-primary btn-sm" value="<?php echo $jobs['jobType']."_".$jobs['jobId'];?>" onclick="jobModal(this.value)">Edit</></button>
                            </div>
                            <div class="col-md-2">
                                <form action="template/addNewJobQry.php" method="post">
                                    <input type="hidden" name="alter" value="delete">
                                    <input type="hidden" value="<?php echo $jobs['jobId']; ?>" name="jobId">
                                    <button type="submit" class="btn btn-danger btn-sm" name="jobs">Delete</></button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>  
                <?php } ?>
                <tfoot>
                <tr hidden>
                    <th>Job Name</th>
                    <th>Creation Date</th> 
                    <th>Edit</th>
                </tr>
                </tfoot>

            </table>
        </div>
    </div>    
</div>



<script>
    $('#jobsNav').addClass('active');
    function jobModal(info){
        const info_split = info.split('_');
        $('#modalJobType').val(info_split[0]);
        $('#modalJobId').val(info_split[1]);
    }
</script>