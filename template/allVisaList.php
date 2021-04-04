<?php
$result = $conn -> query("SELECT delegate.country, jobs.jobType,jobs.creditType, sponsor.sponsorName, sponsor.sponsorNID, sponsorvisalist.* from sponsorvisalist inner join sponsor using (sponsorNID) inner join jobs using(jobId) inner join delegateOffice on delegateOffice.delegateOfficeId = sponsor.delegateOfficeId inner join delegate on delegateOffice.delegateId = delegate.delegateId where visaAmount != 0");
?>
<style>
    .flex-container {
        display: flex;
        flex-direction: row;
    }
</style>
<div class="container-fluid" style="padding: 2%">
    <div class="card">
        <div class="card-header">
            <div class="section-header">
                <h2>Sponsor Visa List</h2>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTableSeaum" class="table table-bordered"  style="width:100%">
                    <thead>
                    <tr>
                        <th>Sponsor Name</th>
                        <th>Sponsor NID</th>
                        <th>VISA No.</th>
                        <th>Country</th>
                        <th>Issue Date</th>
                        <th>VISA Amount</th>
                        <th>Gender</th> 
                        <th>Job Type</th>               
                        <th>Comment</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while( $visaList = mysqli_fetch_assoc($result) ){                
                    ?>
                        <tr>
                            <td><?php echo $visaList['sponsorName'];?></td>
                            <td><?php echo $visaList['sponsorNID'];?></td>
                            <td><?php echo $visaList['sponsorVisa'];?></td>
                            <td><?php echo $visaList['country'];?></td>
                            <td><?php echo $visaList['issueDate'];?></td>
                            <td><?php echo $visaList['visaAmount'];?></td>
                            <td><?php echo $visaList['visaGenderType'];?></td>
                            <td><?php echo $visaList['jobType'].' ('.$visaList['creditType'].')';?></td>                        
                            <td><?php echo $visaList['comment'];?></td>                   
                            <td>
                                <div class="flex-container">
                                    <div style="padding-right: 2%">
                                        <form action="index.php" method="post">
                                            <input type="hidden" name="alter" value="update">
                                            <input type="hidden" value="editSponsorVisa" name="pagePost">
                                            <input type="hidden" value="<?php echo $visaList['sponsorVisa']; ?>" name="sponsorVisa">
                                            <button type="submit" class="btn btn-primary btn-sm">Add VISA</button>
                                        </form>
                                    </div>
                                    <div style="padding-right: 2%">
                                        <form action="index.php" method="post">
                                            <input type="hidden" name="alter" value="update">
                                            <input type="hidden" value="editVisaData" name="pagePost">
                                            <input type="hidden" value="<?php echo $visaList['sponsorVisa']; ?>" name="sponsorVisa">
                                            <button type="submit" class="btn btn-primary btn-sm">Edit</button>
                                        </form>
                                    </div>
                                    <div style="padding-left: 2%">
                                        <form action="template/visaSponsorEditQry.php" method="post">
                                            <input type="hidden" name="alter" value="delete">
                                            <input type="hidden" value="<?php echo $visaList['sponsorVisa']; ?>" name="sponsorVisa">
                                            <button type="submit" class="btn btn-danger btn-sm" name="sponsorVisaEdit">Delete</></button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                    <tfoot>
                    <tr hidden>
                        <th>Sponsor Name</th>
                        <th>Sponsor NID</th>
                        <th>VISA No.</th>
                        <th>Country</th>
                        <th>Issue Date</th>
                        <th>VISA Amount</th>
                        <th>Gender</th> 
                        <th>Job Type</th>               
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
    $('#sponsorNav').addClass('active');
</script>





