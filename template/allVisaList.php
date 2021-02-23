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
        <h3>Sponsor Visa List</h3>
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
                                <form action="template/addNewAgentQry.php" method="post">
                                    <input type="hidden" name="alter" value="delete">
                                    <input type="hidden" value="editAgent" name="pagePost">
                                    <input type="hidden" value="<?php echo $agent['agentId']; ?>" name="agentId">
                                    <input type="hidden" value="<?php echo $agent['agentType']; ?>" name="agentType">
                                    <input type="hidden" value="<?php echo $agent['agentTypeId']; ?>" name="agentTypeId">
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</></button>
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

<script>
    window.onload = function() {
        $('#sponsorNav').addClass('active');
    };
</script>





