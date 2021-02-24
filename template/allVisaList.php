<?php
$result = $conn -> query("SELECT * from sponsorvisalist order by sponsorName");
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
                <table id="dataTableSeaum" class="table table-bordered table-hover"  style="width:100%">
                    <thead>
                    <tr>
                        <th>VISA Amount</th>
                        <th>Gender</th> 
                        <th>Job Type</th>               
                        <th>Sponsor Name</th>
                        <th>Comment</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while( $visaList = mysqli_fetch_assoc($result) ){                
                    ?>
                        <tr>
                            <td><?php echo $visaList['visaAmount'];?></td>
                            <td><?php echo $visaList['visaGenderType'];?></td>
                            <td><?php echo $visaList['jobType'];?></td>                    
                            <td><?php echo $visaList['sponsorName'];?></td>                    
                            <td><?php echo $visaList['comment'];?></td>                   
                            <td>
                                <div class="flex-container">
                                    <div style="padding-right: 2%">
                                        <form action="index.php" method="post">
                                            <input type="hidden" name="alter" value="update">
                                            <input type="hidden" value="editSponsorVisa" name="pagePost">
                                            <input type="hidden" value="<?php echo $visaList['visaGenderType']."-".$visaList['jobType']."-".$visaList['sponsorName']; ?>" name="sponsorVisa">
                                            <button type="submit" class="btn btn-primary btn-sm">Add VISA</button>
                                        </form>
                                    </div>
                                    <div style="padding-left: 2%">
                                        <form action="template/visaSponsorEditQry.php" method="post">
                                            <input type="hidden" name="alter" value="delete">
                                            <input type="hidden" value="<?php echo $visaList['visaGenderType']."-".$visaList['jobType']."-".$visaList['sponsorName']; ?>" name="sponsorVisa">
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
                        <th>VISA Amount</th>
                        <th>Gender</th> 
                        <th>Job Type</th>               
                        <th>Sponsor Name</th>
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
    window.onload = function() {
        $('#sponsorNav').addClass('active');
    };
</script>




