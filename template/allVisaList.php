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
    <div class="section-header">
        <h3>Candidate List</h3>
    </div>
    <div class="table-responsive">
        <table id="dataTableSeaum" class="table col-12"  style="width:100%">
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
                            <!-- <div style="padding-right: 2%" >
                                <form action="index.php" method="post">
                                    <input type="hidden" name="alter" value="update">
                                    <input type="hidden" value="editCandidate" name="pagePost">
                                    <input type="hidden" value="<?php echo $visaList['visaGenderType']; ?>" name="passportNum">
                                    <input type="hidden" value="<?php echo $visaList['jobType']; ?>" name="passportNum">
                                    <input type="hidden" value="<?php echo $visaList['sponsorName']; ?>" name="passportNum">
                                    <button type="submit" class="btn btn-primary btn-sm">Edit</></button>
                                </form>
                            </div> -->
                            <div style="padding-left: 2%">
                                <form action="template/editCandidateQry.php" method="post">
                                    <input type="hidden" name="alter" value="delete">
                                    <input type="hidden" value="editCandidate" name="pagePost">
                                    <input type="hidden" value="<?php echo $candidate['candidateId']; ?>" name="candidateId">
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</></button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php } ?>
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






