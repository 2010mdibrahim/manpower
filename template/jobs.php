<style>
.container{
    margin-bottom: 2%;
}
</style>
<div class="container" style="padding: 2%">
    <div class="section-header">
        <h2>Jobs</h2>
    </div>
    <div class="container">
        <form action="template/addNewJobQry.php" method="post">
            <div class="form-row align-items-end">
                <div class="form-group col-md-6" >
                    <label>Add Jobs</label>
                    <input class="form-control" type="text" name="jobType" placeholder="Enter Name">
                </div>
                <div class="form-group" >
                    <input class="form-control" type="submit" value="Add" name="jobs">
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
                    <th>Creation Date</th> 
                    <th>Edit</th>
                </tr>
                </thead>
                <?php while($jobs = mysqli_fetch_assoc($result)){?>
                <tr>
                    <td><?php echo $jobs['jobType'];?></td>
                    <td><?php echo $jobs['creationDate'];?></td>
                    <!-- Edit Section -->
                    <td>
                        <div class="flex-container">
                            <!-- <div style="padding-right: 2%">
                                <form action="index.php" method="post">
                                    <input type="hidden" name="alter" value="update">
                                    <input type="hidden" value="editCandidate" name="pagePost">
                                    <input type="hidden" value="<?php echo $candidate['passportNum']; ?>" name="passportNum">
                                    <button type="submit" class="btn btn-primary btn-sm">Edit</></button>
                                </form>
                            </div> -->
                            <div style="padding-left: 2%">
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


    window.onload = function() {
        $('#jobsNav').addClass('active');
    };
</script>